@extends('master')

@section('content')

<!-- Breadcrumb -->
<ol class="breadcrumb hidden-xs">
    <li><a href="#">Home</a></li>
    <li class="active">Console</li>
</ol>

<h4 class="page-title">Console</h4>



  <!-- Quick Stats -->
<div class="block-area">
    <div class="row">
        <div class="col-md-3 col-xs-6">
            <div class="tile quick-stats">
                <div id="stats-line-2" class="pull-left"></div>
                <div class="data">
                    <h2 data-value="{{ count($numberCases,0)}}">0</h2>
                    <small>Cases Reported </small>
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
@include('addressbook.add')
@include('casenotes.add')


@endsection

@section('footer')

 <script>
  $(document).ready(function() {

  $("#addresses").tokenInput("getContacts");



  $('#message').maxlength({
            alwaysShow: true,
            threshold: 10,
            warningClass: "label label-success",
            limitReachedClass: "label label-danger"
  });

  $('#caseNote').maxlength({
            alwaysShow: true,
            threshold: 10,
            warningClass: "label label-success",
            limitReachedClass: "label label-danger"
  });

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




     var oTableCaseNotes,oTableCaseResponders,oTableAddressBook,oTableCaseActivities;



     $("#submitAddCaseNoteForm").on("click",function(){


        var caseId   = $("#modalAddCaseNotesModal #caseID").val();
        var uid      = $("#modalAddCaseNotesModal #uid").val();
        var token    = $('input[name="_token"]').val();
        var caseNote = $("#modalAddCaseNotesModal #caseNote").val();
        var formData = { caseID:caseId,caseNote:caseNote,uid:uid};
        $('#modalAddCaseNotesModal').modal('toggle');

        $.ajax({
        type    :"POST",
        data    : formData,
        headers : { 'X-CSRF-Token': token },
        url     :"{!! url('/addCaseNote')!!}",
        success : function(){
          launchCaseModal(caseId);
          $('#modalCase').modal('toggle');
        }
       })

     });

      $("#submitAddContactForm").on("click",function(){


        var FirstName = $("#modalAddContactModal #FirstName").val();
        var Surname   = $("#modalAddContactModal #Surname").val();
        var email     = $("#modalAddContactModal #email").val();
        var cellphone = $("#modalAddContactModal #cellphone").val();
        var uid       = $("#modalAddContactModal #uid").val();
        var token     = $('input[name="_token"]').val();
        var formData  = { FirstName:FirstName,Surname:Surname,email:email,cellphone:cellphone,uid:uid};

        $('#modalAddContactModal').modal('toggle');

        $.ajax({
        type    :"POST",
        data    : formData,
        headers : { 'X-CSRF-Token': token },
        url     :"{!! url('/addContact')!!}",
        success : function(){
           launchAddressBookModal();
           $('#modalAddressBook').modal('toggle');
        }

    })

     });


     $("#submitEscalateCaseForm").on("click",function(){

        var addresses = $("#modalReferCase #addresses").val();
        var message   = $("#modalReferCase #message").val();
        var caseID    = $("#modalReferCase #caseID").val();
        var token     = $('input[name="_token"]').val();
        var formData  = { addresses:addresses,message:message,caseID:caseID};

        $('#modalReferCase').modal('toggle');

        $.ajax({
        type    :"POST",
        data    : formData,
        headers : { 'X-CSRF-Token': token },
        url     :"{!! url('/escalateCase')!!}",
        success : function(){
          launchCaseModal(caseID);
          $('#modalCase').modal('toggle');
        }

    })

     });

      $("#closeReferCase").on("click",function(){

        $('#modalReferCase').modal('toggle');
        var caseId       = $("#modalReferCase #caseID").val();
        launchCaseModal(caseId);
        $('#modalCase').modal('toggle');

      });

      $("#closeCaseNote").on("click",function(){

        $('#modalAddCaseNotesModal').modal('toggle');
        var caseId       = $("#modalReferCase #caseID").val();
        launchCaseModal(caseId);
        $('#modalCase').modal('toggle');

      });

      $("#closeListContactModal").on("click",function(){

        $('#modalAddressBook').modal('toggle');
        $('#modalReferCase').modal('show');

      });

      $("#closeAddContactModal").on("click",function(){

        $('#modalAddContactModal').modal('toggle');
        $('#modalAddressBook').modal('show');

      });





   });




 @include('functions.caseModal')



    function launchReferModal()
    {

      $('#modalCase').modal('toggle');


    }

    function launchAddressBookModal()
    {

      $('#modalReferCase').modal('toggle');
       if ( $.fn.dataTable.isDataTable( '#addressBookTable' ) ) {
                    oTableAddressBook.destroy();
        }


      var user = {!! Auth::user()->id !!};
      oTableAddressBook     = $('#addressBookTable').DataTable({
            "processing": true,
            "serverSide": true,
            "dom": 'T<"clear">lfrtip',
            "order" :[[0,"desc"]],
            "ajax": "{!! url('/addressbook-list/" + user +"')!!}",
             "columns": [
            {data: 'FirstName', name: 'FirstName'},
            {data: 'Surname', name: 'Surname'},
            {data: 'cellphone', name: 'cellphone'},
            {data: 'email', name: 'email'},
            {data: 'actions',  name: 'actions'},
           ],

        "aoColumnDefs": [
            { "bSearchable": false, "aTargets": [ 1] },
            { "bSortable": false, "aTargets": [ 1 ] }
        ]

     });


    }

    function launchAddContactModal()
    {

      $('#modalAddressBook').modal('toggle');

    }

    function launchCaseNotesModal(id)
    {

      $('#modalCase').modal('hide');
      $('#modalAddCaseNotesModal').modal('toggle');



    }

    function acceptCase()
    {

      var id = $(".modal-body #caseID").val();

      $.ajax({
        type    :"GET",
        url     :"{!! url('/acceptCase/" + id +"')!!}",
        success : function(){
          launchCaseModal(id);
          $('#modalCase').modal('show');
        }
       })

    }

  @if (count($errors) > 0)

      $('#modalAddContactModal').modal('show');

  @endif

</script>
@endsection

