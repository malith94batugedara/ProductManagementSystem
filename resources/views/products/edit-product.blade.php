@extends('layouts.app')

@section('content')

@section('title','Edit Product | PMS ')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Product') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                              <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ route('product.update',$product->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                       <div class="form-group">
                           <label for="title">Name</label>
                           <input type="text" class="form-control" name="name" value="{{ $product->name }}">
                       </div>
                       <div class="form-group">
                           <label for="description">Description</label>
                           <textarea type="text" name="description" class="form-control" rows="5">{{ $product->description }}</textarea>
                       </div>
                       <div class="form-group">
                           <label for="title">Price</label>
                           <input type="text" class="form-control" name="price" value="{{ $product->price }}">
                       </div>
                       <div class="form-group">
                              <label for="website_logo">Image</label>
                              <input type="file" class="form-control" name="image"><br>
                              @if($product)
                                 <img src="{{ asset('uploads/products/'.$product->image) }}" height="100px" width="100px" alt=""/>
                              @endif 
                       </div><br>
  
                           <button type="submit" class="btn btn-primary">Update Product</button>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
