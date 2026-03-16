<?php

namespace App\Providers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;

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
                    @mkdir($dir, 0755, true);
                }
            }

            // Ensure compiled views path is correct in Vercel
            config(['view.compiled' => '/tmp/storage/framework/views']);

            if (config('database.default') === 'sqlite') {
                $databasePath = config('database.connections.sqlite.database');

                if ($databasePath === ':memory:') {
                    $databasePath = '/tmp/database.sqlite';
                    config(['database.connections.sqlite.database' => $databasePath]);
                }

                if (!file_exists($databasePath)) {
                    @touch($databasePath);
                }
            }

            try {
                // Running migrations and seeders automatically on Vercel
                if (!Schema::hasTable('migrations')) {
                    error_log('Vercel: No migrations table found. Running migrate...');
                    Artisan::call('migrate', ['--force' => true]);
                } else {
                    Artisan::call('migrate', ['--force' => true]);
                }

                if (DB::table('users')->count() === 0) {
                    error_log('Vercel: No users found. Running seed...');
                    Artisan::call('db:seed', ['--force' => true]);
                }
            } catch (\Throwable $exception) {
                error_log('Vercel Boot Error: ' . $exception->getMessage());
            }
        }
    }
}
