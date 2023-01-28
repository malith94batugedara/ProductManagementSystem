@extends('layouts.app')

@section('title','All Products | PMS ')

@section('content')

<div class="container">
   
                        @if(session('status'))
                            <div class="alert alert-success">
                                  {{ session('status') }}
                            </div>
                        @endif

<div class="modal fade" tabindex="-1" id="deleteModal">
<div class="modal-dialog">
    <div class="modal-content">

   <form action="{{ route('product.delete') }}" method="post">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title">Delete Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="product_delete_id" id="product_delete_id"/>
        <h3>Are you sure want to delete this Product</h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Yes Delete</button>
      </div>
   </form>

    </div>
  </div>
</div>
                      <div class="table-responsive">
                       <table class="table table-dark">
                          <thead>
                            <tr>
                               <th>ID</th>
                               <th>User ID</th>
                               <th>Name</th>
                               <th>Description</th>
                               <th>Price</th>
                               <th>Image</th>
                               <th>Action</th>
                            </tr>
                          </thead>
                           
                          <tbody>
                          @foreach($products as $product)
                             <tr>
                               <td>{{ $product->id }}</td>
                               <td>{{ $product->user->id }}</td>
                               <td>{{ $product->name }}</td>
                               <td>{{ $product->description }}</td>
                               <td>{{ $product->price }}</td>
                               <td>
                                  <img src="{{ asset('uploads/products/'.$product->image)}}" height="50px" width="50px" alt="alt"/>
                               </td>
                               
                               <td>
                                   <a href="{{ route('product.edit',$product->id)}}" class="btn btn-success">Edit</a>
                                   <button type="button" value="{{ $product->id }}" class="btn btn-danger deleteProductBtn">Delete</button>
                               </td>
                             </tr>
                          @endforeach
                          </tbody>
                       </table>
                      </div>
</div>
@endsection

@section('scripts')
<script>
      $(document).ready(function() {
          $(document).on('click','.deleteProductBtn',function() {
            let product_id = $(this).val();
            $('#product_delete_id').val(product_id);
            $('#deleteModal').modal('show');
         });
      });
</script>

@endsection

