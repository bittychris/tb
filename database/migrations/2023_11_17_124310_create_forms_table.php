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
            $table->uuid('id')->primary();
            $table->uuid('form_attribute_id');
            $table->uuid('created_by');
            $table->uuid('completed_by')->nullable();
            $table->string('scanning_name');
            $table->foreignId('ward_id')->unsigned()->constrained()->nullable();
            $table->string('address');
            $table->boolean('status')->default(false); // show if form is submitted (1) or not (0)
            $table->timestamps();

            $table->foreign('form_attribute_id')
                ->references('id')
                ->on('form_attributes')
                ->cascadeOnDelete();
            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
            $table->foreign('completed_by')
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
