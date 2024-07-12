
@extends('home')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-2">
            <h1>Import Category</h1>
            <form action="{{ route('categories.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-8">
                        
                        <input type="file" name="file" class="form-control" required>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-info">Import Categories</button>
                    </div>
                
                </div>
               
                
            </form>
        </div>
    </div>
    
</div>
@endsection
