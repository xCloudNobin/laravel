<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;

class RecordZdtJob implements ShouldQueue
{
    use Queueable;

    public function __construct(public string $payload = 'manual') {}

    public function handle(): void
    {
        $release = @file_get_contents(base_path('worker-release.txt')) ?: 'unknown';
        $release = trim($release);
        DB::table('zdt_events')->insert([
            'kind' => 'job',
            'payload' => $this->payload,
            'worker_release' => $release,
            'cwd' => getcwd() ?: '',
            'base_path' => base_path(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
