<!-- Modal Default -->
<div class="modal fade modalReferCase" id="modalReferCase" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id='depTitle'>Refer Case</h4>
            </div>
            <div class="modal-body">
            {!! Form::open(['url' => '', 'method' => 'post', 'class' => 'form-horizontal', 'id'=>"registrationForm" ]) !!}
            {!! Form::hidden('caseID',NULL,['id' => 'caseID']) !!}


           <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchAddressBookModal();" data-target=".modalAddressBook">Address Book</a>
                </div>
            </div>
            </div>
            <div class="modal-footer">

            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
