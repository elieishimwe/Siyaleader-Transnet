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

   function launchModal(id,sender)
    {

      $(".modal-body #rapID").val(id);

      $(':input','.form')
      .not(':button, :submit, :reset, :hidden')
      .val('')
      .removeAttr('checked')
      .removeAttr('selected');

       $('#formErrorsRegistrationMember').val('1');
       $(".modal-body #MMCELLMember").val(sender);
       $('#formErrorsReport').val('0');
        var cell = $("#case_" + id ).data('mmcell');
        $.ajax({
        type    :"GET",
        dataType:"json",
        url     :"{!! url('/members/"+ cell + "')!!}",
        data    :{ option:cell },
        success :function(data) {

            if(data[0] !== null)
            {

               $("#bs-registration-modal-member #Fname").val(data[0].Fname);
               $("#bs-registration-modal-member #Sname").val(data[0].Sname);
               $("#bs-registration-modal-member #House").val(data[0].House);
               $("#bs-registration-modal-member #Area").val(data[0].Area);
               $("#bs-registration-modal-member #IDnumber").val(data[0].IDnumber);
               $("#bs-registration-modal-member #Province").val(data[0].Province);
               $("#bs-registration-modal-member #District").val(data[0].District);
               $("#bs-registration-modal-member #Municipality").val(data[0].Municipality);
               $("#bs-registration-modal-member #Ward").val(data[0].Ward);
               $("#bs-registration-modal-member #Position").val(data[0].Position);
               $("#bs-registration-modal-member #Department").val(data[0].Department);
               $("#bs-registration-modal-member #Cell1").val(data[0].Cell1);
               $("#bs-registration-modal-member #Cell1Make").val(data[0].Cell1Make);
               $("#bs-registration-modal-member #Cell1Network").val(data[0].Cell1Network);
               $("#bs-registration-modal-member #Cell1Type").val(data[0].Cell1Type);
               $("#bs-registration-modal-member #Cell2").val(data[0].Cell2);
               $("#bs-registration-modal-member #Cell2Make").val(data[0].Cell2Make);
               $("#bs-registration-modal-member #Cell2Network").val(data[0].Cell2Network);
               $("#bs-registration-modal-member #Cell2Type").val(data[0].Cell2Type);
               $("#bs-registration-modal-member #Email").val(data[0].Email);
               $("#bs-registration-modal-member #Cell2Network").val(data[0].Cell2Network);
               $("#bs-registration-modal-member #SupName").val(data[0].SupName);
               $("#bs-registration-modal-member #SupCell").val(data[0].SupCell);
               $("#bs-registration-modal-member #CDWName").val(data[0].CDWName);
               $("#bs-registration-modal-member #CDWCell").val(data[0].CDWCell);
               $("#bs-registration-modal-member #CouncillorName").val(data[0].CouncillorName);
               $("#bs-registration-modal-member #CouncillorCell").val(data[0].CouncillorCell);

            }
            else {
               $("#bs-registration-modal-member #Sname").val('');
               $("#bs-registration-modal-member #Fname").val('');
               $("#bs-registration-modal-member #House").val('');
               $("#bs-registration-modal-member #Area").val('');
               $("#bs-registration-modal-member #IDnumber").val('');
               $("#bs-registration-modal-member #Province").val('');
               $("#bs-registration-modal-member #District").val('');
               $("#bs-registration-modal-member #Municipality").val('');
               $("#bs-registration-modal-member #Ward").val('');
               $("#bs-registration-modal-member #Position").val('');
               $("#bs-registration-modal-member #Department").val('');
               $("#bs-registration-modal-member #Cell1").val('');
               $("#bs-registration-modal-member #Cell1Make").val('');
               $("#bs-registration-modal-member #Cell1Network").val('');
               $("#bs-registration-modal-member #Cell1Type").val('');
               $("#bs-registration-modal-member #Cell2").val('');
               $("#bs-registration-modal-member #Cell2Make").val('');
               $("#bs-registration-modal-member #Cell2Network").val('');
               $("#bs-registration-modal-member #Cell2Type").val('');
               $("#bs-registration-modal-member #Email").val('');
               $("#bs-registration-modal-member #Cell2Network").val('');
               $("#bs-registration-modal-member #SupName").val('');
               $("#bs-registration-modal-member #SupCell").val('');
               $("#bs-registration-modal-member #CDWName").val('');
               $("#bs-registration-modal-member #CDWCell").val('');
               $("#bs-registration-modal-member #CouncillorName").val('');
               $("#bs-registration-modal-member #CouncillorCell").val('');

            }

        }
    });

    }
</script>
@endsection
