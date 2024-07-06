<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJwtTokensTable extends Migration
{
    public function up()
    {
        Schema::create('jwt_tokens', function (Blueprint $table) {
            $table->id();
            $table->text('unique_id');
            $table->foreignId('user_id')->constrained('users');
            $table->string('token_title')->nullable();
            $table->json('restrictions')->nullable();
            $table->json('permissions')->nullable();
            $table->timestamps();
            $table->timestamp('expires_at')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('refreshed_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jwt_tokens');
    }
}
