<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rumus', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('keterangan')->nullable();
            $table->text('rumus')->nullable();
            $table->string('jenjang');
            $table->string('emoji')->default('🧮');
            $table->string('gradient')->default('from-indigo-500 to-violet-600');
            $table->unsignedInteger('urutan')->default(0);
            $table->timestamps();

            $table->index('jenjang');
            $table->index('urutan');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rumus');
    }
};
