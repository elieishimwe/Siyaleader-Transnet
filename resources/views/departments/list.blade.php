@extends('master')

@section('content')
<!-- Breadcrumb -->
<ol class="breadcrumb hidden-xs">
    <li><a href="#">Administration</a></li>
    <li><a href="#">Categories</a></li>
    <li class="active">Categories Listing</li>
</ol>

<h4 class="page-title">CATEGORIES</h4>
<!-- Alternative -->
<div class="block-area" id="alternative-buttons">
    <h3 class="block-title">Business Units Listing</h3>
    <a href="{{ url('add-user') }}" class="btn btn-sm">
       Add Business Unit
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
        <table class="table tile table-striped" id="departmentsTable">
            <thead>
              <tr>
                    <th>Id</th>
                    <th>Created At</th>
                    <th>Name</th>
                    <th>Actions</th>
              </tr>
            </thead>
        </table>
    </div>
</div>
@include('departments.edit')
@endsection

@section('footer')

 <script>
  $(document).ready(function() {

  var oTable     = $('#departmentsTable').DataTable({
                "processing": true,
                "serverSide": true,
                "dom": 'T<"clear">lfrtip',
                "order" :[[0,"desc"]],
                "ajax": "{!! url('/departments-list/')!!}",
                 "columns": [
                {data: 'id', name: 'id'},
                {data: 'created_at', name: 'created_at'},
                {data: 'name', name: 'name'},
                {data: 'actions',  name: 'actions'},
               ],

            "aoColumnDefs": [
                { "bSearchable": false, "aTargets": [ 1] },
                { "bSortable": false, "aTargets": [ 1 ] }
            ]

         });

  });

   function launchModal(id,name)
    {

      $(".modal-body #rapID").val(id);

      $(':input','.form')
      .not(':button, :submit, :reset, :hidden')
      .val('')
      .removeAttr('checked')
      .removeAttr('selected');

       $('#formErrorsRegistrationMember').val('1');
       $(".modal-body #MMCELLMember").val(name);
       $('#formErrorsReport').val('0');
        var cell = $("#case_" + id ).data('mmcell');
        $.ajax({
        type    :"GET",
        dataType:"json",
        url     :"{!! url('/departments/"+ id + "')!!}",
        success :function(data) {

            if(data[0] !== null)
            {

               $("#modalDepartment #name").val(data[0].name);

            }
            else {
               $("#modalDepartment #name").val('');
            }

        }
    });

    }
</script>
@endsection
