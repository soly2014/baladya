@extends('layouts.baladya')
@section('content')	

		    @include('partials.entete', [
    'title' => trans('users.create_user'),
    'icon' => 'dashboard',
    'fil' =>  link_to('admin/users', trans('users.users')) .'  /  '.  trans('users.create_user')
    ])
		
		<div class="row">
			<div class="col-md-12">
				
		<div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->

            <!-- panel head -->
            <div class="panel-heading">
                <div class="panel-title">{{trans('users.create_user')}}</div>
            </div>

            <!-- panel body -->
            <div class="panel-body">

                <div class="panel-body">


<form id="formID" role="form" class="form-horizontal form-groups-bordered" enctype="multipart/form-data" action="{{ url('/admin/users') }}" method="post">


	<input type="hidden" name="_token" value="{{ csrf_token() }}" />

	<div class="form-group">
		<label for="field-4" class="col-sm-3 control-label">{{trans('users.code')}}</label>
		<div class="col-sm-5">
			<input type="number" class="form-control" id="field-4" name="code" placeholder="{{trans('users.code')}}" value="{{ old('code') }}">
			@if ($errors->has('code'))
				<span class="error">
                <strong>{{ trans('users.required') }}</strong>
                </span>
			@endif
		</div>
	</div>

	<div class="form-group">
		<label for="field-4" class="col-sm-3 control-label">{{trans('users.first_name')}}</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="field-4" name="first_name" placeholder="{{trans('users.first_name')}}" value="{{ old('first_name') }}">
			@if ($errors->has('first_name'))
				<span class="error">
                <strong>{{ trans('users.required') }}</strong>
                </span>
			@endif
		</div>
	</div>

	<div class="form-group">
		<label for="field-4" class="col-sm-3 control-label">{{trans('users.last_name')}}</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="field-4" name="last_name" placeholder="{{trans('users.last_name')}}" value="{{ old('last_name') }}">
			@if ($errors->has('last_name'))
            <span class="error">
                <strong>{{ trans('users.required') }}</strong>
                </span>
			@endif
		</div>
	</div>

	<div class="form-group">
		<label for="field-4" class="col-sm-3 control-label">{{trans('users.email')}}</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="field-4" name="email" placeholder="{{trans('users.email')}}" value="{{ old('email') }}">
			@if ($errors->has('email'))
            <span class="error">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
			@endif
		</div>
	</div>

	<div class="form-group">
		<label for="field-4" class="col-sm-3 control-label">{{trans('users.password')}}</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="field-4" name="password" placeholder="{{trans('users.password')}}" value="{{ old('password') }}">
			@if ($errors->has('password'))
				<span class="error">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
			@endif
		</div>
	</div>
	<div class="form-group">
		<label for="field-4" class="col-sm-3 control-label">{{trans('users.service')}}</label>
		<div class="col-sm-5">
			<select name="service_id" class="select2" data-allow-clear="true" data-placeholder="اختر ">

			@foreach($services as $service)										<option  value="{{$service->id}}" >
			{{$service->name}}</option>

				@endforeach
			</select>
			@if ($errors->has('service_id'))
				<span class="error">
                <strong>{{ trans('users.required') }}</strong>
                </span>
			@endif
		</div>
	</div>





	<div class="form-group">
		<label for="field-4" class="col-sm-3 control-label">{{trans('users.permissions')}}</label>
		<div class="col-sm-5">
			<select id='role' name="role_id" class="select2" data-allow-clear="true" data-placeholder="اختر ">

				@foreach($roles as $role)
						<option  value="{{$role->id}}">{{$role->name}}</option>

				@endforeach
			</select>
		</div>
	</div>





	<div class="form-group" id='selectcontractor'>
		<label class="col-sm-3 control-label">{{trans('users.contractor')}}</label>

		<div class="col-sm-5">

			<select name="contractor_id" class="select2" id='contractor'>

				@foreach($contractors as $contractor)
				<option value="{{$contractor->user_id}}" >{{$contractor->first_name.' '.$contractor->last_name}}</option>
				@endforeach
			</select>

		</div>
	</div>





	<div class="form-group" id='resdiv'>
		<label class="col-sm-3 control-label">الاحياء</label>

		<div class="col-sm-5">
		<select name="resQuars[]" id='selectedres' class="select2" multiple>
		@foreach($resQuars as $resQuar)
		<option value="{{$resQuar->id}}" id="res{{$resQuar->id}}">{{$resQuar->name}}</option>
		@endforeach
		</select>
			

		</div>
	</div>





                    <!-- add messages -->
                        <div class="form-group">
                            <label class="col-sm-3 control-label"></label>
                            <div id="productEditErrors">
                                    </div>
                        </div>
                    <!-- end add messages -->


	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-5">
			<button type="submit" id="applyFilter" class="btn btn-primary">{{trans('users.create_user')}}</button>
		</div>
	</div>
	<input type="hidden" name="fuck" id="fuck" value="{{ $li }}">


</form>

</div>
</div>
</div>

</div>
</div>
@stop

@section('scripts')
<script>

	jQuery(document).ready(function($) {



		$('body').on('change','#role', function(event) {
			/* Act on the event */
			if($('#role').val() == 5){

				$('#selectcontractor').css('display', 'block');
				var squares = $("#fuck").val();
				console.log(squares);
				$("#selectedres").html(squares);
			}
			else{
				$('#selectcontractor').css('display', 'none');
				$("#selectedres").val([]).trigger("change");
			}
		});



		$('body').on('change','#contractor', function(event) {
			
			$.ajax({
				url: '/admin/contractorres/'+$(this).val(),
				type: 'GET',
				dataType: 'JSON',
			})
			.done(function(response) {

				$("#selectedres").val(response['ids']).trigger("change");
			})
			.fail(function() {
				//console.log("error");
			})
			.always(function() {
				//console.log("complete");
			});
			
		});







	});
</script>

<!-- 
<script>
	
	$(document).ready(function () {
		
		$('body').on('change','#contractor',function () {
			
			var id = this.value;

			$.ajax({

			    url:'{{ url('contractor/squares') }}',
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
 -->





<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.1/jquery.form.min.js"></script>
<script type="text/javascript">

    $(document).ready(function () {
        


    /* edit Production Company form */
    $('#formID').ajaxForm({

        beforeSubmit: function() {

            $('#applyFilter').html('جاري التحميل...');

        },
        success: function(response) {
             
            $('#applyFilter').html('اضافه مستخدم');
            $('#productEditErrors').html('<div class="alert alert-success">تمت الاضافه بنجاح</div>'); //appending to a <div id="form-errors"></div> inside form
            $('#formID')[0].reset();

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

            $('#applyFilter').html('اضافه مستخدم');


        },

    });
    /* end edit Production Company form */

    

    });

</script>

@stop
