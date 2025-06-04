<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\Config;

class EncryptionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('encrypter', function ($app) {
            $config = $app->make('config')->get('app');

            // Pastikan kunci aplikasi sudah diatur
            if (empty($key = $config['key'])) {
                throw new \RuntimeException(
                    'Kunci aplikasi tidak diatur. Gunakan "php artisan key:generate" untuk membuat kunci.'
                );
            }

            // Pastikan cipher yang digunakan adalah AES-256-CBC
            $cipher = 'AES-256-CBC';

            // Buat instance Encrypter dengan kunci dan cipher yang ditentukan
            return new Encrypter(base64_decode(substr($key, 7)), $cipher);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}