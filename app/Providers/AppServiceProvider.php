        }
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
                    config([
                        'database.connections.sqlite.database' => $databasePath,
                    ]);
                }

                if (!file_exists($databasePath)) {
                    touch($databasePath);
                }

            }

            $this->app->booted(function () {
                try {
                    // Test database connection with a timeout
                    DB::connection()->getPdo();
                    
                    if (!Schema::hasTable('migrations')) {
                        \Log::info('No migrations table found. Running migrations...');
                        Artisan::call('migrate', ['--force' => true]);
                        \Log::info('Migrations completed.');
                        
                        \Log::info('Running seeders...');
                        Artisan::call('db:seed', ['--force' => true]);
                        \Log::info('Seeding completed.');
                        return;
                    }

                    $requiresSeedData = Schema::hasTable('users')
                        && Schema::hasTable('waqf_assets')
                        && Schema::hasTable('campaigns')
                        && (
                            ! DB::table('users')->where('email', 'admin@lwpwnujatim.org')->exists()
                            || ! DB::table('waqf_assets')->where('status', 'available')->exists()
                            || ! DB::table('campaigns')->exists()
                        );

                    if ($requiresSeedData) {
                        \Log::info('Missing critical seed data. Running seeders...');
                        Artisan::call('db:seed', ['--force' => true]);
                        \Log::info('Seeding completed.');
                    }
                } catch (\Throwable $exception) {
                    \Log::error('Vercel Boot Error: ' . $exception->getMessage(), [
                        'trace' => $exception->getTraceAsString()
                    ]);
                    // Don't rethrow, let the app try to boot even if DB is down
                }
            });
        }
    }
}
