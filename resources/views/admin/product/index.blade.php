@extends('admin.admin_layout')
@section('adminMain')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="index.html">Starlight</a>
      <a class="breadcrumb-item" href="index.html">Tables</a>
      <span class="breadcrumb-item active">Data Table</span>
    </nav>

    <div class="sl-pagebody">
     

      <div class="card pd-20 pd-sm-40">
       
        
        <div class="table-wrapper">
          <a class="btn btn-success" href="{{ route('add.product') }}" class="nav-link">Add product+</a>
          <table id="datatable1" class="table display responsive nowrap">
            <thead>
              <tr>
                <th class="wd-15p">Product code</th>
                <th class="wd-15p">Product name</th>
                <th class="wd-20p">image</th>
                <th class="wd-15p">Category</th>
                <th class="wd-10p">Brand</th>
                <th class="wd-25p">Quantity</th>
                <th class="wd-25p">status</th>
                <th class="wd-25p">Action</th>
              </tr>
            </thead>
            <tbody>
              
              @foreach ($products as $item)    
              
              <tr>
               

               
                <td>{{$item->product_code}}</td>
                <td>{{$item->product_name}}</td>
                <td>
                  <img src="{{asset('product_images/'.$item->image_one)}}" width="100">
                </td>
                <td>{{$item->category_name}}</td>
                <td>{{$item->brand_name}}</td>
                <td>{{$item->product_quantity}}</td>
                <td>
                  @if($item->status == 1)
                  <span class="badge badge-success">Active</span>
                  @else
                  <span class="badge badge-danger">Deactive</span>
                  @endif
                </td>
                <td>
                  <form method="post" action="#">
                    @csrf
                    <input type="hidden" value="{{$item->id}}" name="product_id">
                  <a class="btn btn-success btn-sm" href="{{ route('product.edit',$item->id) }}"><i class="fa fa-edit"></i></a>
                  <a class="btn btn-warning btn-sm" href="{{ route('product.show',$item->id) }}"><i class="fa fa-eye"></i></a>
                  @if($item->status == 1)
                  <a class="btn btn-primary btn-sm" href="{{ route('status.active',$item->id) }}"><i class="fa fa-thumbs-up"></i></a>
                  @else
                    <a class="btn btn-warning btn-sm" href="{{ route('status.deactive',$item->id) }}"><i class="fa fa-thumbs-down"></i></a>
                    @endif
                 
                  <button type="button" value="{{$item->id}}" id="deleteid" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                </form>
                </td>
             
                
              </tr>
              @endforeach
             
            
            </tbody>
          </table>
        </div><!-- table-wrapper -->
      </div><!-- card -->
      
     





<script>
    $('document').ready(function(){
        $('body').on('click','#deleteid',function(){
           let id=$(this).val();
          const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
      $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
      $.ajax({
          type:'GET',
          url:"/admin/product/delete/"+id,
          success:function(){
              swalWithBootstrapButtons.fire(
      'OPPS!',
      'Product deleted successfully.',
      'success'
    ).then((result)=>{
      location.reload();

        
    });
    
          }
      })
  
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'Your imaginary file is safe :)',
      'error'
    )
  }
})
        })
    })
</script>
      
@endsection()