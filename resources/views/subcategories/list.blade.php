@extends('master')

@section('content')

<!-- Breadcrumb -->
<ol class="breadcrumb hidden-xs">
    <li><a href="#">Administration</a></li>
    <li><a href="{{ url('list-departments') }}">Departments</a></li>
    <li><a href="{{ url('list-categories/$catObj->id') }}">{{ $deptName->name }}</a></li>
    <li><a href="#">{{ $catObj->name }}</a></li>
    <li class="active">Categories Listing</li>
</ol>

<h4 class="page-title">{{ $catObj->name }} CATEGORIES</h4>
<!-- Alternative -->
<div class="block-area" id="alternative-buttons">
    <h3 class="block-title">Categories Listing</h3>
    <a class="btn btn-sm" data-toggle="modal" onClick="launchAddSubCategoryModal();" data-target=".modalAddSubCategory">
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
        <table class="table tile table-striped" id="subCategoriesTable">
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
@include('subcategories.edit')
@include('subcategories.add')
@endsection

@section('footer')

 <script>
  $(document).ready(function() {

  var category = {!! $catObj->id !!};
  var oTable     = $('#subCategoriesTable').DataTable({
                "processing": true,
                "serverSide": true,
                "dom": 'T<"clear">lfrtip',
                "order" :[[0,"desc"]],
                "ajax": "{!! url('/sub-categories-list/" + category +"')!!}",
                 "columns": [
                {data: 'id', name: 'id'},
                {data: 'created_at', name: 'created_at'},
                {data: function(d)
                {
                 return "<a href='{!! url('list-sub-sub-categories/" + d.id + "') !!}' class='btn btn-sm'>"+d.name+"</a>";

                },"name" : 'name'},

              {data: 'actions',  name: 'actions'},
               ],

            "aoColumnDefs": [
                { "bSearchable": false, "aTargets": [ 1] },
                { "bSortable": false, "aTargets": [ 1 ] }
            ]

         });

  });

   function launchUpdateSubCategoryModal(id)
    {

      $(".modal-body #subCategoryID").val(id);
      $.ajax({
        type    :"GET",
        dataType:"json",
        url     :"{!! url('/subcategories/"+ id + "')!!}",
        success :function(data) {

            if(data[0] !== null)
            {

               $("#subCategoryForm #name").val(data[0].name);

            }
            else {
               $("#subCategoryForm #name").val('');
            }

        }
    });

    }
</script>
@endsection
