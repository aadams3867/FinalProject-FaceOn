@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome, <strong>{{ Auth::user()->name }}</strong>!</div>

                <div class="panel-body">
                    <p><strong>This page is only for testing!</strong></p>
                    <hr>
                    <p>View all of my galleries:</p>
                    <?php
                        use App\Kairos;

                        $kairos_test = new Kairos(config('kairos_app.id'), config('kairos_app.key'));

                        $response = $kairos_test->viewGalleries();
                        
                        var_dump($response);
                    ?>
                    <hr>
                    <p>View the subjects in {{ Auth::user()->gallery_name }}'s Gallery:</p>
                    <?php
                        $argumentArray =  array(
                            "gallery_name" => Auth::user()->gallery_name 
                        );

                        $response = $kairos_test->viewSubjectsInGallery($argumentArray);

                        var_dump($response);
                        ?><br><br><?php
                    ?>
                    <p>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection