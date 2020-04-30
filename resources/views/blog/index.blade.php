@extends('layouts.app')

@section('content')
    <section id="blog">
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-12 mb-4">
                    <form action="">
                        <input type="text" name="search" value="{{ request()->query('search') }}" class="form-control" placeholder="Search blog ....">
                    </form>
                </div>

                <div class="col-md-8">
                    <div class="row">
                        @if(count($blogs) > 0)
                            @foreach($blogs as $blog)
                                <div class="col-md-6">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <img src="/storage/{{ $blog->image }}" alt="" style="width:100%">
                                            <h3>{{ $blog->title }}</h3>
                                            <p>{{ $blog->content }}</p>
                                            <a href="/blog/{{ $blog->id }}" class="btn btn-primary">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-md-12">
                            <div class="alert alert-danger">
                                Data tidak ada
                            </div>
                            </div>
                        @endif

                        <div class="col-md-12 mt-4">
                            {{ $blogs->links() }}
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <h4>Recent Post</h4>
                    <ol>
                        @foreach($recentBlogs as $blog)
                            <li><a href="/blog/{{ $blog->id }}">{{ $blog->title }}</a></li>
                        @endforeach
                    </ol>

					<h4>Category</h4>
					<ol>
                        @foreach($categories as $category)
                            <li><a href="/blog?category={{ $category->id }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection