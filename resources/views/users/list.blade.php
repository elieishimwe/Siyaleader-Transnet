@extends('master')

@section('content')

  <div class="outer">
          <div class="inner bg-light lter">

            <!--Begin Datatables-->
            <div class="row">
              <div class="col-lg-12">
                @if(Session::has('success'))
                    <div class="status alert alert-danger">
                        {{ Session::get('success') }}
                    </div>
                @endif
                <div class="box">
                  <header>
                    <div class="icons">
                      <i class="fa fa-table"></i>
                    </div>
                    <h5>TRANSNET USERS</h5>
                     <div class="toolbar">
                      <div class="btn-group">

                        <a href="add-user"  class="btn btn-default btn-sm">
                          Add User
                          <i class="fa fa-plus"></i>
                        </a>
                      </div>
                    </div>
                  </header>
                  <div id="collapse4" class="body">
                    <div class='table-responsive'>
                    <table id="usersTable" class="table table-bordered table-condensed table-hover table-striped">
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
                </div>
              </div>
            </div><!-- /.row -->

            <!--End Datatables-->
          </div><!-- /.inner -->
        </div><!-- /.outer -->
@endsection

@section('footer')

 <script>
    $(document).ready(function() {

  var oTable      = $('#usersTable').DataTable({
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
