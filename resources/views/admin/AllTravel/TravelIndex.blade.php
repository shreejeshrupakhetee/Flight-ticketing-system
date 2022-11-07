@extends('layouts.admin')
@section('admin-content')
@section('title'){{ 'All Ticket'}}@endsection
<div class="container-fluid">
    @if(Session::has('successMessage'))
    <div class="alert alert-success" role="alert" id="box">
       {{Session::get('successMessage')}}
      </div>
    @endif
    <div class="d-flex bg-light p-5 justify-content-between">
        <h1>AVAILABLE TICKETS</h1>
        <a href="{{route('travel.create')}}"><button class="btn btn-SECONDARY">Add Tickets</button></a>
    </div>
    <table id="datatable" class="table">
        <thead>
            <tr class="bg-light">
                <th>S.No</th>
                <th>Travel Name</th>
                <th>Price</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
            </thead>
            <tfoot style="display:table-header-group;">
            <tr>
                <th>S.No</th>
                <th>Travel Name</th>
                <th>Price</th>
                <th>Image</th>
            </tr>  
            </tfoot>
            <tbody>
            @foreach($data as $index=>$a)
            <tr>			
                <td>{{++$index}}</td>
                <td>{{$a->travelnames->travel_name}}</td>
                <td>Rs. {{$a->price}}</td>
                <td><img src='{{asset("images/$a->image")}}' alt="{{$a->image}}" style="height:100px;width:100px;"/></td>
                <td>
                    <div class="d-flex">
                        <a href="{{route('travel.edit',['travel'=>$a->slug])}}"><button class="btn-sm" data-toggle="tooltip" title='Edit Product'><i class="fa fa-edit fa-1x"></i></button></a>
                        <form action="{{route('travel.destroy',['travel'=>$a->slug])}}" method="POST">
                           @csrf
                           @method('delete')
                           <button class="btn-sm " data-toggle="tooltip" title='Delete Product'><i class="fa fa-trash fa-1x"></i></button>
                        </form>
                        <a href="{{route('travel.show',['travel'=>$a->slug])}}"><button class="btn-sm " data-toggle="tooltip" title='View Product'><i class="fa fa-eye fa-1x"></i></button></a>
                    </div>
                    </td>
            </tr>
            @endforeach
            </tbody>
        </table>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
var table = $('#datatable').DataTable();

$('#datatable tfoot th').each( function (i) {
    var title = $(this).text();
    //console.log(title);
    $(this).html( '<input type="text" placeholder="Search '+title+'" />' );

    $( 'input', this ).on( 'keyup change', function () {
        if ( table.column(i).search() !== this.value ) {
            table
                .column(i)
                .search( this.value )
                .draw();
        }
    });
});



 $('.show_confirm').click(function(event) {
      var form =  $(this).closest("form");
      var name = $(this).data("name");
      event.preventDefault();
      swal({
          title: `Are you sure you want to delete this Product?`,
          text: "If you delete this, it will permananently be deleted.",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          form.submit();
        }
      });
  });

  setTimeout(() => {
const box = document.getElementById('box');
box.style.display = 'none';
}, 1000);
</script>
@endsection