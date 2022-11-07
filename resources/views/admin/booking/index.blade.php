@extends('layouts.admin')
@section('admin-content')
@section('title'){{ 'All Bookings'}}@endsection
<div class="container-fluid">
    @if(Session::has('successMessage'))
    <div class="alert alert-success" role="alert" id="box">
       {{Session::get('successMessage')}}
      </div>
    @endif
    <div class="d-flex bg-light p-2 justify-content-between">
        <h1>All Booked Tickets</h1>
    </div>
    <table id="datatable" class="table">
        <thead>
            <tr class="bg-light">
                <th>S.No</th>
                <th>User Name</th>
                <th>No of Seats</th>
                <th>Travel Id</th>
                <th>Total Amount</th>
                <th>Action</th>
            </tr>
            </thead>
            <tfoot style="display:table-header-group;">
            <tr>
                <th>S.No</th>
                <th>User Name</th>
                <th>No of Seats</th>
                <th>Travel Id</th>
                <th>Total Amount</th>
            </tr>  
            </tfoot>
            <tbody>
            @foreach($data as $index=>$a)
            <tr>			
                <td>{{++$index}}</td>
                <td>{{$a->users->name}}</td>
                <td>{{$a->no_of_seats}}</td>
                <td>{{$a->travel_id}}</td>
                <td>Rs. {{$a->total_amount}}</td>
                <td>
                    <div class="d-flex">
                        <form action="{{route('booked.destroy',['slug'=>$a->id])}}" method="POST">
                           @csrf
                           @method('delete')
                           <button class="btn-sm btn-danger mx-2" data-toggle="tooltip" title='Delete Booked'><i class="fa fa-trash fa-1x"></i></button>
                        </form>
                    </div>
                    </td>
            </tr>
            @endforeach
            </tbody>
        </table>

</div>
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


  setTimeout(() => {
const box = document.getElementById('box');
box.style.display = 'none';
}, 1000);
</script>
@endsection