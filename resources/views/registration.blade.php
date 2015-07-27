@extends('master')

@section('content')

        <div class="outer">
          <div class="inner bg-light lter">

            <!--BEGIN INPUT TEXT FIELDS-->
            <div class="row">
              <div class="col-lg-6">
                <div class="box dark">
                  <header>
                    <div class="icons">
                      <i class="fa fa-edit"></i>
                    </div>
                    <h5></h5>

                    <!-- .toolbar -->
                    <div class="toolbar">
                      <nav style="padding: 8px;">
                        <a href="javascript:;" class="btn btn-default btn-xs collapse-box">
                          <i class="fa fa-minus"></i>
                        </a>
                        <a href="javascript:;" class="btn btn-default btn-xs full-box">
                          <i class="fa fa-expand"></i>
                        </a>
                        <a href="javascript:;" class="btn btn-danger btn-xs close-box">
                          <i class="fa fa-times"></i>
                        </a>
                      </nav>
                    </div><!-- /.toolbar -->
                  </header>
                  <div id="div-1" class="body">
                    {!! Form::open(['url' => 'users', 'method' => 'post', 'class' => 'form-horizontal', 'id'=>"registrationForm" ]) !!}

                      <div class="form-group">
                        {!! Form::label('First Name', 'First Name', array('class' => 'control-label col-lg-4')) !!}
                         <div class="col-lg-8">
                         {!! Form::text('Fname',NULL,['class' => 'form-control','id' => 'Fname']) !!}
                          @if ($errors->has('Fname')) <p class="help-block red">*{{ $errors->first('Fname') }}</p> @endif
                        </div>
                      </div><!-- /.form-group -->

                    <div class="form-group">
                        {!! Form::label('Surname', 'Surname', array('class' => 'control-label col-lg-4')) !!}
                         <div class="col-lg-8">
                         {!! Form::text('Sname',NULL,['class' => 'form-control','id' => 'Sname']) !!}
                          @if ($errors->has('Sname')) <p class="help-block red">*{{ $errors->first('Sname') }}</p> @endif
                        </div>
                      </div><!-- /.form-group -->


                    <div class="form-group">
                        {!! Form::label('Cell Number', 'Cell Number', array('class' => 'control-label col-lg-4')) !!}
                         <div class="col-lg-8">
                         {!! Form::text('Cell Number',NULL,['class' => 'form-control','id' => 'Cell1']) !!}
                          @if ($errors->has('Cell1')) <p class="help-block red">*{{ $errors->first('Cell1') }}</p> @endif
                        </div>
                      </div><!-- /.form-group -->

                    <div class="form-group">
                        {!! Form::label('Email', 'Email', array('class' => 'control-label col-lg-4')) !!}
                         <div class="col-lg-8">
                         {!! Form::text('Email',NULL,['class' => 'form-control','Email']) !!}
                          @if ($errors->has('Email')) <p class="help-block red">*{{ $errors->first('Email') }}</p> @endif
                        </div>
                    </div><!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-label col-lg-4">Workplace Position/Title</label>
                        <div class="col-lg-8">
                          <select class="form-control">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                          </select>
                        </div>
                    </div>

                      <div class="form-group">
                            {!! Form::label('Workplace Position/Title', 'Workplace Position/Title', array('class' => 'control-label col-lg-4')) !!}
                            <div class="col-lg-8">
                                {!! Form::select('Position',$selectPositions,0,['class' => 'form-control' ,'id' => 'Position']) !!}
                                  @if ($errors->has('Position')) <p class="help-block red">*{{ $errors->first('Position') }}</p> @endif
                            </div>
                        </div>

                    <div class="form-group">
                        <label class="control-label col-lg-4">Province</label>
                        <div class="col-lg-8">
                          <select class="form-control">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                          </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-4">Business Unit</label>
                        <div class="col-lg-8">
                          <select class="form-control">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                          </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-4">Affiliation</label>
                        <div class="col-lg-8">
                          <select class="form-control">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                          </select>
                        </div>
                    </div>

                    <div class="modal-footer">

                      <button type="submit" id='submitMemberForm' class="btn btn-success" align="rigth">Save</button>

                    </div>

                    </form>
                    {!! Form::close() !!}
                  </div>
                </div>
              </div>

              <!--END TEXT INPUT FIELD-->

              <!--END SELECT-->
            </div><!-- /.row -->

        </div><!-- /.outer -->




@endsection
