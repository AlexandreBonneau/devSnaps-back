<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateUsersTable
 */
class CreateUsersTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('email', 191)->unique(); //Ici je limite la taille à 191 caractères afin de rester dans la limite de taille des clefs de 767 bytes du moteur InnoDB. Note: la RFC indique que la taille maximale d'une adresse email est bien 254 caractères (cf. http://stackoverflow.com/questions/386294/what-is-the-maximum-length-of-a-valid-email-address)
            $table->string('password', 60);
            $table->string('api_token', 60)->unique();
            //TODO Add the avatar url
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('users');
    }
}
