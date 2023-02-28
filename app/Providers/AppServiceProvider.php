<?php

namespace App\Providers;

use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        Auth::viaRequest('jwt', static function (Request $request) {
            $token = $request->header('Authorization', null);

            if ($token === null) {
                return null;
            }

            $token = (array) JWT::decode(str_replace('Bearer ', '', $token), new Key(env('APP_KEY'), 'HS256'));

            $user = new User();
            $user->setRawAttributes((array) $token['user']);

            return $user;
       });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        JsonResource::withoutWrapping();
    }
}
