<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSnapsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('Snaps', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->text('content');
            $table->boolean('favorite'); //FIXME The 'favorite' info should stored by user/snap, not only by Snap
            $table->integer('user_id')
                  ->unsigned()
                  ->nullable();
            $table->integer('timesViewed');
            $table->integer('timesEdited');
            $table->timestamps();
            //TODO Add a `private` field
            //TODO Add a `project` field so that the user can regroup multiple Snap under a given project
            //TODO Add a 'tags' field so that the user can add many tags to a given Snap

            // Relationships
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  // ->onDelete('cascade');
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('Snaps');
    }
}
