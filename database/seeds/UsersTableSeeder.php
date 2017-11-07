<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Class UsersTableSeeder
 */
class UsersTableSeeder extends Seeder {
    public function run() {
        $users   = [];
        $users[] = [
            'username'  => 'Anonymous',
            'email'     => 'devsnaps@linuxfr.eu',
            // 'password' => password_hash('password', PASSWORD_DEFAULT),
            'password'  => Hash::make('there is no password for this user, duh! jeih9aiPeiSa#4eiyrieKei5o Aisico4a_ohNupha9EiVai7ie tooCh4l'),
            'api_token' => ".         -    -  - -- Skynet is coming -- -  -    -       .", // 60 chars
        ];
        $users[] = [ //FIXME Delete this
            'username'  => 'Alexandre',
            'email'     => 'alexandre@linuxfr.eu',
            'password'  => Hash::make("w1yM]K)04p#SO9pi3D- 2R2{'6M;PwA)Cy#eA1)(%H7 F<D>=A<<(3O.fJ*0m<N$"),
            'api_token' => str_random(60),
        ];

        DB::table('users')->insert($users);
    }
}

