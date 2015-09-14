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
@include('casefiles.add')
@include('messages.add')


@endsection

@section('footer')
 <script>

 @include('functions.caseModal')



  @if (count($errors) > 0)

      $('#modalAddContactModal').modal('show');

  @endif

</script>
@endsection

