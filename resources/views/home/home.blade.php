@extends('master')

@section('content')

<!-- Breadcrumb -->
<ol class="breadcrumb hidden-xs">
    <li><a href="#">Home</a></li>
    <li class="active">Dashboard</li>
</ol>

<h4 class="page-title">DASHBOARD</h4>



  <!-- Quick Stats -->
<div class="block-area">
    <div class="row">
        <div class="col-md-3 col-xs-6">
            <div class="tile quick-stats">
                <div id="stats-line-2" class="pull-left"></div>
                <div class="data">
                    <h2 data-value="1">0</h2>
                    <small>Cases Reported Today</small>
                </div>
            </div>
        </div>

    </div>

</div>

<hr class="whiter" />

<!-- Responsive Table -->
<div class="block-area" id="responsiveTable">
    @if(Session::has('success'))
    <div class="alert alert-info alert-dismissable fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('success') }}
    </div>
    @endif
    <div class="table-responsive overflow">
        <table class="table tile table-striped" id="casesTable">
            <thead>
              <tr>
                    <th>Id</th>
                    <th>Created At</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Actions</th>
              </tr>
            </thead>
        </table>
    </div>
</div>

@include('cases.profile')
@include('cases.refer')
@include('addressbook.list')

@endsection

@section('footer')

 <script>
  $(document).ready(function() {

  var user = {!! Auth::user()->id !!};
  var oTable     = $('#casesTable').DataTable({
                "processing": true,
                "serverSide": true,
                "dom": 'T<"clear">lfrtip',
                "order" :[[0,"desc"]],
                "ajax": "{!! url('/cases-list/" + user +"')!!}",
                 "columns": [
                {data: 'id', name: 'id'},
                {data: 'created_at', name: 'created_at'},
                {data: 'description', name: 'description'},
                {data: 'status', name: 'status'},
                {data: 'actions',  name: 'actions'},
               ],

            "aoColumnDefs": [
                { "bSearchable": false, "aTargets": [ 1] },
                { "bSortable": false, "aTargets": [ 1 ] }
            ]

         });

  });

   function launchCaseModal(id)
    {

      $(".modal-body #categoryID").val(id);

        $.ajax({
        type    :"GET",
        dataType:"json",
        url     :"{!! url('/case/"+ id + "')!!}",
        success :function(data) {

            if(data[0] !== null)
            {

               $("#modalCase #id").val(data[0].id);
               $("#modalCase #description").val(data[0].description);
               $("#modalCase #category").val(data[0].category);
               $("#modalCase #sub_category").val(data[0].sub_category);
               $("#modalCase #sub_sub_category").val(data[0].sub_sub_category);
               $("#modalCase #status").val(data[0].status);
               $("#modalCase #department").val(data[0].department);
               var ImgUrl = "http://www.siyaleader.co.za:8080/ecin2edin/console/app_backend/port_backend/public/"+data[0].img_url;
               $("#modalCase #CaseImage").attr("src",ImgUrl);
               $("#modalCase #CaseImage").attr("data-img",ImgUrl);

            }
            else {
               $("#modalCase #name").val('');
            }

        }
    });

    }
    function launchReferModal()
    {

      $('#modalCase').modal('toggle');


    }

    function launchAddressBookModal()
    {

      $('#modalReferCase').modal('toggle');


    }
</script>
@endsection

