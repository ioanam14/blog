@extends('layouts.app')

@section('content')
<div class="article">
    <div class="header">Dashboard</div>

    <div class="content">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        You are logged in!
    </div>
</div>
@endsection
