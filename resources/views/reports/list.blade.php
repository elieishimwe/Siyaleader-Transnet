@extends('master')

@section('content')
<!-- Breadcrumb -->
<ol class="breadcrumb hidden-xs">
    <li><a href="#">Administration</a></li>
    <li><a href="#">Reports</a></li>
    <li class="active">Reports</li>
</ol>

<h4 class="page-title">Reports</h4>
<!-- Alternative -->
<div class="block-area" id="alternative-buttons">
    <h3 class="block-title">Toggle column:</h3>

    <div>
Toggle column:
<a class="toggle-vis" data-column="0">ID</a>
-
<a class="toggle-vis" data-column="1">Created At</a>
-
<a class="toggle-vis" data-column="2">Business Unit</a>
-
<a class="toggle-vis" data-column="3">Precinct</a>
-
<a class="toggle-vis" data-column="4">Reporter</a>
-
<a class="toggle-vis" data-column="5">Category</a>
-
<a class="toggle-vis" data-column="6">Priority</a>
-
<a class="toggle-vis" data-column="7">Severity</a>
-
<a class="toggle-vis" data-column="8">Status</a>
</div>

</div>

<!-- Responsive Table -->
<div class="block-area" id="responsiveTable">
    @if(Session::has('success'))
      <div class="status alert alert-danger">
          {{ Session::get('success') }}
      </div>
    @endif
    <div class="table-responsive overflow">
        <table class="table tile table-striped" id="reportsTable">
            <thead>
              <tr>
                    <th>Id</th>
                    <th>Created At</th>
                    <th>Business Unit</th>
                    <th>Precinct</th>
                    <th>Reporter</th>
                    <th>Category</th>
                    <th>Priority</th>
                    <th>Severity</th>
                    <th>Status</th>
              </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('footer')

 <script>
 $(document).ready(function() {

  var oTable     = $('#reportsTable').DataTable({
                "processing": true,
                "serverSide": true,
                "dom": 'T<"clear">lfrtip',
                "order" :[[0,"desc"]],
                "ajax": "{!! url('/reports-list/')!!}",
                 "columns": [
                {data: 'id', name: 'id'},
                {data: 'created_at', name: 'created_at'},
                {data: 'department', name: 'department'},
                {data: 'precinct', name: 'precinct'},
                {data: 'reporter', name: 'reporter'},
                {data: 'category', name: 'category'},
                {data: 'priority', name: 'priority'},
                {data: 'severity', name: 'severity'},
                {data: 'status',  name: 'status'}

               ],

            "aoColumnDefs": [
                { "bSearchable": false, "aTargets": [ 6 ] },
                { "bSortable": false, "aTargets": [ 6 ] }
            ]

         });

    $('a.toggle-vis').on( 'click', function (e) {
        e.preventDefault();

        // Get the column API object
        var column = oTable.column( $(this).attr('data-column') );

        // Toggle the visibility
        column.visible( ! column.visible() );
    });

  });
</script>
@endsection
