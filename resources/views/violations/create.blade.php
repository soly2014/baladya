@extends('layouts.baladya')
@section('content')	

		<hr />
		
		<br />
		@include('partials.entete', [
		    'title' => trans('violation.create_violation'),
		    'icon' => 'dashboard',
		    'fil' =>  link_to('admin/violation', trans('violation.violation')) .'  /  '.  trans('violation.create_violation')
		    ])
		






		<div class="row">
			<div class="col-md-12">
				
	<div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->

            <!-- panel head -->
            <div class="panel-heading">
                <div class="panel-title">{{ trans('violation.create_violation') }}</div>
            </div>
            <!-- panel body -->
            <div class="panel-body">

                <div class="panel-body">

<form role="form" class="form-horizontal form-groups-bordered " id="formID" action="{{ url('/admin/violation') }}" method="post" >

	<input type="hidden" name="_token" value="{{ csrf_token() }}" />

	<div class="form-group">
		<label class="col-sm-3 control-label">{{ trans('violation.squar') }}</label>
			<div class="col-sm-5">
				<select name="res_quar_id" id="selectDistrict" class="select2" data-allow-clear="true" >
					
					@foreach($resquars as $resquar)
						<option value="{{ $resquar->id }}">{{ $resquar->name }}</option>
					@endforeach
					
				</select>
			</div>
	</div>

	<!--  -->
	<div class="form-group" id="StreetsContainer">
		<label class="col-sm-3 control-label">{{trans('violation.street')}}</label>
			<div class="col-sm-5">
				<select name="street_id" id="Streets" class="select2" data-allow-clear="true" >


				</select>
			</div>
	</div>


	<div class="form-group">
		<label class="col-sm-3 control-label">{{trans('violation.violation_type')}}</label>
			<div class="col-sm-5">
				<select name="violation_type_id" class="select2" data-allow-clear="true"  >
					
					@foreach($violationtypes as $violationtype)
						<option value="{{ $violationtype->id }}">{{ $violationtype->name }}</option>
					@endforeach
					
				</select>
			</div>
	</div>

	

	@if(session('user_role')!='moderator')
	<input type="hidden" name="violation_status_id" value="1" />



	<div class="form-group">
		<label for="field-4" class="col-sm-3 control-label">{{trans('violation.custom_penalty')}}</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="field-4" name="custom_penalty" placeholder="{{trans('violation.custom_penalty')}}" value="{{ old('custom_penalty') }}">
			@if ($errors->has('custom_penalty'))
            <span class="error">
                <strong>{{trans('violation.number')}}</strong>
                </span>
			@endif
		</div>
	</div>
	@else
	<input type="hidden" name="custom_penalty" value="0" />
	@endif


	@if($user->service_id == 2)
	<div class="form-group">
		<label for="field-4" class="col-sm-3 control-label">{{trans('violation.code')}}</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="field-4" name="code" placeholder="{{trans('violation.code')}}" value="{{ old('code') }}">
			@if ($errors->has('code'))
            <span class="error">
                <strong>{{trans('violation.code')}}</strong>
                </span>
			@endif
		</div>
	</div>
	@endif



	<div class="form-group">
		<label for="field-4" class="col-sm-3 control-label">{{trans('violation.desc')}}</label>
		<div class="col-sm-5">
			{{-- <input type="text" class="form-control" id="field-4" name="desc" placeholder="Placeholder" value="{{ old('desc') }}"> --}}

			<textarea name="desc" class="form-control" id="field-4" placeholder="{{trans('violation.desc')}}">{{ old('desc') }}</textarea>
			@if ($errors->has('desc'))
            <span class="error">
                <strong>{{trans('violation.desc')}}</strong>
                </span>
			@endif
		</div>
	</div>



<!-- start image dropzone -->


	<div class="form-group">
		<label for="field-4" class="col-sm-3 control-label">الصور</label>
		<div class="col-sm-5">
            
            <div class="dropzone dropzone-previews" id="my-awesome-dropzone"></div>



		</div>
	</div>

<!--  End image dropzone -->



<!-- start image dropzone -->


	<div class="form-group">
		<label for="field-4" class="col-sm-3 control-label">الصوت</label>
		<div class="col-sm-5">
            
            <div class="dropzone dropzone-previews" id="voice"></div>



		</div>
	</div>
	
