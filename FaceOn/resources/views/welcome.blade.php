@extends('layouts.app')

@section('content')
<div class="container">
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                {{ config('app.name') }}
            </div>

            <div class="links">
                <a href="https://github.com/aadams3867" target="_blank">GitHub</a>
                <a href="https://www.linkedin.com/in/angela-adams" target="_blank">LinkedIn</a>
                <a href="https://stackoverflow.com/users/6513357/anazul" target="_blank">Stack Overflow</a>
            </div>
        </div>
    </div>
</div>
@endsection