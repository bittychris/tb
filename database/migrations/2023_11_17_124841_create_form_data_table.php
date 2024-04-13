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
        Schema::create('form_data', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('form_id');
            $table->uuid('age_group_id');
            $table->uuid('attribute_id');
            $table->integer('male')->nullable();
            $table->integer('female')->nullable();
            $table->timestamps();

            $table->foreign('form_id')
                ->references('id')
                ->on('forms')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreign('age_group_id')
                ->references('id')
                ->on('age_groups')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreign('attribute_id')
                ->references('id')
                ->on('attributes')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_data');
    }
};