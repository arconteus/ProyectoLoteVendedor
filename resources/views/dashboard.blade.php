@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div id="dashboard-app"></div>
@endsection
    <lotes-list />
    @vite('resources/js/app.js')
</body>
</html>
