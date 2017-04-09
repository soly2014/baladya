@extends('layouts.baladya')
@section('content')	

        <hr />
        
        <br />
            @include('partials.entete', [
    'title' => trans('res_quar.create_res_quar'),
    'icon' => 'dashboard',
    'fil' =>  link_to('admin/res_quar', trans('res_quar.res_quars')) .'  /  '.  trans('res_quar.create_res_quar')
    ])
        
        <div class="row">
            <div class="col-md-12">
                
        <div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->

            <!-- panel head -->
            <div class="panel-heading">
                <div class="panel-title">{{trans('res_quar.create_res_quar')}}</div>
            </div>

            <!-- panel body -->
            <div class="panel-body">

            <div class="panel-body">

                {!! Form::open(['url' => url('/admin/res_quar'),'id'=>'formCreate']) !!}	
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="form-group">
                    {!! Form::controlBootstrap('text', 12, 'name', $errors, '','','',trans('res_quar.name')) !!}
                </div>
                <div class="form-group">
                    {!! Form::controlBootstrap('textarea', 12, 'desc', $errors, '','','',trans('res_quar.desc')) !!}
                </div>




                 <div class="form-group">
                                  <label class="col-sm-8 control-label">{{trans('street.map')}}</label>
                                  <div class="col-sm-8">
                                      <input type="text" class="form-control" id="us3-address" name="map" value=""/>
                                    @if ($errors->has('map'))
                                    <span class="help-block">
                                        <strong>{{trans('street.required')}}</strong>
                                        </span>
                                    @endif
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-sm-8 control-label">{{trans('street.radius')}}</label>

                                  <div class="col-sm-8">
                                      <input type="text" class="form-control" name="radius" id="us3-radius" />
                                  </div>
                              </div><br>
                              <div id="us3" style="width: 550px; height: 400px;"></div>
                              <div class="clearfix">&nbsp;</div>
                              <div class="m-t-small">
                                  <label class="p-r-small col-sm-1 control-label">{{trans('street.lat')}}</label>

                                  <div class="col-sm-3">
                                      <input type="text" class="form-control" style="width: 110px" id="us3-lat" name="lat" value=""/>
                                  </div>
                                  <label class="p-r-small col-sm-2 control-label">{{trans('street.long')}}</label>

                                  <div class="col-sm-3">
                                      <input type="text" class="form-control" style="width: 110px" id="us3-lon" name="long" value=""/>
                                  </div>
                              </div>





    <!-- error pushing -->
    <div class="form-group">
      <label for="field-4" class="col-sm-3 control-label"></label>
      <div class="col-sm-5" id="productEditErrors">
        
      </div>
    </div>
    <!-- end error pushing -->



                <div class="form-group">
                    <div class="col-md-12">
                        <button type="submit" id="applyFilter" class="btn btn-primary">
                            <i class="entypo-login"></i>
                            {{trans('res_quar.save')}}
                        </button>
                    </div>
                </div>
                {!! Form::close() !!}
                <button id="find_btn" class="btn btn-default" style="margin-top: -1114px;margin-right: 628px;"><i class="entypo-compass" aria-hidden="true"></i></button>
            </div>
          </div>
        </div>

    </div>
</div>





<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.1/jquery.form.min.js"></script>
<script type="text/javascript">

  $(document).ready(function () {
    


    /* edit Production Company form */
    $('#formCreate').ajaxForm({

        beforeSubmit: function() {

            $('#applyFilter').html('جاري التحميل...');

        },
        success: function(response) {
             
            $('#applyFilter').html('اضافه نوع المخالفه');
            $('#productEditErrors').html('<div class="alert alert-success">تمت الاضافه بنجاح</div>'); //appending to a <div id="form-errors"></div> inside form

        },
        error: function(error) {
            //process validation errors here.
            var errors = error.responseJSON; //this will get the errors response data.
            //show them somewhere in the markup
            //e.g
            errorsHtml = '<div class="alert alert-danger"><ul>';

            $.each(errors, function(key, value) {
                errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
            });
            errorsHtml += '</ul></div>';
            $('#productEditErrors').html(errorsHtml); //appending to a <div id="form-errors"></div> inside form
            // swal(errorsHtml); //appending to a <div id="form-errors"></div> inside form

            $('#applyFilter').html('اضافه نوع المخالفه');


        },

    });
    /* end edit Production Company form */

  

  });

</script>

@stop
