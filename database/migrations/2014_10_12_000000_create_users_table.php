<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('image')->nullable();
            $table->string('phone');
            $table->timestamp('email_verified_at')->now()->nullable();
            $table->string('password');
            $table->foreignId('region_id')->unsigned()->nullable()->constrained();
            // $table->foreignID('role_id')->nullable()->constarained();
            $table->char('role_id', 36);
            $table->boolean('status')->default(true);
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('role_id')
                ->references('id') // role id
                ->on('roles')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};