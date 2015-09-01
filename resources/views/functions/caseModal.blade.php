   function launchCaseModal(id)
    {

      $(".modal-body #categoryID").val(id);
      $(".modal-body #caseID").val(id);

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

                  },"name" : 'accept'}


                 ],

              "aoColumnDefs": [
                  { "bSearchable": false, "aTargets": [ 1] },
                  { "bSortable": false, "aTargets": [ 1 ] }
              ]

           });


    }
