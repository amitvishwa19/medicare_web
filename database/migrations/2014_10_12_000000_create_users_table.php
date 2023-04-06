<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('email')->unique();
            $table->string('username')->nullable();
            $table->string('userid')->unique();
            $table->string('contact')->nullable();
            $table->string('password')->nullable();
            $table->string('type')->default('user');
            $table->string('role')->default('user');
            $table->text('avatar_url')->nullable();
            $table->text('facebook_token')->nullable();
            $table->string('facebook_app_id')->nullable();
            $table->string('facebook_page_id')->nullable();
            $table->string('display_name')->nullable();
            $table->text('fcm_device_id')->nullable();
            $table->decimal('latitude', 11, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('verification_code')->nullable();
            $table->boolean('status')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
