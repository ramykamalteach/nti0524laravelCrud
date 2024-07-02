@extends('products/layout')

@section('title')
    products home page
@endsection

@section('contents')
    <h2>
        Create New product
    </h2>

    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

    <h3>
        <form id="CreateForm" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Product Name:</strong>
                        <input type="text" name="productName" class="form-control" placeholder="ProductName">
                    </div>
                    @error('ProductName')
                        <h5 class="alert alert-danger">{{ $message }}</h5>
                    @enderror
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Product Price:</strong>
                        <input type="number" class="form-control" name="price" placeholder="Product Price">
                    </div>
                    @error('price')
                        <h5 class="alert alert-danger">{{ $message }}</h5>
                    @enderror
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Product Photo:</strong>
                        <input type="file" class="form-control" name="photo" placeholder="Product photo" onchange=" imageFilePreview (this);">
                    </div>
                    @error('photo')
                        <h5 class="alert alert-danger">{{ $message }}</h5>
                    @enderror
                </div>

                <img id="imagePreview" alt="image Preview" style="max-width:150px; max-height:150px;">

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" name="isActive">
                        is Active Product
                        <label class="form-check-label" for="isActive">
                            is Active Product
                        </label>
                    </div>
                        
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <br>
                        <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        
        </form>
    </h3>
@endsection

<script>
    function imageFilePreview(inputFile){
        var file = inputFile.files[0];
        if(file){
            var reader = new FileReader();
            reader.onload = function(){
                document.getElementById("imagePreview").setAttribute("src", reader.result);
            }
            reader.readAsDataURL(file);
        }
    }
</script>


