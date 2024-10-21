<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_diskon', function (Blueprint $table) { //tbl=table
            $table->id();
            $table->biginteger('total_belanja'); // belanja dia lebih dari berapa, bakal dapet diskon
            $table->integer('diskon')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_diskon');
    }
};
