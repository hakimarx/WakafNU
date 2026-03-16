<?php


namespace App\Providers;


use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;\nuse Illuminate\Support\Facades\Log;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }


    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }


        if (env('VERCEL')) {
            $dirs = [
                '/tmp/bootstrap/cache',
                '/tmp/storage/framework/views',
                '/tmp/storage/framework/cache/data',
                '/tmp/storage/framework/sessions',
                '/tmp/storage/app/public',
            ];


            foreach ($dirs as $dir) {
                if (!is_dir($dir)) {
                    mkdir($dir, 0755, true);
                }
            }


            if (config('database.default') === 'sqlite') {
                $databasePath = config('database.connections.sqlite.database');


                if ($databasePath === ':memory:') {
                    $databasePath = '/tmp/database.sqlite';
                    config(['database.connections.sqlite.database' => $databasePath]);
                }


                if (!file_exists($databasePath)) {
                    touch($databasePath);
                }
            }


            try {
                // Ensure database connection
                if (config('database.default') !== 'sqlite') {
                   DB::connection()->getPdo();
                }
                
                // Check if migrations table exists
                if (!Schema::hasTable('migrations')) {
                    \Log::info('No migrations table found. Running migrations...');
                    Artisan::call('migrate', ['--force' => true]);
                    \Log::info('Migrations completed.');
                } else {
                    // Always try to migrate to ensure latest schema
                    Artisan::call('migrate', ['--force' => true]);
                }


                // Check if we need to seed
                if (DB::table('users')->count() === 0) {
                    \Log::info('No users found. Running seeders...');
                    Artisan::call('db:seed', ['--force' => true]);
                    \Log::info('Seeding completed.');
                }
            } catch (\Throwable $exception) {
                \Log::error('Vercel Boot Error: ' . $exception->getMessage(), [
                    'trace' => $exception->getTraceAsString()
                ]);
            }
        }
    }
}
