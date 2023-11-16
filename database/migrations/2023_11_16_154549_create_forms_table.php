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
        Schema::create('forms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form_attribute_id');
            $table->string('scaning_name');
            $table->unsignedBigInteger('ward_id');
            $table->string('address');
            $table->unsignedBigInteger('createdBy');
            $table->unsignedBigInteger('completedBy');

            $table->timestamps();

            $table->foreign('form_attribute_id')
                ->references('id')
                ->on('form_attributes')
                ->cascadeOnDelete();

            $table->foreign('ward_id')
                ->references('id')
                ->on('wards')
                ->cascadeOnDelete();

            $table->foreign('createdBy')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();


            $table->foreign('completedBy')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forms');
    }
};
