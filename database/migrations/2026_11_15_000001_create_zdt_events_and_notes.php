<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('zdt_events', function (Blueprint $table) {
            $table->id();
            $table->string('kind', 32);
            $table->string('payload', 255)->nullable();
            $table->string('worker_release', 64)->nullable();
            $table->string('cwd', 512)->nullable();
            $table->string('base_path', 512)->nullable();
            $table->timestamps();
        });

        Schema::create('zdt_notes', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('zdt_events');
        Schema::dropIfExists('zdt_notes');
    }
};
