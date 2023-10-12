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
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->string('hs_codes_id');
            $table->unsignedBigInteger('data_id');
            $table->string('numeral')->nullable();
            $table->unsignedBigInteger('chapter_id')->nullable();
            $table->string('position')->nullable();
            $table->string('title')->nullable();
            $table->string('type')->nullable();
            $table->string('goods_nomenclature_item_id')->nullable();
            $table->string('producline_suffix')->nullable();
            $table->text('formatted_description')->nullable();
            $table->text('description')->nullable();
            $table->string('description_indexed')->index()->nullable();
            $table->text('search_references')->nullable();
            $table->dateTime('validity_start_date')->nullable();
            $table->dateTime('validity_end_date')->nullable();
            $table->decimal('score', 12, 4)->nullable();
            $table->tinyInteger('declarable')->nullable();
            $table->text('chapter_description')->nullable();
            $table->text('heading_description')->nullable();
            $table->text('heading_id')->nullable();
            $table->text('chapter_note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapters');
    }
};
