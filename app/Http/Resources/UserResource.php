<?php

namespace App\Http\Resources;

use Firebase\JWT\JWT;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Config;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $swap = 'user';
    public function toArray($request): array
    {
        $jwt = $this->createToken();
        return [
            'id' => $this->id,
            'email' => $this->email,
            'username' => $this->username,
            'bio' => $this->bio,
            'image' => $this->image,
            'token' => $jwt
        ];
    }
    private function createToken(): string
    {
        $key = Config::get('app.key');
        $payload = array(
            "iss" => Config::get('app.url'),
            "aud" => Config::get('app.url'),
            "iat" => time(),
            "nbf" => time(),
            "exp" => time() + (24 * 60 * 60),
            "user" => [
                'email' => $this->email,
                'username' => $this->username,
                'bio' => $this->bio,
                'image' => $this->image
            ]
        );

        return JWT::encode($payload, $key, 'HS256');
    }
}
