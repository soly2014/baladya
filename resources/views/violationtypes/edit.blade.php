@extends('layouts.baladya')
@section('content')	

		<hr />
		
		<br />
		@include('partials.entete', [
		'title' => trans('violationtype.update_violationtype'),
		'icon' => 'dashboard',
		'fil' =>  link_to('admin/violationtype', trans('violationtype.violationtype')) .'  /  '.  trans('violationtype.update_violationtype')
		])
		
		<div class="row">
			<div class="col-md-12">
				
				<div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->

            <!-- panel head -->
            <div class="panel-heading">
                <div class="panel-title">{{trans('violationtype.update_violationtype')}}</div>
            </div>

            <!-- panel body -->
            <div class="panel-body">

                <div class="panel-body">





	
	<form role="form" class="form-horizontal form-groups-bordered" id="formCreate" action="{{ url('/admin/violationtype') }}/{{$violationType->id}}" method="post">
		
		{!! method_field('patch') !!}
		<input type="hidden" name="_token" value="{{ csrf_token() }}" />

		<div class="form-group">
			<label for="field-4" class="col-sm-3 control-label">{{trans('violationtype.name')}}</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" id="field-4" name="name" placeholder="Placeholder" value="{{old('name')?:$violationType->name}}">
				@if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{trans('violationtype.required')}}</strong>
                    </span>
				@endif
			</div>
		</div>

		<div class="form-group">
			<label for="field-4" class="col-sm-3 control-label">{{trans('violationtype.description')}}</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" id="field-4" name="desc" placeholder="Placeholder" value="{{old('desc')?:$violationType->desc}}">
			</div>
		</div>



		<div class="form-group">
			<label class="col-sm-3 control-label">{{trans('violationtype.amount')}}</label>
			
			<div class="col-sm-5">
				
				<!-- Spinner Markup -->
				<div class="input-spinner">
					<button type="button" class="btn btn-default">-</button>
					<input type="text" name="amount" class="form-control size-1" value="{{ old('amount')?:$violationType->amount }}" />
					<button type="button" class="btn btn-default">+</button>
				</div>
				@if ($errors->has('amount'))
                <span class="help-block">
                    <strong>{{trans('violationtype.number')}}</strong>
                    </span>
				@endif
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label">{{trans('violationtype.max_amount')}}</label>
			
			<div class="col-sm-5">
				
				<!-- Spinner Markup -->
				<div class="input-spinner">
					<button type="button" class="btn btn-default">-</button>
					<input type="text" name="max_amount" class="form-control size-1" value="{{ old('max_amount')?:$violationType->max_amount }}" />
					<button type="button" class="btn btn-default">+</button>
				</div>
				@if ($errors->has('max_amount'))
                <span class="help-block">
                    <strong>{{trans('violationtype.number')}}</strong>
                    </span>
				@endif
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label">{{trans('violationtype.min_amount')}}</label>
			
			<div class="col-sm-5">
				
				<!-- Spinner Markup -->
				<div class="input-spinner">
					<button type="button" class="btn btn-default">-</button>
					<input type="text" name="min_amount" class="form-control size-1" value="{{ old('min_amount')?:$violationType->min_amount }}" />
					<button type="button" class="btn btn-default">+</button>
				</div>
				@if ($errors->has('min_amount'))
                <span class="help-block">
                    <strong>{{trans('violationtype.number')}}</strong>
                    </span>
				@endif
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label">{{trans('violationtype.duration')}}</label>
			
			<div class="col-sm-5">
				
				<!-- Spinner Markup -->
				<div class="input-spinner">
					<button type="button" class="btn btn-default">-</button>
					<input type="text" name="duration" class="form-control size-1" value="{{ old('duration')?:$violationType->duration }}" />
					<button type="button" class="btn btn-default">+</button>
				</div>
				@if ($errors->has('duration'))
                <span class="help-block">
                    <strong>{{trans('violationtype.number')}}</strong>
                    </span>
				@endif
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label">{{trans('violationtype.service')}}</label>
				<div class="col-sm-5">
					<select name="service_id" class="selectboxit">

						@foreach($services as $service)
						@if($violationType->service_id == $service->id)
							<option value="{{ $service->id }}" selected>{{ $service->name }}</option>
						@else
							<option value="{{ $service->id }}">{{ $service->name }}</option>
						@endif
						@endforeach
						</optgroup>
					</select>
				</div>
		</div>





		<div class="form-group">
			<label class="col-sm-3 control-label"></label>
			<div id="productEditErrors">
			
		            </div>
	
		</div>




		
		
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-5">
				<button type="submit" id="applyFilter" class="btn btn-primary"><i class="entypo-login"></i>
				{{trans('violationtype.update_violationtype')}}</button>
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
             
            $('#applyFilter').html('تعديل نوع المخالفه');
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

            $('#applyFilter').html('تعديل نوع المخالفه');


        },

    });
    /* end edit Production Company form */

	

	});

</script>

	

@stop
