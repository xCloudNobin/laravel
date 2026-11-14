<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('zdt_notes')->insert([
            'title' => 'halfway-step-1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Schema::create('zdt_halfway', function (Blueprint $table) {
            $table->id();
            $table->string('note', 255);
            $table->timestamps();
        });

        DB::table('zdt_halfway')->insert([
            'note' => 'step2-after-create',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        throw new RuntimeException('intentional halfway migration failure');
    }

    public function down(): void
    {
        Schema::dropIfExists('zdt_halfway');
    }
};
