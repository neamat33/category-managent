@extends('home')

@section('content')
<div class="container">
    <h1>Create Blog</h1>
    <form action="{{ route('blogs.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" class="form-control" required>
                <option value=""> Select </option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="category_id">Sub Category</label>
            <select name="sub_category_id" id="subcat_id" class="form-control" required>
               
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
<script>
    $(function() {
        $("#category_id").on("change", function() {
            let cat_id = $(this).val();
            $.ajax({
                url: "{{ url('ajaxgetcategory') }}",
                type: "GET",
                data: {
                    "cat_id": cat_id,
                },
                success: function(res) {
                    $("#subcat_id").html(res);
                }
            });

        });
    })
</script>
@endsection
