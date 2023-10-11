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
        Schema::dropIfExists('hs_codes');
        Schema::create('hs_codes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hs_codes_id');
            $table->unsignedBigInteger('chapter_id');
            $table->string('type');
            $table->string('goods_nomenclature_item_id');
            $table->string('producline_suffix');
            $table->text('formatted_description');
            $table->text('description');
            $table->string('description_indexed')->index();
            $table->text('search_references');
            $table->timestamp('validity_start_date');
            $table->timestamp('validity_end_date')->nullable();
            $table->decimal('score', 12, 4)->nullable();
            $table->tinyInteger('declarable');
            $table->text('chapter_description')->nullable();
            $table->text('heading_description')->nullable();
            $table->text('heading_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('h_s_codes');
    }
};
