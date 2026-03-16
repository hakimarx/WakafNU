<?php

namespace App\Providers;

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
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        // Penyesuaian path storage untuk Vercel karena filesystem read-only
        // kecuali folder /tmp
        if (env('VERCEL')) {
            $this->app->useStoragePath('/tmp/storage');
            
            // Pastikan folder yang dibutuhkan ada
            $dirs = [
                '/tmp/storage/framework/views',
                '/tmp/storage/framework/cache',
                '/tmp/storage/framework/sessions',
                '/tmp/storage/app/public',
            ];
            foreach ($dirs as $dir) {
                if (!is_dir($dir)) {
                    mkdir($dir, 0755, true);
                }
            }
        }
    }
}
