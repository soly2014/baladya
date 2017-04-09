@extends('layouts.baladya')
@section('content')

	<hr />

	<br />
	@include('partials.entete', [
    'title' => trans('gardens.update_garden'),
    'icon' => 'dashboard',
    'fil' =>  link_to('admin/gardens', trans('gardens.gardens')) .'  /  '.  trans('gardens.update_garden')
    ])
		
		<div class="row">
			<div class="col-md-12">
				
		<div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->

            <!-- panel head -->
            <div class="panel-heading">
                <div class="panel-title">{{trans('gardens.update_garden')}}</div>
            </div>

            <!-- panel body -->
            <div class="panel-body">

<div class="panel-body">
	

	<form role="form" id="formCreate" class="form-horizontal form-groups-bordered" action="{{ url('/admin/gardens') }}/{{$garden->id}}" method="post">

		{!! method_field('patch') !!}
		<input type="hidden" name="_token" value="{{ csrf_token() }}" />

		<div class="form-group">
			<label for="field-4" class="col-sm-3 control-label">{{trans('gardens.name')}}</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" id="field-4" name="name" placeholder="الاسم" value="{{ old('name')?:$garden->name }}">
				@if ($errors->has('code'))
					<span class="error">
                    <strong>{{ trans('gardens.required') }}</strong>
                    </span>
				@endif
			</div>
		</div>

		<div class="form-group">
			<label for="field-4" class="col-sm-3 control-label">{{trans('gardens.resQuar')}}</label>
			<div class="col-sm-5">
				<select name="res_quar_id" id="selectDistrict" class="select2" data-allow-clear="true" data-placeholder="اختر حى">
					<option></option>
					@foreach($resQuars as $resQuar)
		                                       	@if($resQuar->id == $garden->res_quar_id)
							<option selected value="{{$resQuar->id}}">{{$resQuar->name}}</option>
						@else
							<option  value="{{$resQuar->id}}">{{$resQuar->name}}</option>
						@endif
						@endforeach
				</select>
				@if ($errors->has('res_quar_id'))
					<span class="error">
                    <strong>{{ trans('gardens.required') }}</strong>
                    </span>
				@endif
			</div>
		</div>


		<!-- push steets here -->


<div class="form-group" >
	<label for="field-4" class="col-sm-3 control-label">اختر شارع</label>
	<div class="col-sm-5" id="pushStreets">
		<select name="street_id" class="select2" data-allow-clear="true" id="Streets" data-placeholder="اختر شارع">

		<option></option>
		@foreach($streets as $street)
			@if($street->id == $garden->stree_id)
				<option selected value="{{$street->id}}">{{$street->name}}</option>
			@else
				<option value="{{$street->id}}">{{$street->name}}</option>
			@endif
		@endforeach
		</select>
		@if ($errors->has('street_id'))
		                <span class="error">
		                    <strong>{{ trans('gardens.required') }}</strong>
		                </span>
		@endif
	</div>
</div>
			

		<!-- end pushing streets -->



		<div class="form-group">
			<label for="field-4" class="col-sm-3 control-label">{{trans('gardens.desc')}}</label>
			<div class="col-sm-5">
				<textarea class="form-control" id="field-4" name="desc" placeholder="الوصف">{{ $garden->desc  }}</textarea>
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
			<div class="col-sm-offset-3 col-sm-5">
				<button type="submit" id="applyFilter" class="btn btn-primary">{{trans('gardens.create_garden')}}</button>
			</div>
		</div>
	</form>
	
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
             
            $('#applyFilter').html('تعديل حديقه');
            $('#productEditErrors').html('<div class="alert alert-success">تمت التعديل بنجاح</div>'); //appending to a <div id="form-errors"></div> inside form

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

            $('#applyFilter').html('تعديل حديقه');


        },

    });
    /* end edit Production Company form */

	

	});

</script>
<script>
	
	$(document).ready(function () {
		
		$('body').on('change','#selectDistrict',function () {
			
			var id = this.value;
			$('#Streets').html('<option value="0"></option> ');

			$.ajax({

			    url:'{{ url('district/streets') }}',
			    type:'get',
			    data:{'id':id},
			    beforeSend:function () {

			    	$('#Streets').html('loading....');
			    },
			    success:function (data) {

			    	if (data == 'false') {

			    	     $("#Streets").html('لا توجد شوارع لهذا الحي');

			    	} else {

			    	     $("#Streets").html(data.view);		

			    	}

			    },
			    error:function (errorres_quar_id) {
			    	alert('error in servers, please try again later');
			    }	

			});
		});
	});

</script>



@stop
