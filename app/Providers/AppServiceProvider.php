<?php

namespace App\Providers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

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
                '/tmp/storage/logs',
            ];

            foreach ($dirs as $dir) {
                if (! is_dir($dir)) {
                    @mkdir($dir, 0755, true);
                }
            }

            // Set temp paths for Vercel serverless
            config(['view.compiled' => '/tmp/storage/framework/views']);
            config(['cache.stores.file.path' => '/tmp/storage/framework/cache/data']);
            config(['logging.channels.single.path' => '/tmp/storage/logs/laravel.log']);

            try {
                // Auto-migrate on Vercel (supports both SQLite and pgsql/Supabase)
                Artisan::call('migrate', ['--force' => true]);

                if (DB::table('users')->count() === 0) {
                    error_log('Vercel: No users found. Running seed...');
                    Artisan::call('db:seed', ['--force' => true]);
                }
            } catch (\Throwable $exception) {
                error_log('Vercel Boot Error: '.$exception->getMessage());
            }
        }
    }
}
