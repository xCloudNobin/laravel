<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('zdt_halfway');

        Schema::create('zdt_post_migrate', function (Blueprint $table) {
            $table->id();
            $table->string('note', 255);
            $table->timestamps();
        });

        DB::table('zdt_post_migrate')->insert([
            'note' => 'successful-migration-applied',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('zdt_notes')->insert([
            'title' => 'successful-migration-applied',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('zdt_post_migrate');
    }
};
