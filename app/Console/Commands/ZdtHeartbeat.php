<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ZdtHeartbeat extends Command
{
    protected $signature = 'zdt:heartbeat';
    protected $description = 'Record a scheduler heartbeat with the current release marker';

    public function handle(): int
    {
        $release = @file_get_contents(base_path('worker-release.txt')) ?: 'unknown';
        $release = trim($release);
        DB::table('zdt_events')->insert([
            'kind' => 'schedule',
            'payload' => 'heartbeat',
            'worker_release' => $release,
            'cwd' => getcwd() ?: '',
            'base_path' => base_path(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $this->info('heartbeat '.$release);
        return self::SUCCESS;
    }
}
