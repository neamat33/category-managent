@extends('home')

@section('content')
    <div class="container">
        <h1>Blogs</h1>
        <div class="card">
            <div class="card-header">
                
                <a href="{{ route('blogs.create') }}" class="btn btn-primary">Add Blog</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered mt-3">
                    <tr>
                        <th>SL.</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Sub Category</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($blogs as $k => $blog)
                        <tr>
                            <td>{{ ++$k }}</td>
                            <td>{{ $blog->title }}</td>
                            <td>{{ $blog->category->name }}</td>
                            <td>{{ $blog->sub_category->name }}</td>
                            <td><a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-sm btn-info">Edit</a>
                                <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        

        

    </div>
@endsection
