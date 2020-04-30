<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Content</th>
        </tr>
    </thead>
    <tbody>
    @foreach($blogs as $blog)
        <tr>
            <td>{{ $blog->id }}</td>
            <td>{{ $blog->title }}</td>
            <td>{{ $blog->content }}</td>
        </tr>
    @endforeach
    </tbody>
</table>