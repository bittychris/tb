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
        Schema::create('comments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('form_id');
            $table->uuid('sender_id');
            $table->uuid('receiver_id');
            $table->text('content');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            $table->foreign('form_id')
                ->references('id')
                ->on('forms')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('sender_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('receiver_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};