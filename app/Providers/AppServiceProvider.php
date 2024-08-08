<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Encryption\Encrypter;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Opcodes\LogViewer\Facades\LogViewer;

class AppServiceProvider extends ServiceProvider {

    public const HOME = '/';

    #public const HOME = '/ar/AppPanel/Home';


    public function register(): void {

    }


    public function boot(): void {

        Paginator::useBootstrap();
        LogViewer::auth(function ($request) {
            return $request->user() && in_array($request->user()->email, ['test@test.com',]);
        });

        $key = $this->databaseEncryptionKey();
        $cipher = config('app.cipher');
        Model::encryptUsing(new Encrypter($key, $cipher));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    protected function databaseEncryptionKey(): ?string {
        $key = config('app.encryption_key');
        return base64_decode(Str::after($key, 'base64:'));
    }

}
