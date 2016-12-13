@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <script>
                            // Checks for the existence of navigator.getUserMedia -- needed for Camera access
                            function hasGetUserMedia() {
                                return !!(navigator.getUserMedia || navigator.webkitGetUserMedia ||
                                navigator.mozGetUserMedia || navigator.msGetUserMedia);
                            }

                            if (hasGetUserMedia()) {
                                // Good to go!
                            } else {
                                alert('getUserMedia() is not supported in your browser');
                            }

                            // Gaining access to an input device
                            var errorCallback = function(e) {
                                console.log('Reeeejected!', e);
                            };

                            // Cross-browser compatibility
                            navigator.getUserMedia  = navigator.getUserMedia ||
                                navigator.webkitGetUserMedia ||
                                navigator.mozGetUserMedia ||
                                navigator.msGetUserMedia;

                            var video = document.querySelector('video');

                            if (navigator.getUserMedia) {
                                navigator.getUserMedia({video: true}, function(stream) {
                                    video.src = window.URL.createObjectURL(stream);
                                }, errorCallback);
                            } else {
                                video.src = 'trailer.webm'; // fallback.
                            }
                        </script>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">User Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('gallery_name') ? ' has-error' : '' }}">
                            <label for="gallery_name" class="col-md-4 control-label">Employer Name</label>

                            <div class="col-md-6">
                                <input id="gallery_name" type="text" class="form-control" name="gallery_name" value="{{ old('gallery_name') }}" required>

                                @if ($errors->has('gallery_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gallery_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label for="image" class="col-md-4 control-label">Image for Facial Verification</label>

                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control" name="image" value="{{ old('image') }}" accept="image/*" capture="camera" required>

                                @if ($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Video display -->
                        <div style="text-align:center;">
                            <video id="screenshot-stream" class="video-stream" autoplay></video>
                            <img id="screenshot" src="">
                            <canvas id="screenshot-canvas" style="display:none;"></canvas>
                            <p>
                                <button id="screenshot-button">Capture</button>
                                <button id="screenshot-stop-button">Stop</button>
                            </p>
                        </div>

                        <script>
                            // Photo Booth application with realtime video
                            var video = document.querySelector('video');
                            var canvas = document.querySelector('canvas');
                            var ctx = canvas.getContext('2d');
                            var localMediaStream = null;

                            function snapshot() {
                                if (localMediaStream) {
                                    ctx.drawImage(video, 0, 0);
                                    // "image/webp" works in Chrome.
                                    // Other browsers will fall back to image/png.
                                    document.querySelector('img').src = canvas.toDataURL('image/webp');
                                }
                            }

                            video.addEventListener('click', snapshot, false);

                            // Not showing vendor prefixes or code that works cross-browser.
                            navigator.getUserMedia({video: true}, function(stream) {
                                video.src = window.URL.createObjectURL(stream);
                                localMediaStream = stream;
                            }, errorCallback);
                        </script>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
