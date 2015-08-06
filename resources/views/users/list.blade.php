@extends('master')

@section('content')
<!-- Breadcrumb -->
<ol class="breadcrumb hidden-xs">
    <li><a href="#">Administration</a></li>
    <li><a href="#">Users</a></li>
    <li class="active">Users Listing</li>
</ol>

<h4 class="page-title">USERS</h4>
<!-- Alternative -->
<div class="block-area" id="alternative-buttons">
    <h3 class="block-title">Users Listing</h3>
    <a href="{{ url('add-user') }}" class="btn btn-sm">
       Add User
    </a>
</div>

<!-- Responsive Table -->
<div class="block-area" id="responsiveTable">
    @if(Session::has('success'))
      <div class="status alert alert-danger">
          {{ Session::get('success') }}
      </div>
    @endif
    <div class="table-responsive overflow">
        <table class="table tile table-striped" id="usersTable">
            <thead>
              <tr>
                    <th>Id</th>
                    <th>Created At</th>
                    <th>First Name</th>
                    <th>Surname</th>
                    <th>Cell Number</th>
                    <th>Position</th>
                    <th>Port</th>
                    <th>Precinct</th>
              </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('footer')

 <script>
    $(document).ready(function() {

  var oTable     = $('#usersTable').DataTable({
                "processing": true,
                "serverSide": true,
                "dom": 'T<"clear">lfrtip',
                "order" :[[0,"desc"]],
                "ajax": "{!! url('/users-list/')!!}",
                 "columns": [
                {data: 'ID', name: 'ID'},
                {data: 'created_at', name: 'created_at'},
                {data: 'Fname', name: 'Fname'},
                {data: 'Sname', name: 'Sname'},
                {data: 'Cell1', name: 'Cell1'},
                {data: 'Position', name: 'Position'},
                {data: 'District', name: 'District'},
                {data: 'Municipality', name: 'Municipality'},
               ],

            "aoColumnDefs": [
                { "bSearchable": false, "aTargets": [ 4 ] },
                { "bSortable": false, "aTargets": [ 4 ] }
            ]

         });

  });
</script>
@endsection
