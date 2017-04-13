@extends('layouts.baladya')
@section('content')	

		@include('partials.entete', [
		'title' => trans('users.update_user'),
		'icon' => 'dashboard',
		'fil' =>  link_to('admin/users', trans('users.users')) .'  /  '.  trans('users.update_user')
		])
		
		<div class="row">
			<div class="col-md-12">
				
		<div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->
		@if(!isset($view))
            <!-- panel head -->
            <div class="panel-heading">
                <div class="panel-title">{{trans('users.update_user')}}</div>
            </div>
@endif
            <!-- panel body -->
            <div class="panel-body">

                <div class="panel-body">
	
	<form role="form" class="form-horizontal form-groups-bordered" action="{{ url('/admin/users') }}/{{$user->id}}" method="post">
		
		{!! method_field('patch') !!}
		<input {{!isset($view)?:'disabled'}} type="hidden" name="_token" value="{{ csrf_token() }}" />

		<div class="form-group">
			<label for="field-4" class="col-sm-3 control-label">{{trans('users.code')}}</label>
			<div class="col-sm-5">
				<input {{!isset($view)?:'disabled'}} type="text" class="form-control" id="field-4" name="code" placeholder="{{trans('users.code')}}" value="{{ old('code')?:$user->code }}">
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
				<input {{!isset($view)?:'disabled'}} type="text" class="form-control" id="field-4" name="first_name" placeholder="{{trans('users.first_name')}}" value="{{ old('first_name')?:$user->first_name }}">
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
				<input {{!isset($view)?:'disabled'}} type="text" class="form-control" id="field-4" name="last_name" placeholder="{{trans('users.last_name')}}" value="{{ old('last_name')?:$user->last_name }}">
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

				<input {{!isset($view)?:'disabled'}} type="text" class="form-control" id="field-4" name="email" placeholder="{{trans('users.email')}}" value="{{ old('email')?:$user->email }}">

			</div>
		</div>




		<div class="form-group">
			<label for="field-4" class="col-sm-3 control-label">{{trans('users.service')}}</label>
			<div class="col-sm-5">

				@if(!isset($view))
				<select name="service_id" class="select2" data-allow-clear="true" data-placeholder="اختر ">
					<option value="0"></option>
					@foreach($services as $service)
						@if($user->service_id == $service->id)
							<option selected value="{{$service->id}}">{{$service->name}}</option>
						@else
							<option  value="{{$service->id}}">{{$service->name}}</option>
						@endif
					@endforeach
				</select>
				@else
				<input disabled type="text" class="form-control"  placeholder="الخدمه" value="{{ \App\Models\Service::find($user->service_id)->name }}">
				@endif

			</div>
		</div>




		<div class="form-group">
			<label for="field-4" class="col-sm-3 control-label">{{trans('users.permissions')}}</label>
			<div class="col-sm-5">


				@if(!isset($view))

				<select id='role' name="role_id" class="select2" data-allow-clear="true" data-placeholder="اختر ">
					<option value="0"></option>
					@foreach($roles as $role)
						@if($user->roles[0]->id == $role->id)
							<option selected value="{{$role->id}}">{{$role->name}}</option>
						@else
							<option  value="{{$role->id}}">{{$role->name}}</option>
						@endif
					@endforeach
				</select>				
				@else
				<input disabled type="text" class="form-control"  placeholder="المجموعه" value="{{ $role_name }}">
				@endif




			</div>
		</div>






		<div class="form-group" id='selectcontractor'>
			<label class="col-sm-3 control-label">{{trans('users.contractor')}}</label>

			<div class="col-sm-5">

				<select name="contractor_id" class="select2" id='contractor'>
					<option value="0"></option>
					@foreach($contractors as $contractor)
					<option value="{{$contractor->id}}" >{{$contractor->first_name.' '.$contractor->last_name}}</option>
					@endforeach
				</select>

			</div>
		</div>


		<div class="form-group">
			<label class="col-sm-3 control-label">الأحياء</label>

			<div class="col-sm-5">
				<?php
				$resQuarIDs=array();
				foreach ($user->resQuars as $resQuar){
					$resQuarIDs[]=$resQuar->id;
				}
				?>



				@if(!isset($view))

				<select name="resQuars[]" class="select2" id='selectedres' multiple >
					<option></option>
					@foreach($resQuars as $resQuar)
						@if(in_array($resQuar->id,$resQuarIDs))
						<option selected value="{{$resQuar->id}}" >{{$resQuar->name}}</option>
						@else
						<option value="{{$resQuar->id}}" >{{$resQuar->name}}</option>
						@endif
					@endforeach
				</select>

				@else
				<input disabled type="text" class="form-control"  placeholder="المجموعه" value="@foreach($user->resQuars as $key){{ $key->name }} | @endforeach">
				
				@endif




			</div>
		</div>

		@if(!isset($view))
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-5">
				<button type="submit" class="btn btn-primary">{{trans('users.update_user')}}</button>
			</div>
		</div>
			@endif
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
			if($('#role').val()==5){
				$('#selectcontractor').css('display', 'block');
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
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			
		});

	});
</script>
@stop

