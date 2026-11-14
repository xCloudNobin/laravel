<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>laraworker ZDT</title>
</head>
<body>
    <h1>laraworker</h1>
    <p>app release: {{ $release }}</p>
    @if (session('status'))
        <p>status: {{ session('status') }}</p>
    @endif
    <h2>persist notes</h2>
    <ul>
        @forelse ($notes as $note)
            <li>{{ $note->id }} {{ $note->title }} {{ $note->created_at }}</li>
        @empty
            <li>none</li>
        @endforelse
    </ul>
    <h2>processed jobs</h2>
    <ul>
        @forelse ($jobs as $job)
            <li>{{ $job->id }} payload={{ $job->payload }} worker_release={{ $job->worker_release }} cwd={{ $job->cwd }} at={{ $job->created_at }}</li>
        @empty
            <li>none</li>
        @endforelse
    </ul>
    <h2>scheduler heartbeats</h2>
    <ul>
        @forelse ($beats as $beat)
            <li>{{ $beat->id }} worker_release={{ $beat->worker_release }} at={{ $beat->created_at }}</li>
        @empty
            <li>none</li>
        @endforelse
    </ul>
</body>
</html>
