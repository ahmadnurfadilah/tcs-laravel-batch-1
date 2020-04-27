@extends('layouts.master')

@section('title')
    Halaman Hello
@endsection

@section('content')
<div class="jumbotron">
    <div class="container">
        <h1 class="display-4">{{ $greet }}</h1>
        @if($jam == 12)
            Selamat makan siang
        @elseif($jam == 6)
            Selamat Berbuka
        @else
            Selamat Tidur
        @endif

        @for($i=0;$i<10;$i++)
            Ini looping ke {{ $i }} <br>
        @endfor

        <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
        <hr class="my-4">
        <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
        <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
    </div>
</div>
@endsection