<!--  End image dropzone -->



<!-- start image dropzone -->


	<div class="form-group">
		<label for="field-4" class="col-sm-3 control-label">الفيديو</label>
		<div class="col-sm-5">
            
            <div class="dropzone dropzone-previews" id="video"></div>



		</div>
	</div>
	
<!--  End image dropzone -->





	<div class="form-group">
		<label class="col-sm-2 control-label">{{trans('street.map')}}</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="us3-address" name="address" value=""/>
			<a href="javascript:;" id="find_btn" class="btn btn-default"><i class="entypo-compass"></i></a>

		</div>
	</div>

	
	<div class="form-group">
		<label class="col-sm-2 control-label">{{trans('street.radius')}}</label>

		<div class="col-sm-5">
			<input type="text" class="form-control" name="radius" id="us3-radius" />
		</div>
	</div>
	<div id="us3" style="width: 550px; height: 400px;"></div>
	<div class="clearfix">&nbsp;</div>
	<div class="m-t-small">
		<label class="p-r-small col-sm-1 control-label">{{trans('street.lat')}}</label>

		<div class="col-sm-3">
			<input type="text" class="form-control" style="width: 110px" id="us3-lat" name="latitude" value="24.632028"/>
		</div>
		<label class="p-r-small col-sm-2 control-label" style="margin-left:-9px;">{{trans('street.long')}}</label>

		<div class="col-sm-3">
			<input type="text" class="form-control" style="width: 110px" id="us3-lon" name="longitude" value="46.682558"/>
		</div>
	</div>
	
 <br> <br><br>

 <!-- alert messages  -->

		<div class="form-group">
			<label class="col-sm-3 control-label"></label>
			<div id="productEditErrors">
			
		            </div>
	
		</div>


<!-- end alert messages -->

 <div class="form-group">
		<div class="col-sm-offset-1 col-sm-6">
			<button type="submit" id="applyFilter" form="formID" class="btn btn-primary btn-lg"><i class="entypo-login"></i>
			{{trans('violation.create_violation')}}</button>
		</div>
</div>


	
</form>



<!-- <button id="find_btn" class="btn btn-default"><i class="entypo-compass" aria-hidden="true"></i></button>
 --></div>
</div>
</div>


</div>
</div>



 <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/basic.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.js"></script>
 

<script>
	
	$(document).ready(function () {
		
		$('body').on('change','#selectDistrict',function () {
			
			var id = this.value;
			$("select[name='street_id'").html(' ');		

			$.ajax({

			    url:'{{ url('district/streets') }}',
			    type:'get',
			    data:{'id':id},
			    beforeSend:function () {

			    	$('#Streets').html('loading....');
			    },
			    success:function (data) {

			    	if (data == 'false') {

			    	     $("#StreetsContainer").hide();
			    	     $("#Streets").html('لا توجد شوارع لهذا الحي');

			    	} else {

			    	     $("#StreetsContainer").show();
			    	     $("select[name='street_id'").html(' ');		
			    	     $("select[name='street_id'").html(data.view);		

			    	}

			    },
			    error:function (errorres_quar_id) {
			    	alert('error in servers, please try again later');
			    }	

			});
		});
	});

</script>
<script>
	
	Dropzone.autoDiscover = false;
	jQuery(document).ready(function() {

	  $("div#my-awesome-dropzone").dropzone({
	    url: "/add_image_violation"
	  });

	});

</script>


<script>
	
	Dropzone.autoDiscover = false;
	jQuery(document).ready(function() {

	  $("div#voice").dropzone({
	    url: "/add_voice_violation"
	  });

	});

</script>


<script>
	
	Dropzone.autoDiscover = false;
	jQuery(document).ready(function() {

	  $("div#video").dropzone({
	    url: "/add_video_violation"
	  });

	});

</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.1/jquery.form.min.js"></script>
<script type="text/javascript">

	$(document).ready(function () {
		


    /* edit Production Company form */
    $('#formID').ajaxForm({

        beforeSubmit: function() {

            $('#applyFilter').html('جاري التحميل...');

        },
        success: function(response) {
             
            $('#applyFilter').html('اضافه  مخالفه');
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

            $('#applyFilter').html('اضافه  مخالفه');


        },

    });
    /* end edit Production Company form */

	

	});

</script>








@stop
