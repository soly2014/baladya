@extends('layouts.baladya')
@section('content')	

		<hr />
		
		<br />
		@include('partials.entete', [
		'title' => trans('healthviolation.update_healthviolation'),
		'icon' => 'dashboard',
		'fil' =>  link_to('admin/health_violation', trans('healthviolation.healthviolation')) .'  /  '.  trans('healthviolation.update_healthviolation')
		])
		
		<div class="row">
			<div class="col-md-12">
				
				<div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->

            <!-- panel head -->
            <div class="panel-heading">
                <div class="panel-title">{{trans('healthviolation.update_healthviolation')}}</div>
            </div>

            <!-- panel body -->
            <div class="panel-body">

                <div class="panel-body">
						
						<form role="form" class="form-horizontal form-groups-bordered" action="{{ url('/admin/health_violation') }}/{{$healthviolation->id}}" method="post">
							
							{!! method_field('patch') !!}
							<input type="hidden" name="_token" value="{{ csrf_token() }}" />

							<input type="hidden" name="visit_id" value="{{ $healthviolation->visit_id }}" />

							<div class="form-group">
								<label class="col-sm-3 control-label">{{ trans('healthviolation.facility') }}</label>
									<div class="col-sm-5">
										<select data-allow-clear="true" name="facility_status_id" class="selectboxit">
											
											@foreach($facilitystatuses as $status)
											@if($healthviolation->facility_status_id == $status->id)

												<option value="{{ $status->id }}" selected>{{ $status->name }}</option>
											@else
												<option value="{{ $status->id }}">{{ $status->name }}</option>
											@endif
											@endforeach

										</select>
									</div>
							</div>

							{{-- <div class="form-group">
								<label class="col-sm-3 control-label">{{trans('healthviolation.healthviolationtype')}}</label>
									<div class="col-sm-5">
										@foreach($HVTypes as $HVType)
										<div class="col-md-3">
											<input name="HVTypes[]" type="checkbox" value="{{ $HVType->id }}"/>{{ $HVType->name }}
										</div>
										@endforeach
									</div>
							</div> --}}

							<div class="form-group">
								<label class="col-sm-3 control-label">{{trans('healthviolation.healthviolationtype')}}</label>
									<div class="col-sm-5">
											@foreach($HVTypes as $HVType)
											<div class="col-md-3">
												@if(in_array($HVType->id, $HVT_ids))
												<input name="HVTypes[]" type="checkbox" value="{{ $HVType->id }}"  checked="checked"/>{{ $HVType->name }}
												@else
												<input name="HVTypes[]" type="checkbox" value="{{ $HVType->id }}"/>{{ $HVType->name }}
												@endif
											</div>
											@endforeach
									</div>
							</div>
							
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-5">
								<button type="submit" class="btn btn-primary"><i class="entypo-login"></i>
									{{trans('healthviolation.update_healthviolation')}}</button>
							</div>
						</div>
						</form>
						
					</div>
				  </div>
				</div>
			
			</div>
		</div>

@stop