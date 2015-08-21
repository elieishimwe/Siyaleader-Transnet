<!-- Modal Default -->
<div class="modal fade modalAddCaseNotesModal" id="modalAddCaseNotesModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add Case Note</h4>
            </div>
            <div class="modal-body">
            {!! Form::open(['url' => 'addCaseNote', 'method' => 'post', 'class' => 'form-horizontal', 'id'=>"addCaseNoteForm" ]) !!}
            {!! Form::hidden('uid',Auth::user()->id) !!}
            {!! Form::hidden('caseID',NULL,['id' => 'caseID']) !!}

            <div class="form-group">
                {!! Form::label('Your Note', 'Your Note', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-10">
                    <textarea rows="5" id="caseNote" name="caseNote" class="sms form-control" maxlength="500"></textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <button type="#" id='submitAddCaseNoteForm' type="button" class="btn btn-sm">Add Case Note</button>
                </div>
            </div>
            </div>
            <div class="modal-footer">
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
