<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
          $table->string('preview_image')->nullable();
          $table->string('main_image')->nullable();
        });
    }


    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('preview_image');
            $table->dropColumn('main_image');
        });
    }
};
