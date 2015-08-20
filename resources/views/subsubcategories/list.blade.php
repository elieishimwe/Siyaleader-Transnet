@extends('master')

@section('content')

<!-- Breadcrumb -->
<ol class="breadcrumb hidden-xs">
    <li><a href="#">Administration</a></li>
    <li><a href="{{ url('list-departments') }}">Departments</a></li>
    <li><a href="{{ url('list-categories/'.$deptObj->id.'') }}">{{ $deptObj->name }}</a></li>
    <li><a href="{{ url('list-sub-categories/'.$catObj->id.'') }}">{{ $catObj->name }}</a></li>
    <li><a href="#">{{ $subCatObj->name }}</a></li>
    <li class="active">Categories Listing</li>
</ol>

<h4 class="page-title">{{ $subCatObj->name }} CATEGORIES</h4>
<!-- Alternative -->
<div class="block-area" id="alternative-buttons">
    <h3 class="block-title">Categories Listing</h3>
    <a class="btn btn-sm" data-toggle="modal" data-target=".modalAddSubSubCategory">
      Add Category
    </a>
</div>
<!-- Responsive Table -->
<div class="block-area" id="responsiveTable">
     @if(Session::has('success'))
    <div class="alert alert-info alert-dismissable fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('success') }}
    </div>
    @endif
    <div class="table-responsive overflow">
        <table class="table tile table-striped" id="subsubCategoriesTable">
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
@include('subsubcategories.edit')
@include('subsubcategories.add')
@include('subsubcategories.responders')

@endsection

@section('footer')

 <script>
  $(document).ready(function() {



  var sub_category = {!! $subCatObj->id !!};
  var oTable     = $('#subsubCategoriesTable').DataTable({
                "processing": true,
                "serverSide": true,
                "dom": 'T<"clear">lfrtip',
                "order" :[[0,"desc"]],
                "ajax": "{!! url('/sub-sub-categories-list/" + sub_category +"')!!}",
                 "columns": [
                {data: 'id', name: 'id'},
                {data: 'created_at', name: 'created_at'},
                {data: function(d)
                {
                 return "<a href='{!! url('list-sub-categories/" + d.id + "') !!}' class='btn btn-sm'>"+d.name+"</a>";

                },"name" : 'name'},

              {data: 'actions',  name: 'actions'},
               ],

            "aoColumnDefs": [
                { "bSearchable": false, "aTargets": [ 1] },
                { "bSortable": false, "aTargets": [ 1 ] }
            ]

         });

  });

   function launchUpdateSubSubCategoryModal(id)
    {
      $(".modal-body #subsubCategoryID").val(id);
      $.ajax({
        type    :"GET",
        dataType:"json",
        url     :"{!! url('/subsubcategories/"+ id + "')!!}",
        success :function(data) {

            if(data[0] !== null)
            {

               $("#SubSubCategoryEditModal #name").val(data[0].name);

            }
            else {
               $("#SubSubCategoryEditModal #name").val('');
            }

        }
    });

    }

    function launchSubSubCatResponders(id)
    {

      $(".modal-body #subsubCategoryID").val(id);

      $.ajax({
          type    :"GET",
          dataType:"json",
          url     :"{!! url('/getsubSubResponders/"+ id + "')!!}",
          success :function(data) {

              if(data[0] !== null)
              {
                if(data[0].firstResponder !== null)
                {
                  $("#firstResponder").prev(".token-input-list").remove();
                  $("#firstResponder").tokenInput("{!! url('getResponder') !!}",{tokenLimit:1,prePopulate:[{id: data[0].id, name: data[0].firstResponder}]});
                }
                else {

                  $("#firstResponder").tokenInput("{!! url('getResponder') !!}",{tokenLimit:1});
                }

                if(data[0].secondResponder !== null)
                {
                  $("#secondResponder").prev(".token-input-list").remove();
                  $("#secondResponder").tokenInput("{!! url('getResponder') !!}",{tokenLimit:1,prePopulate:[{id: data[0].id, name: data[0].secondResponder}]});
                }
                else {


                  $("#secondResponder").tokenInput("{!! url('getResponder') !!}",{tokenLimit:1});
                }

                if(data[0].thirdResponder !== null)
                {
                  $("#thirdResponder").prev(".token-input-list").remove();
                  $("#thirdResponder").tokenInput("{!! url('getResponder') !!}",{tokenLimit:1,prePopulate:[{id: data[0].id, name: data[0].thirdResponder}]});
                }
                else {
                  $("#thirdResponder").tokenInput("{!! url('getResponder') !!}",{tokenLimit:1});
                }

              }
              else {


                  if($("#firstResponder").prev(".token-input-list").html())
                  {
                    $("#firstResponder").tokenInput("clear");
                  }
                  else
                  {
                    $("#firstResponder").tokenInput("/getResponder",{tokenLimit:1});
                  }

                  if($("#secondResponder").prev(".token-input-list").html())
                  {
                    $("#secondResponder").tokenInput("clear");
                  }
                  else
                  {
                    $("#secondResponder").tokenInput("/getResponder",{tokenLimit:1});
                  }

                  if($("#thirdResponder").prev(".token-input-list").html())
                  {
                    $("#thirdResponder").tokenInput("clear");
                  }
                  else
                  {
                    $("#thirdResponder").tokenInput("/getResponder",{tokenLimit:1});
                  }


              }

          }
      });

    }

    @if (count($errors) > 0)

      $('#modalAddSubSubCategory').modal('show');

    @endif
</script>
@endsection
