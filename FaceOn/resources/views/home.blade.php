@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome, {{ Auth::user()->name }}!</div>

                <div class="panel-body">
                    <?php
                        use Carbon\Carbon;
                        use Illuminate\Routing\UrlGenerator;

                        // Current date
                        $current = Carbon::now();  // OR $current = new Carbon();
                        $now = $current->format('l, m-d-Y, h:i a');

                        if (url()->previous() == 'http://localhost:8000/register' || url()->previous() == 'https://git.heroku.com/face-on.git/register') {
                            ?><p>Thank you for registering with FaceOn!</p><?php
                        } else {
                            ?><p>Your last log out was on <strong>{{ Carbon::createFromFormat('Y-m-d H:i:s', Auth::user()->updated_at)->format('l, m-d-Y, h:i a') }}</strong>.</p><?php
                        }
                    ?>
                    <p>You are now logged in on <strong>{{ $now }}</strong>.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
