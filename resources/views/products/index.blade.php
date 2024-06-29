@extends('products/layout')

@section('title')
    products home page
@endsection

@section('contents')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif



    <h2>
        All Products in our store
    </h2>

    <a class="btn btn-success" href="{{ route('products.create') }}">Create New Product</a>

@endsection