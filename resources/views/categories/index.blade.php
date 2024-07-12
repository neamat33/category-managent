@extends('home')

@section('content')
<div class="container">
    <h1>Categories</h1>
    <div class="card">
        <div class="card-header">
            <a href="{{ route('categories.create') }}" class="btn btn-primary">Add Category</a>
            <a href="{{ route('import.categories') }}" class="btn btn-secondary">Import Categories</a>
            <a href="{{ route('categories.export') }}" class="btn btn-secondary">Export Categories</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>SL.</th>
                    <th>Category</th>
                    <th>Parent</th>
                    <th>Action</th>
                </tr>
                @foreach ($categories as $key => $category)
                <tr>
                    <td width="5%">{{ ++$key }}</td>
                    <td>{{ $category['name'] }}</td>
                    <td>{{ $category['parent_name'] ?? 'N/A' }}</td>
                    <td width="15%"><a href="{{ route('categories.edit', $category['id']) }}" class="btn btn-sm btn-info">Edit</a>
                        <form action="{{ route('categories.destroy', $category['id']) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
            {{-- <ul>
                @foreach ($categories as $category)
                    @include('categories.partials.category', ['category' => $category])
                @endforeach
            </ul> --}}
        </div>
    </div>
    

    
</div>
@endsection
