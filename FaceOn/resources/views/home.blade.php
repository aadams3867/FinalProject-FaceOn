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

                        // Current date
                        $current = Carbon::now();  // OR $current = new Carbon();
                        $now = $current->format('l, m-d-Y, h:i a');
                    ?>
                    <p>You last logged out at {{ Carbon::createFromFormat('Y-m-d H:i:s', Auth::user()->updated_at)->format('l, m-d-Y, h:i a') }}.</p>
                    <p>You are now logged in at {{ $now }}.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
