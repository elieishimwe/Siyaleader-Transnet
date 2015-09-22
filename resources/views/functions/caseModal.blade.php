
  <script>
  $(document).ready(function() {



  var activeTab = localStorage.getItem('activeTab');
  console.log(activeTab);
  $('#tabs a[href="#' + activeTab + '"]').tab('show');

  $("#addresses").tokenInput("getContacts");

  $("#acceptCaseClass").on("click",function(){

    $( "#acceptCaseClass" ).addClass( "hidden" );
  })

  $('#modalCase').on('hidden.bs.modal', function () {

      $('#fileManager').empty();
  })


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
                {data: 'status', name: 'cases.status'},
                {data: 'actions',  name: 'actions'},
               ],

            "aoColumnDefs": [
                { "bSearchable": false, "aTargets": [ 4] },
                { "bSortable": false, "aTargets": [ 4 ] }
            ]

  });

  var requestCasesClosureTable     = $('#deletedCasesTable').DataTable({
                "processing": true,
                "serverSide": true,
                "dom": 'T<"clear">lfrtip',
                "order" :[[0,"desc"]],
                "ajax": "{!! url('/request-cases-closure-list/')!!}",
                 "columns": [
                {data: 'id', name: 'cases.id'},
                {data: 'created_at', name: 'cases.created_at'},
                {data: function(d){

                    return d.description;

                },"name" : 'cases.description',"width":"35%" },
                {data: 'status', name: 'cases.status'},
                {data: 'actions',  name: 'actions'},
               ],

            "aoColumnDefs": [
                { "bSearchable": false, "aTargets": [ 4] },
                { "bSortable": false, "aTargets": [ 4 ] }
            ]

  });

  var resolvedCasesTable     = $('#resolvedCasesTable').DataTable({
                "processing": true,
                "serverSide": true,
                "dom": 'T<"clear">lfrtip',
                "order" :[[0,"desc"]],
                "ajax": "{!! url('/resolved-cases-list/')!!}",
                 "columns": [
                {data: 'id', name: 'cases.id'},
                {data: 'created_at', name: 'cases.created_at'},
                {data: function(d){

                    return d.description;

                },"name" : 'cases.description',"width":"35%" },
                {data: 'status', name: 'cases.status'},
                {data: 'actions',  name: 'actions'},
               ],

            "aoColumnDefs": [
                { "bSearchable": false, "aTargets": [ 4] },
                { "bSortable": false, "aTargets": [ 4 ] }
            ]

  });

   var pendingreferralCasesTable     = $('#pendingreferralCasesTable').DataTable({
                "processing": true,
                "serverSide": true,
                "dom": 'T<"clear">lfrtip',
                "order" :[[0,"desc"]],
                "ajax": "{!! url('/pending-referral-cases-list/')!!}",
                 "columns": [
                {data: 'id', name: 'cases.id'},
                {data: 'created_at', name: 'cases.created_at'},
                {data: function(d){

                    return d.description;

                },"name" : 'cases.description',"width":"35%" },
                {data: 'status', name: 'cases.status'},
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
        beforeSend : function() {
            HoldOn.open({
                theme:"sk-rect",//If not given or inexistent theme throws default theme sk-rect
                message: "<h4> loading please wait... ! </h4>",
                content:"Your HTML Content", // If theme is set to "custom", this property is available
                                             // this will replace the theme by something customized.
                backgroundColor:"none repeat scroll 0 0 rgba(0, 0, 0, 0.8)",//Change the background color of holdon with javascript
                           // Keep in mind is necessary the .css file too.
                textColor:"white" // Change the font color of the message
            });

        },
        success : function(data){

          if (data == 'ok') {

            $('#addCaseNoteForm')[0].reset();
            launchCaseModal(caseId);
            $("#caseNotesNotification").html('<div class="alert alert-success alert-icon">Well done! you case note has been successfully added <i class="icon">&#61845;</i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
            $('#modalCase').modal('toggle');
            HoldOn.close();

          }

        }
       })

     });

    $("#submitAddCaseFileForm").on("click",function(){

        var caseId   = $("#modalAddCaseFilesModal #caseID").val();
        var myForm   = $("#addCaseFileForm")[0];
        var formData = new FormData(myForm);
        var token    = $('input[name="_token"]').val();
        //$('#modalAddCaseFilesModal').modal('toggle');

        $.ajax({
        type    :"POST",
        data    : formData,
        contentType: false,
        processData: false,
        headers : { 'X-CSRF-Token': token },
        url     :"{!! url('/addCaseFile')!!}",
        beforeSend : function() {
            HoldOn.open({
                theme:"sk-rect",//If not given or inexistent theme throws default theme sk-rect
                message: "<h4> uploading please wait... ! </h4>",
                content:"Your HTML Content", // If theme is set to "custom", this property is available
                                             // this will replace the theme by something customized.
                backgroundColor:"none repeat scroll 0 0 rgba(0, 0, 0, 0.8)",//Change the background color of holdon with javascript
                           // Keep in mind is necessary the .css file too.
                textColor:"white" // Change the font color of the message
            });

        },
        success : function(data){

          if( data == 'ok')
          {
            $('#addCaseFileForm')[0].reset();
            $('#modalAddCaseFilesModal').modal('toggle');
            $("#caseNotesNotification").html('<div class="alert alert-success alert-icon">Well done! your file has been successfully uploaded <i class="icon">&#61845;</i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
            launchCaseModal(caseId);
            $('#modalCase').modal('toggle')
            HoldOn.close();

          }

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
        beforeSend : function() {
          HoldOn.open({
          theme:"sk-rect",//If not given or inexistent theme throws default theme sk-rect
          message: "<h4> loading please wait... ! </h4>",
          content:"Your HTML Content", // If theme is set to "custom", this property is available
                                       // this will replace the theme by something customized.
          backgroundColor:"none repeat scroll 0 0 rgba(0, 0, 0, 0.8)",//Change the background color of holdon with javascript
                     // Keep in mind is necessary the .css file too.
          textColor:"white" // Change the font color of the message
            });
        },
        success : function(data){

          if (data == 'ok') {
            $(".token-input-token").remove();
            $('#escalateCaseForm')[0].reset();
            $("#caseNotesNotification").html('<div class="alert alert-success alert-icon">Well done! You case has been successfully escalated <i class="icon">&#61845;</i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
            launchCaseModal(caseID);
            $('#modalCase').modal('toggle');
            HoldOn.close();

          }

        }

    })

     });

      $("#closeProfileCase").on("click",function(){

         var $tab = $('.tab-container'), $active = $tab.find('.tab-pane.active');

          $('#modalCase').modal('toggle');
          var tabId = $active[0].id;
          localStorage.setItem('activeTab', tabId);
          location.reload();





         /*if ($active[0].id == 'reported') {



         }
         else {

             $('#modalCase').modal('toggle');

         }*/


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

      $("#closeCaseFile").on("click",function(){

        $('#modalAddCaseFilesModal').modal('toggle');
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

      var options = {
          resizable : false,
          url : 'php/connector.minimal.php?folderId='+ id,
          commandsOptions : {
            info : {
              nullUrlDirLinkSelf : true,
              custom : {
                // /**
                //  * Example of custom info `desc`
                //  */
                  desc : {
                //  /**
                //   * Lable (require)
                //   * It is filtered by the `fm.i18n()`
                //   *
                //   * @type String
                //   */
                   label : 'Description',
                //
                //  /**
                //   * Template (require)
                //   * `{id}` is replaced in dialog.id
                //   *
                //   * @type String
                //   */
                    tpl : '<div class="elfinder-info-desc"><span class="elfinder-info-spinner"></span></div>',
                //
                //  /**
                //   * Restricts to mimetypes (optional)
                //   * Exact match or category match
                //   *
                //   * @type Array
                //   */

                //
                //  /**
                //   * Restricts to file.hash (optional)
                //   *
                //   * @ type Regex
                //   */
                     hashRegex : /^l\d+_/,
                //
                //  /**
                //   * Request that asks for the description and sets the field (optional)
                //   *
                //   * @type Function
                //   */
                      action : function(file, fm, dialog) {
                      var fileName = file.name;
                      $.ajax({
                        type    :"GET",
                        dataType:"json",
                        url     :"{!! url('/fileDescription/"+ id + "/"+ fileName +"')!!}",
                        success :function(data) {
                          console.log(data);
                          console.log(data.length);
                          dialog.find('div.elfinder-info-desc').html(data);

                        }
                     })

                     }
                    }
              }

            },
          },
          uiOptions : {
                      toolbar : [
                              ['reload'],
                              ['view', 'sort'],
                              ['search']
                      ]},
          contextmenu : {
                  // navbarfolder menu
                  navbar : ['copy', '|', 'info'],

                  // current directory menu
                  cwd    : ['reload','|', 'back', '|', 'info'],

                  // current directory file menu
                  files  : [
                      'getfile', '|','quicklook', '|', 'download', '|', 'copy',
                      '|', 'edit', 'resize', '|', 'info'
                  ]
              },

          height: 300,

          dragUploadAllow:false
      }


      var elfinder = new window.elFinder(document.getElementById('fileManager'), options);

      $('.elfinder-cwd-wrapper, .elfinder-navbar').niceScroll();

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

                     if (data[0].img_url) {

                        var ImgUrl = "http://www.siyaleader.co.za:8080/ecin2edin/console/app_backend/port_backend/public/"+data[0].img_url;
                        $("#modalCase #CaseImageA").attr("href",ImgUrl);

                     }

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
        }
        }
        )


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

                    if (d.type  == 5  )
                    {
                        return "Critical Team";
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

    function launchCaseFilesModal(id)
    {

      $('#modalCase').modal('hide');
      $('#modalAddCaseFilesModal').modal('toggle');



    }

    function acceptCase()
    {


      $('#modalCase').modal('toggle');
      var id = $(".modal-body #caseID").val();

      $.ajax({
        type    :"GET",
        url     :"{!! url('/acceptCase/" + id +"')!!}",
        beforeSend : function() {
            HoldOn.open({
                theme:"sk-rect",//If not given or inexistent theme throws default theme sk-rect
                message: "<h4>processing please wait... ! </h4>",
                content:"Your HTML Content", // If theme is set to "custom", this property is available
                                             // this will replace the theme by something customized.
                backgroundColor:"none repeat scroll 0 0 rgba(0, 0, 0, 0.8)",//Change the background color of holdon with javascript
                           // Keep in mind is necessary the .css file too.
                textColor:"white" // Change the font color of the message
            });

        },
        success : function(data){

          if (data == "ok") {

              $("#caseNotesNotification").html('<div class="alert alert-success alert-icon">Well done! You successfully accepted case ' + id +'<i class="icon">&#61845;</i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
              launchCaseModal(id);
              $('#modalCase').modal('show');
              HoldOn.close()

          }


        }
       })

    }

    function closeCase() {


      $('#modalCase').modal('toggle');
      var id = $(".modal-body #caseID").val();

      $.ajax({
        type    :"GET",
        url     :"{!! url('/closeCase/" + id +"')!!}",
        beforeSend : function() {
            HoldOn.open({
                theme:"sk-rect",//If not given or inexistent theme throws default theme sk-rect
                message: "<h4>processing please wait... ! </h4>",
                content:"Your HTML Content", // If theme is set to "custom", this property is available
                                             // this will replace the theme by something customized.
                backgroundColor:"none repeat scroll 0 0 rgba(0, 0, 0, 0.8)",//Change the background color of holdon with javascript
                           // Keep in mind is necessary the .css file too.
                textColor:"white" // Change the font color of the message
            });

        },
        success : function(data){

          if (data == "ok") {

              $("#caseNotesNotification").html('<div class="alert alert-success alert-icon">Well done! You successfully closed case ' + id +'<i class="icon">&#61845;</i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
              launchCaseModal(id);
              $('#modalCase').modal('show');
              HoldOn.close()

          }


        }
       })

    }

    function requestCaseClosure() {


      $('#modalCase').modal('toggle');
      var id = $(".modal-body #caseID").val();

      $.ajax({
        type    :"GET",
        url     :"{!! url('/requestCaseClosure/" + id +"')!!}",
        beforeSend : function() {
            HoldOn.open({
                theme:"sk-rect",//If not given or inexistent theme throws default theme sk-rect
                message: "<h4>processing please wait... ! </h4>",
                content:"Your HTML Content", // If theme is set to "custom", this property is available
                                             // this will replace the theme by something customized.
                backgroundColor:"none repeat scroll 0 0 rgba(0, 0, 0, 0.8)",//Change the background color of holdon with javascript
                           // Keep in mind is necessary the .css file too.
                textColor:"white" // Change the font color of the message
            });

        },
        success : function(data) {

          if (data == "Case Closed") {

              $("#caseNotesNotification").html('<div class="alert alert-success alert-icon">Well done! You close request has bees successfully submitted for case: ' + id +'<i class="icon">&#61845;</i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
              launchCaseModal(id);
               $('#modalCase').modal('show');
              HoldOn.close();

          }


        }
       })

    }


    </script>



