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

    @if (count($products) == 0)
        <h3>no Products saved yet</h3>    
    @else        
        <table class="table table-striped table-bordered" style="margin: 0 auto; width: 55%;">
                <tr>
                    <th>no</th>
                    <th>Product name</th>
                    <th>Price</th>
                    <th>Operations</th>
                </tr>
            @foreach ($products as $oneProduct)
                <tr>
                    <td>
                        {{ ++$i }}
                    </td>
                    <td>
                        {{ $oneProduct->productName }}
                    </td>
                    <td>
                        {{ $oneProduct->price }}
                    </td>

                    <td>
                        <form action="{{ route('products.destroy',$oneProduct->id) }}" method="POST" style="display: inline;">
        
                            <a class="btn btn-info" href="{{ route('products.show', $oneProduct->id) }}">Show</a>
        
                            <a class="btn btn-primary" href="{{ route('products.edit', $oneProduct->id) }}">Edit</a>
        
                            @csrf
                            @method('DELETE')
            
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>

                        {{-- ------------------------------- --}}

                        <form action="{{ route('products.isActive', $oneProduct->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('POST')
                            @if ($oneProduct->isActive == 0)
                                <button type="submit" class="btn btn-secondary">Active</button>
                            @else
                                <button type="submit" class="btn btn-warning">DeActive</button>
                            @endif                      
                        </form>
        
                    </td>
        
                </tr>
            @endforeach
        </table>

        <div id="paginationNumbers">
            {!! $products->links('pagination::bootstrap-4') !!}
        </div>
    
    @endif
@endsection