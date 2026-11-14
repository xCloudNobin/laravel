<?php

use App\Jobs\RecordZdtJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $notes = DB::table('zdt_notes')->orderByDesc('id')->limit(10)->get();
    $jobs = DB::table('zdt_events')->where('kind', 'job')->orderByDesc('id')->limit(10)->get();
    $beats = DB::table('zdt_events')->where('kind', 'schedule')->orderByDesc('id')->limit(5)->get();
    $release = trim(@file_get_contents(base_path('worker-release.txt')) ?: 'unknown');
    return response()->view('zdt', compact('notes', 'jobs', 'beats', 'release'));
});

Route::get('/notes/create', function (Request $request) {
    $title = trim((string) $request->query('title', ''));
    if ($title === '') {
        return redirect('/')->with('status', 'missing title');
    }
    $id = DB::table('zdt_notes')->insertGetId([
        'title' => $title,
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    return redirect('/')->with('status', 'note '.$id);
});

Route::get('/dispatch', function (Request $request) {
    $payload = trim((string) $request->query('payload', 'manual'));
    RecordZdtJob::dispatch($payload);
    return redirect('/')->with('status', 'dispatched '.$payload);
});
