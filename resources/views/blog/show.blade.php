@extends('layouts.app')

@section('content')
    <section id="blog">
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-8">
                    <h1>{{ $blog->title }}</h1>
                    <p>{{ $blog->content }}</p>
                </div>
            </div>
        </div>
    </section>
@endsection