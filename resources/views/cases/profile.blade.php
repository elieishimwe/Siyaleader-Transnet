


            <!-- Modal Default -->
            <div class="modal fade modalCase" id="modalCase" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id='depTitle'>Case details</h4>

                        </div>
                        <div class="row">
                          <div class="col-md-6">

                                @if(Session::has('successReferral'))
                                <div class="alert alert-info alert-dismissable fade in">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {{ Session::get('successReferral') }}
                                </div>
                                @endif

                          </div>
                           <div class="col-md-6">
                            <a id='acceptCaseClass' class="btn btn-xs btn-alt" onClick="acceptCase()">Accept Case</a>
                            <a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchReferModal();" data-target=".modalReferCase">Escalate Case</a>
                            <a class="btn btn-xs btn-alt" onClick="launchCaseNotesModal();">Add Case Note</a>
                            <a class="btn btn-xs btn-alt" onClick="launchCaseFilesModal();">Attach a File</a>
                          </div>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                              <div class="col-md-6">
                                <div class="tile">
                                        <h2 class="tile-title">Case profile</h2>

                                  {!! Form::open(['url' => '#', 'method' => 'post', 'class' => 'form-horizontal', 'id'=>"registrationForm" ]) !!}
                                  {!! Form::hidden('caseID',NULL,['id' => 'caseID']) !!}
                                  <div class="form-group">
                                      {!! Form::label('Case Number', 'Case Number', array('class' => 'col-md-2 control-label')) !!}
                                      <div class="col-md-6">
                                        {!! Form::text('id',NULL,['class' => 'form-control input-sm','id' => 'id']) !!}
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      {!! Form::label('Description', 'Description', array('class' => 'col-md-2 control-label')) !!}
                                      <div class="col-md-6">

                                        {!! Form::textarea('description', null, ['class' => 'form-control input-sm','id' => 'description','size' => '30x5']) !!}
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      {!! Form::label('Precinct', 'Precinct', array('class' => 'col-md-2 control-label')) !!}
                                      <div class="col-md-6">
                                        {!! Form::text('department',NULL,['class' => 'form-control input-sm','id' => 'department']) !!}

                                      </div>
                                  </div>

                                   <div class="form-group">
                                      {!! Form::label('Category', 'Category', array('class' => 'col-md-2 control-label')) !!}
                                      <div class="col-md-6">
                                        {!! Form::text('category',NULL,['class' => 'form-control input-sm','id' => 'category']) !!}

                                      </div>
                                  </div>

                                  <div class="form-group">
                                      {!! Form::label('Sub Category', 'Sub Category', array('class' => 'col-md-2 control-label')) !!}
                                      <div class="col-md-6">
                                        {!! Form::text('sub_category',NULL,['class' => 'form-control input-sm','id' => 'sub_category']) !!}

                                      </div>
                                  </div>

                                   <div class="form-group">
                                      {!! Form::label('Sub Sub Category', 'Sub Sub Category', array('class' => 'col-md-2 control-label')) !!}
                                      <div class="col-md-6">
                                        {!! Form::text('sub_category',NULL,['class' => 'form-control input-sm','id' => 'sub_sub_category']) !!}

                                      </div>
                                  </div>
                                  <div class="form-group">
                                      {!! Form::label('Status', 'Status', array('class' => 'col-md-2 control-label')) !!}
                                      <div class="col-md-6">
                                        {!! Form::text('status',NULL,['class' => 'form-control input-sm','id' => 'status']) !!}

                                      </div>
                                  </div>
                                  <div class="form-group">
                                      {!! Form::label('Report Name', 'Report Name', array('class' => 'col-md-2 control-label')) !!}
                                      <div class="col-md-6">
                                        {!! Form::text('reporter',NULL,['class' => 'form-control input-sm','id' => 'reporter']) !!}

                                      </div>
                                  </div>
                                  <div class="form-group">
                                      {!! Form::label('Report Cellphone', 'Report Cellphone', array('class' => 'col-md-2 control-label')) !!}
                                      <div class="col-md-6">
                                        {!! Form::text('reporterCell',NULL,['class' => 'form-control input-sm','id' => 'reporterCell']) !!}

                                      </div>
                                  </div>
                                  <div class="form-group">
                                  <div class="">
                                      {!! Form::label('Image', 'Image', array('class' => 'col-md-2 control-label')) !!}
                                      <div class="col-md-6">
                                        <a data-rel="gallery" id="CaseImageA" class="pirobox_gall img-popup" title="">
                                          <img src="#" alt="" class="superbox-img" id="CaseImage" width="220">
                                        </a>
                                      </div>

                                  </div>
                                  </div>
                                  <div class="form-group">
                                    {!! Form::label('Attach File', 'Attachments', array('class' => 'col-md-2 control-label')) !!}
                                    <div class="fileupload fileupload-new row" data-provides="fileupload">
                                        <div class="input-group col-md-6">
                                            <div class="uneditable-input form-control">
                                                <i class="fa fa-file m-r-5 fileupload-exists"></i>
                                                <span class="fileupload-preview"></span>
                                            </div>
                                            <div class="input-group-btn">
                                                <span class="btn btn-file btn-alt btn-sm">
                                                <span class="fileupload-new">Select file</span>
                                                <span class="fileupload-exists">Change</span>
                                                <input type="file" />
                                            </span>
                                            </div>

                                            <a href="#" class="btn btn-sm btn-gr-gray fileupload-exists" data-dismiss="fileupload">Remove</a>
                                        </div>
                                    </div>

                                  </div>

                                  <div id="fileManager"></div>


                              {!! Form::close() !!}

                            </div>
                            </div>

                            <div class="col-md-6">

                                 <!-- Start Tile Div -->
                                  <div class="tile">
                                      <h2 class="tile-title">case notes</h2>

                                            <!-- Responsive Table -->
                                        <div class="block-area" id="responsiveTable">
                                             <div id="caseNotesNotification">


                                             </div>

                                            <div class="table-responsive overflow">
                                                <table class="table tile table-striped" id="caseNotesTable">
                                                    <thead>
                                                      <tr>
                                                            <th>Created at</th>
                                                            <th>Author</th>
                                                            <th>Note</th>
                                                      </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                </div><!-- End Tile Div -->
                          </div>

                      </div>

                        <div class="row">
                        <div class="col-md-6">

                         <!-- Start Tile Div -->
                          <div class="tile">
                            <h2 class="tile-title">PEOPLE INVOLVED IN THE CASE</h2>

                                  <!-- Responsive Table -->
                              <div class="block-area" id="responsiveTable">

                                  @if(Session::has('successReferral2'))
                                  <div class="alert alert-info alert-dismissable fade in">
                                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                      {{ Session::get('successReferral2') }}
                                  </div>
                                  @endif
                                  <div class="table-responsive overflow">
                                      <table class="table tile table-striped" id="caseResponders">
                                          <thead>
                                            <tr>
                                                  <th>Type</th>
                                                  <th>Name</th>
                                                  <th>Surname</th>
                                                  <th>Position</th>
                                                  <th>Cellphone</th>
                                                  <th>Accepted</th>
                                                  <th>Actions</th>
                                            </tr>
                                          </thead>
                                      </table>
                                  </div>
                              </div>
                        </div><!-- End Tile Div -->

                        </div>
                         <div class="col-md-6">

                         <!-- Start Tile Div -->
                          <div class="tile">
                            <h2 class="tile-title">Case Activities</h2>

                                  <!-- Responsive Table -->
                              <div class="block-area" id="responsiveTable">

                                  @if(Session::has('successReferral1'))
                                  <div class="alert alert-info alert-dismissable fade in">
                                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                      {{ Session::get('successReferral1') }}
                                  </div>
                                  @endif
                                  <div class="table-responsive overflow">
                                      <table class="table tile table-striped" id="caseActivities">
                                          <thead>
                                            <tr>
                                                  <th>Created At</th>
                                                  <th>activity</th>
                                            </tr>
                                          </thead>
                                      </table>
                                  </div>
                              </div>
                        </div><!-- End Tile Div -->

                        </div>
                      </div>

                  </div>
                </div>
            </div>
            </div>

