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
    <h3 class="block-title">Toggle columns</h3>

    <div>
Toggle column:
<a class="toggle-vis" data-column="0">ID</a>
-
<a class="toggle-vis" data-column="1">Created At</a>
-
<a class="toggle-vis" data-column="2">Description</a>
-
<a class="toggle-vis" data-column="3">Business Unit</a>
-
<a class="toggle-vis" data-column="4">Precinct</a>
-
<a class="toggle-vis" data-column="5">Reporter</a>
-
<a class="toggle-vis" data-column="6">Category</a>
-
<a class="toggle-vis" data-column="7">Priority</a>
-
<a class="toggle-vis" data-column="8">Severity</a>
-
<a class="toggle-vis" data-column="9">Status</a>
</div>

<h3 class="block-title">FILTERS</h3>

{!! Form::open(['url' => '#', 'method' => 'post', 'class' => 'form-horizontal', 'id'=>"filterReportsForm" ]) !!}
<div class="row">
      <div class="col-md-4 m-b-15">
          <p>From:</p>
          <div class="input-icon datetime-pick date-only">
              <input data-format="yyyy-MM-dd" type="text" id='fromDate' name ='fromDate' class="form-control input-sm" />
              <span class="add-on">
                  <i class="sa-plus"></i>
              </span>
          </div>
      </div>

      <div class="col-md-4 m-b-15">
          <p>To:</p>
          <div class="input-icon datetime-pick date-only">
              <input data-format="yyyy-MM-dd" type="text" id='toDate' name ='toDate' class="form-control input-sm" />
              <span class="add-on">
                  <i class="sa-plus"></i>
              </span>
          </div>
      </div>
</div>
<br/>

<div class="row">

      <div class="col-md-4 m-b-15">
          <p>Precinct:</p>
           <div class="p-relative">
              {!! Form::select('precinct',$selectMunicipalities,0,['class' => 'form-control input-sm' ,'id' => 'precinct']) !!}
          </div>
      </div>

      <div class="col-md-4 m-b-15">
          <p>Business Unit:</p>
          <div class="p-relative">
              {!! Form::select('department',$selectDepartments,0,['class' => 'form-control input-sm' ,'id' => 'department']) !!}
          </div>
      </div>

</div>

<br/>

<div class="row">

      <div class="col-md-4 m-b-15">
          <p>Category:</p>
           <div class="p-relative">
              {!! Form::select('category',$selectCategories,0,['class' => 'form-control input-sm' ,'id' => 'category']) !!}
          </div>
      </div>

      <div class="col-md-4 m-b-15">
          <p>Status:</p>
          <div class="p-relative">
              {!! Form::select('status',[
                                          '0'                 => 'Select / All',
                                          'Pending'           => 'Pending',
                                          'Pending Closure'   => 'Pending Closure',
                                          'Referred'          => 'Referred',
                                          'Resolved'          => 'Resolved'
                                        ],0,['class' => 'form-control input-sm' ,'id' => 'status']) !!}
          </div>
      </div>

      <div class="col-md-4 m-b-15">
          <p>Reporter:</p>
           <div class="p-relative">
              {!! Form::select('reporter',$selectReporters,0,['class' => 'form-control input-sm' ,'id' => 'reporter']) !!}
          </div>
      </div>

</div>

<br/>


  <div class="row">
        <div class="col-md-4 m-b-15">


            <div class="p-relative">

                   <a type="#" id='submitFilters' class="btn btn-sm">Generate Report</a>

            </div>

        </div>


</div>
{!! Form::close() !!}

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
                    <th>Description </th>
                    <th>Precinct</th>
                    <th>Business Unit</th>
                    <th>Reporter</th>
                    <th>Category</th>
                    <th>Priority</th>
                    <th>Severity</th>
                    <th>Status</th>
              </tr>
            </thead>
            <!--  <tfoot>
              <tr>
                    <th>Id</th>
                    <th>Created At</th>
                    <th>Description </th>
                    <th>Business Unit</th>
                    <th>Precinct</th>
                    <th>Reporter</th>
                    <th>Category</th>
                    <th>Priority</th>
                    <th>Severity</th>
                    <th>Status</th>
              </tr>
            </tfoot> -->
        </table>
    </div>
</div>
@endsection

@section('footer')

 <script>
 $(document).ready(function() {


   var oReportsTable;

    $('a.toggle-vis').on( 'click', function (e) {
        e.preventDefault();

        // Get the column API object
        var column = oReportsTable.column( $(this).attr('data-column') );

        // Toggle the visibility
        column.visible( ! column.visible() );
    });

/*  var oReportsTable     = $('#reportsTable').DataTable({
                "processing": true,
                "serverSide": true,
                "bSearchable": true,
                "bPaginate" : false,
                "dom": '<"toolbar">frtip',
                "order" :[[0,"desc"]],
                "ajax": "{!! url('/reports-list/')!!}",
                 "columns": [
                {data: 'id', name: 'cases.id'},
                {data: 'created_at', name: 'cases.created_at'},
                {data: 'description', name: 'cases.description'},
                {data: 'department', name: 'departments.name'},
                {data: 'precinct', name: 'municipalities.name'},
                {data: 'reporterName', name: 'reporterName'},
                {data: 'category', name: 'categories.name'},
                {data: 'priority', name: 'cases.priority'},
                {data: 'severity', name: 'cases.severity'},
                {data: 'status',  name: 'cases.status'}

               ],

          "initComplete": function () {

            this.api().columns().every( function () {
                var column = this;
                var select = $('<select class="form-control"><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search( val ? val: '', true, false )
                            .draw();

                          console.log(val);
                    } );

                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
          }

         });
*/
   /* var html = "<div class='row'>";
      html += " <div class='col-md-2 m-b-15'>";
      html += " <select class='select'><option>Default</option></select>";
      html += " </div>";
      html += " <div class='col-md-2 m-b-15'>";
      html += " <select class='select'><option>Default</option></select>";
      html += " </div>";
      html += " </div>";*/

   /* $("div.toolbar").html("");*/



  });


</script>
@endsection
