@extends('layouts.app')

@section('content')
    <div class="hero">
        <div id="content" class="content">
            <h1>&nbsp;<span class="txt-type" data-wait="3000" data-words='["WELCOME"]'></span>
            </h1>
            <a href="/portfolio" class="btn btn-light">View My Portfolio</a>
        </div>
    </div>
@endsection
<!-- Typewriter effect -->
<script src="{{ URL::asset('js/typewriter.js') }}"></script>
