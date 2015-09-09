
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
                {data: 'id', name: 'cases.id'},
                {data: 'created_at', name: 'cases.created_at'},
                {data: function(d){

                    return d.description;

                },"name" : 'cases.description',"width":"35%" },
                {data: 'cases.status', name: 'status'},
                {data: 'actions',  name: 'actions'},
               ],

            "aoColumnDefs": [
                { "bSearchable": false, "aTargets": [ 4] },
                { "bSortable": false, "aTargets": [ 4 ] }
            ]

         });




     var oTableCaseNotes,oTableCaseResponders,oTableAddressBook,oTableCaseActivities,oTableAddress;



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


    $("#submitAddContact").on("click",function(){


        var FirstName = $("#modalAddContact #FirstName").val();
        var Surname   = $("#modalAddContact #Surname").val();
        var email     = $("#modalAddContact #email").val();
        var cellphone = $("#modalAddContact #cellphone").val();
        var uid       = $("#modalAddContact #uid").val();
        var token     = $('input[name="_token"]').val();
        var formData  = { FirstName:FirstName,Surname:Surname,email:email,cellphone:cellphone,uid:uid};

        $('#modalAddContact').modal('toggle');

        $.ajax({
        type    :"POST",
        data    : formData,
        headers : { 'X-CSRF-Token': token },
        url     :"{!! url('/addContact')!!}",
        success : function(){
           launchAddress();
           $('#modalAddress').modal('toggle');
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

      $("#closeAddContact").on("click",function(){

        $('#modalAddContact').modal('toggle');
        $('#modalAddress').modal('show');

      });





   });

   function launchCaseModal(id)
    {

      $( "#acceptCaseClass" ).removeClass( "hidden" );
      $(".modal-body #categoryID").val(id);
      $(".modal-body #caseID").val(id);
      var userID = {!! Auth::user()->id !!};
      $.ajax({
        type    :"GET",
        dataType:"json",
        url     :"{!! url('/caseOwner/"+ id + "/" + userID + "')!!}",
        success :function(data) {

           if(data == 1)
           {

              $( "#acceptCaseClass" ).addClass( "hidden" );
           }
        }
        }
        )

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
               $("#modalCase #CaseImageA").attr("href",ImgUrl);

               $('a[class*="pirobox"]').piroBox_ext({
                    piro_speed : 900,
                    bg_alpha : 0.1,
                    piro_scroll : true //pirobox always positioned at the center of the page
               });
               $("#modalCase #CaseImage").attr("src",ImgUrl);
               $("#modalCase #reporter").val(data[0].reporter);
               $("#modalCase #reporterCell").val(data[0].reporterCell);
               $("#modalCase #reporterPosition").val(data[0].reporterPosition);

            }
            else {
               $("#modalCase #name").val('');
            }

        }
    })

          if ( $.fn.dataTable.isDataTable( '#caseNotesTable' ) ) {
                    oTableCaseNotes.destroy();
          }



          oTableCaseNotes     = $('#caseNotesTable').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "pageLength": 8,
                        "dom": 'T<"clear">lfrtip',
                        "order" :[[0,"desc"]],
                        "ajax": "{!! url('/caseNotes-list/" + id +"')!!}",
                         "columns": [
                        {data: 'created_at', name: 'created_at'},
                        {data: 'user', name: 'user'},
                        {data: 'note', name: 'note'}
                       ],

                    "aoColumnDefs": [
                        { "bSearchable": false, "aTargets": [ 1] },
                        { "bSortable": false, "aTargets": [ 1 ] }
                    ]

                 });


          if ( $.fn.dataTable.isDataTable( '#caseActivities' ) ) {
                    oTableCaseActivities.destroy();
          }



          oTableCaseActivities     = $('#caseActivities').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "pageLength": 8,
                        "dom": 'T<"clear">lfrtip',
                        "order" :[[0,"desc"]],
                        "ajax": "{!! url('/caseActivities-list/" + id +"')!!}",
                         "columns": [
                        {data: 'created_at', name: 'created_at'},
                        {data: 'note', name: 'note'}
                       ],

                    "aoColumnDefs": [
                        { "bSearchable": false, "aTargets": [ 1] },
                        { "bSortable": false, "aTargets": [ 1 ] }
                    ]

                 });




    if ( $.fn.dataTable.isDataTable( '#caseResponders' ) ) {
      oTableCaseResponders.destroy();
    }



     oTableCaseResponders     = $('#caseResponders').DataTable({
                  "processing": true,
                  "serverSide": true,
                  "pageLength": 8,
                  "dom": 'T<"clear">lfrtip',
                  "order" :[[0,"asc"]],
                  "ajax": "{!! url('/caseResponders-list/" + id +"')!!}",
                   "columns": [


                  {data: function(d){

                    if (d.type  == 1 )
                    {
                        return "First Responder";
                    }

                    if (d.type  == 0 )
                    {
                        return "Reporter";
                    }

                    if (d.type  == 2 )
                    {
                        return "Second Responder";
                    }

                    if (d.type  == 3 )
                    {
                        return "Third Responder";
                    }

                    if (d.type  == 4  )
                    {
                        return "Escalation";
                    }



                  },"name" : 'type'},



                  {data: 'name', name: 'name'},
                  {data: 'surname', name: 'surname'},
                  {data: 'position', name: 'position'},
                  {data: 'cellphone', name: 'cellphone'},

                  {data: function(d){

                    if (d.accept  == 1 )
                    {
                        return "yes";
                    }
                    else {

                        return "no";
                    }

                  },"name" : 'accept'},

                  {data: 'actions', name: 'actions'},


                 ],

              "aoColumnDefs": [
                  { "bSearchable": false, "aTargets": [ 1] },
                  { "bSortable": false, "aTargets": [ 1 ] }
              ]

    });


    }

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
            {data: 'created_at', name: 'created_at'},
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

     function launchAddress()
    {



       if ( $.fn.dataTable.isDataTable( '#addressBook' ) ) {
                    oTableAddress.destroy();
        }


      var user = {!! Auth::user()->id !!};
      oTableAddress     = $('#addressBook').DataTable({
            "processing": true,
            "serverSide": true,
            "dom": 'T<"clear">lfrtip',
            "order" :[[0,"desc"]],
            "ajax": "{!! url('/addressbook-list/" + user +"')!!}",
             "columns": [
            {data: 'created_at', name: 'created_at'},
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

    function launchMessageModal()
    {

      $('#modalCase').modal('toggle');

    }

    function launchAddContact()
    {

      $('#modalAddress').modal('toggle');

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

    </script>



