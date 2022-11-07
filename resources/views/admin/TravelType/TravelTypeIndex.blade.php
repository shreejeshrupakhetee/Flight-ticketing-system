@extends('layouts.admin')
@section('admin-content')
@section('title'){{ 'All Travels Type'}}@endsection
<div class="container">
    @if(Session::has('successMessage'))
    <div class="alert alert-success" role="alert" id="box">
       {{Session::get('successMessage')}}
      </div>
    @endif
    <div class="d-flex bg-light p-2 justify-content-between">
        <h1>All Flight Type</h1>
        <a href="{{route('traveltype.create')}}"><button class="btn btn">Add Flight Type</button></a>
    </div>
    <table id="datatable" class="table">
        <thead>
            <tr class="bg-light">
                <th>S.No</th>
                <th>Travel Type</th>
                <th>Action</th>
            </tr>
            </thead>
            <tfoot style="display:table-header-group;">
            <tr>
                <th>S.No</th>
                <th>Flight Type</th>
            </tr>  
            </tfoot>
            <tbody>
            @foreach($data as $index=>$a)
            <tr>					
                <td>{{++$index}}</td>
                <td>{{$a->flight_type_name}}</td>
                <td>
                    <div class="d-flex">
                        <a href="{{route('traveltype.edit',['traveltype'=>$a->slug])}}"><button class="btn-sm btn" data-toggle="tooltip" title='Edit Product'>Edit</button></a>
                        <form action="{{route('traveltype.destroy',['traveltype'=>$a->slug])}}" method="POST">
                           @csrf
                           @method('delete')
                           @method('delete')
                           <button class="btn-sm btn mx-2 show_confirm" data-toggle="tooltip" title='Delete Product'>Delete</button>
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
          title: `Are you sure you want to delete this Product?`,
          text: "If you delete this, it will permantely Deleted.",
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