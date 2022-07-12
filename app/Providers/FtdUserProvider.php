<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use App\ftdUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FtdUserProvider implements  UserProvider
{
    public function retrieveById($identifier){
        $result = DB::connection('pgsql')->select("select * from users where id = :id", [':id' => $identifier]);
        return !empty($result[0]) ? new ftdUser((array) $result[0]) : null;
    }

    public function retrieveByToken($identifier, $token) {
        return null;
    }

    public function updateRememberToken(Authenticatable $user, $token) {
        return null;
    }

    public function retrieveByCredentials(array $credentials){
        $result = DB::connection('pgsql')->select("select * from users where email = :email", [':email' => $credentials['email']]);
        return !empty($result[0]) ? new ftdUser((array) $result[0]) : null;
    }

    public function validateCredentials(Authenticatable $user, array $credentials){
        return Hash::check($credentials['password'], $user->password);
    }

}