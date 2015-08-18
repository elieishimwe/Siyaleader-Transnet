<!-- Modal Default -->
<div class="modal fade modalCase" id="modalCase" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id='depTitle'>Case Profile</h4>
            </div>
            <div class="modal-body">
            {!! Form::open(['url' => 'updateCategory', 'method' => 'post', 'class' => 'form-horizontal', 'id'=>"registrationForm" ]) !!}
            {!! Form::hidden('caseID',NULL,['id' => 'caseID']) !!}
            <div class="form-group">
                {!! Form::label('Case Number', 'Case Number', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-10">
                  {!! Form::text('id',NULL,['class' => 'form-control input-sm','id' => 'id']) !!}
                  @if ($errors->has('id')) <p class="help-block red">*{{ $errors->first('id') }}</p> @endif
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('Description', 'Description', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-10">
                  {!! Form::text('description',NULL,['class' => 'form-control input-sm','id' => 'description']) !!}
                  @if ($errors->has('description')) <p class="help-block red">*{{ $errors->first('description') }}</p> @endif
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('Department', 'Department', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-10">
                  {!! Form::text('department',NULL,['class' => 'form-control input-sm','id' => 'department']) !!}
                  @if ($errors->has('department')) <p class="help-block red">*{{ $errors->first('department') }}</p> @endif
                </div>
            </div>

             <div class="form-group">
                {!! Form::label('Category', 'Category', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-10">
                  {!! Form::text('category',NULL,['class' => 'form-control input-sm','id' => 'category']) !!}
                  @if ($errors->has('category')) <p class="help-block red">*{{ $errors->first('category') }}</p> @endif
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('Sub Category', 'Sub Category', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-10">
                  {!! Form::text('sub_category',NULL,['class' => 'form-control input-sm','id' => 'sub_category']) !!}
                  @if ($errors->has('sub_category')) <p class="help-block red">*{{ $errors->first('sub_category') }}</p> @endif
                </div>
            </div>

             <div class="form-group">
                {!! Form::label('Sub Sub Category', 'Sub Sub Category', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-10">
                  {!! Form::text('sub_category',NULL,['class' => 'form-control input-sm','id' => 'sub_sub_category']) !!}
                  @if ($errors->has('sub_sub_category')) <p class="help-block red">*{{ $errors->first('sub_sub_category') }}</p> @endif
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('Status', 'Status', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-10">
                  {!! Form::text('status',NULL,['class' => 'form-control input-sm','id' => 'status']) !!}
                  @if ($errors->has('status')) <p class="help-block red">*{{ $errors->first('status') }}</p> @endif
                </div>
            </div>
            <div class="form-group">
            <div class="photo-gallery tile clearfix">
                {!! Form::label('Image', 'Image', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-10">
                    <div class="superbox-list">
                        <img src="#" data-img="#" alt="" class="superbox-img" id="CaseImage" width="50%">
                    </div>
                </div>
            </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <button type="submit" id='submitUpdateCategorytForm' type="button" class="btn btn-sm">Save Changes</button>
                </div>
            </div>
            </div>
            <div class="modal-footer">

                <!-- <button type="button" class="btn btn-sm" data-dismiss="modal">Close</button> -->
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
