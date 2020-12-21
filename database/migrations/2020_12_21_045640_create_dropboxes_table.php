<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDropboxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dropboxes', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('dropbox_uid');
            $table->text('access_token');
            $table->string('drop_acc_id');
            $table->string('token_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dropboxes');
    }
}
