@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                    <img src="" id="random-img" class="m-t-5">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('after-scripts')
    <script>
        $.ajax({
            url: 'https://dog.ceo/api/breeds/image/random',
            method: 'GET',
            success: function (data) {
                var link = data.message;
                $('#random-img').attr('src', link);
            }
        })
    </script>
@endsection
