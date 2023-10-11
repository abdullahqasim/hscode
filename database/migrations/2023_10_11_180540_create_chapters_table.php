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
            $table->unsignedBigInteger('hs_codes_id');
            $table->unsignedBigInteger('data_id');
            $table->unsignedBigInteger('numeral')->nullable();
            $table->unsignedBigInteger('title')->nullable();
            $table->unsignedBigInteger('chapter_id')->nullable();
            $table->string('type')->nullable();
            $table->string('goods_nomenclature_item_id');
            $table->string('producline_suffix');
            $table->text('formatted_description')->nullable();
            $table->text('description');
            $table->string('description_indexed')->index();
            $table->text('search_references');
            $table->timestamp('validity_start_date');
            $table->timestamp('validity_end_date')->nullable();
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
