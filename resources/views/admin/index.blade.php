@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <a href="/admin/create-blog" class="btn btn-primary">Add New Blog</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Title</th>
                                <th scope="col">Content</th>
                                <th scope="col">Created By</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($blogs) > 0)
                                @foreach($blogs as $blog)
                                    <tr>
                                        <td>{{ $blog->id }}</td>
                                        <td>{{ $blog->title }}</td>
                                        <td>{{ $blog->content }}</td>
                                        <td>{{ $blog->name }}</td>
                                        <td>
                                            <a href="/admin/edit-blog/{{ $blog->id }}" class="btn btn-primary">Edit</a>
                                            <a href="/admin/delete-blog/{{ $blog->id }}" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4">Tidak ada data</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                {{ $blogs->links() }}
            </div>
        </div>
@endsection