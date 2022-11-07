@extends('layouts.admin')
@section('admin-content')
@section('title'){{ 'All Ticket'}}@endsection
<div class="container-fluid">
    @if(Session::has('successMessage'))
    <div class="alert alert-success" role="alert" id="box">
       {{Session::get('successMessage')}}
      </div>
    @endif
    <table id="datatable" class="table">
        <thead>
            <tr class="bg-light">
                <th>Full Name</th>
                <th>Email</th>
                <th>Mobile Number</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tfoot style="display:table-header-group;">
            <tr>
                <th>Full Name</th>
                <th>Email</th>
                <th>Mobile Number</th>
                <th>Status</th>
            </tr>  
            </tfoot>
            <tbody>
            @foreach($data as $index=>$a)
            <tr>			
                <td>{{$a->name}}</td>
                <td>{{$a->email}}</td>
                <td>{{$a->mobilenumber}}</td>
                <td>@if($a->email_verified_at=='')
                    <div class="bg-danger py-1 border border-primary rounded-pill text-center ">
                        <span  >Inactive</span>
                    </div>
                    @else
                    <div class="bg-success py-1 border border-primary rounded-pill text-center">
                        <span class="text-center">Active</span>
                    </div>
                   
                    @endif
                </td>
                <td>
                    <div class="d-flex">
                        <a href="{{route('user.edit',['slug'=>$a->slug])}}"><button class="btn-sm btn-warning" data-toggle="tooltip" title='Edit User Email'><i class="fa fa-edit fa-1x"></i></button></a>
                        <form action="{{route('user.destroy',['slug'=>$a->slug])}}" method="POST">
                           @csrf
                           @method('delete')
                           <button class="btn-sm btn-danger mx-2 show_confirm" data-toggle="tooltip" title='Delete User'><i class="fa fa-trash fa-1x"></i></button>
                        </form>
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
          title: `Are you sure you want to delete the User?`,
          text: "If you delete this, it will be gone forever.",
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