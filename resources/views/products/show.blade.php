@extends('products/layout')

@section('title')
    Show Product page
@endsection

@section('contents')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Show Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">
        <h2 class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Product Name:</strong>
                {{ $product->productName }}
            </div>
            <div class="form-group">
                <strong>Price:</strong>
                {{ $product->price }}
            </div>
        </h2>
        <div class="col-xs-6 col-sm-6 col-md-6">
            @php
                $photo = asset("XproductImage/" . $product->photo);
            @endphp
            <img src="{{ $photo }}" width="300" alt="">
        </div>        
    </div>

@endsection