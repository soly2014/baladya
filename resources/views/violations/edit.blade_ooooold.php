@extends('layouts.baladya')
@section('content')	

		<hr />
		
		<br />
		@include('partials.entete', [
		'title' => trans('violation.update_violation'),
		'icon' => 'dashboard',
		'fil' =>  link_to('admin/violation', trans('violation.violation')) .'  /  '.  trans('violation.update_violation')
		])
		
		<div class="row">
			<div class="col-md-12">
				
				<div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->

            <!-- panel head -->
            <div class="panel-heading">
                <div class="panel-title">{{trans('violation.update_violation')}}</div>
            </div>

            <!-- panel body -->
            <div class="panel-body">

                <div class="panel-body">
						
						<form role="form" class="form-horizontal form-groups-bordered" action="{{ url('/admin/violation') }}/{{$violation->id}}" method="post">
							
							{!! method_field('patch') !!}
							<input type="hidden" name="_token" value="{{ csrf_token() }}" />

														<div class="form-group">
								<label class="col-sm-3 control-label">{{trans('violation.date')}}</label>
								
								{{--<div class="col-sm-3">--}}
									{{--<div class="input-group">--}}
										{{--<input type="text" name="date" value="{{ old('date')?:$violation->date }}" class="form-control datepicker" data-format="yyyy/mm/dd">--}}
										{{----}}
										{{--<div class="input-group-addon">--}}
											{{--<a href="#"><i class="entypo-calendar"></i></a>--}}
										{{--</div>--}}
									{{--</div>--}}
									{{--@if ($errors->has('date'))--}}
			                        {{--<span class="help-block">--}}
			                            {{--<strong>{{trans('violation.required')}}</strong>--}}
                                        {{--</span>--}}
                    				{{--@endif--}}
								{{--</div>--}}
							{{--</div>--}}

							{{--<div class="form-group">--}}
								{{--<label for="field-4" class="col-sm-3 control-label">{{trans('violation.code')}}</label>--}}
								{{--<div class="col-sm-5">--}}
									{{--<input type="text" class="form-control" id="field-4" name="code" placeholder="Placeholder" value="{{ old('code')?:$violation->code }}">--}}
									{{--@if ($errors->has('code'))--}}
			                        {{--<span class="help-block">--}}
			                            {{--<strong>{{trans('violation.number')}}</strong>--}}
                                        {{--</span>--}}
                    				{{--@endif--}}
								{{--</div>--}}
							{{--</div>--}}

							<div class="form-group">
								<label class="col-sm-3 control-label">{{trans('violation.squar')}}</label>
									<div class="col-sm-5">
										<select name="res_quar_id" class="select2" data-allow-clear="true">

											@foreach($resquars as $resquar)
											@if($violation->res_quar_id == $resquar->id)
												<option value="{{ $resquar->id }}" selected>{{ $resquar->name }}</option>
											@else
												<option value="{{ $resquar->id }}">{{ $resquar->name }}</option>
											@endif
											@endforeach

										</select>
									</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">{{trans('violation.street')}}</label>
									<div class="col-sm-5">
										<select name="res_quar_id" class="select2" data-allow-clear="true">

											@foreach($streets as $street)
											@if($violation->street_id == $street->id)
												<option value="{{ $street->id }}" selected>{{ $street->name }}</option>
											@else
												<option value="{{ $street->id }}">{{ $street->name }}</option>
											@endif
											@endforeach

										</select>
									</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">{{trans('violation.service')}}</label>
									<div class="col-sm-5">
										<select name="service_id" class="select2" data-allow-clear="true">

											@foreach($services as $service)
											@if($violation->service_id == $service->id)
												<option value="{{ $service->id }}" selected>{{ $service->name }}</option>
											@else
												<option value="{{ $service->id }}">{{ $service->name }}</option>
											@endif
											@endforeach

										</select>
									</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">{{trans('violation.violation_type')}}</label>
									<div class="col-sm-5">
										<select name="violation_type_id" class="select2" data-allow-clear="true">

											@foreach($violationtypes as $violationtype)
											@if($violation->violation_type_id == $violationtype->id)
												<option value="{{ $violationtype->id }}" selected>{{ $violationtype->name }}</option>
											@else
												<option value="{{ $violationtype->id }}">{{ $violationtype->name }}</option>
											@endif
											@endforeach

										</select>
									</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">{{trans('violation.violation_status')}}</label>
									<div class="col-sm-5">
										<select name="violation_status_id" class="select2" data-allow-clear="true">

											@foreach($violationstatuses as $violationstatus)
											@if($violation->violation_status_id	== $violationstatus->id)
												<option value="{{ $violationstatus->id }}" selected>{{ $violationstatus->name }}</option>
											@else
												<option value="{{ $violationstatus->id }}">{{ $violationstatus->name }}</option>
											@endif
											@endforeach

										</select>
									</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">{{trans('violation.penalty')}}</label>
									<div class="col-sm-5">
										<select name="violation_status_id" class="select2" data-allow-clear="true">

											@foreach($penalties as $penalty)
											@if($violation->penalty_id	== $penalty->id)
												<option value="{{ $penalty->id }}" selected>{{ $penalty->name }}</option>
											@else
												<option value="{{ $penalty->id }}">{{ $penalty->name }}</option>
											@endif
											@endforeach

										</select>
									</div>
							</div>

							<div class="form-group">
								<label for="field-4" class="col-sm-3 control-label">{{trans('violation.custom_penalty')}}</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="field-4" name="custom_penalty" placeholder="Placeholder" value="{{ old('custom_penalty')?:$violation->custom_penalty }}">
									@if ($errors->has('custom_penalty'))
			                        <span class="help-block">
			                            <strong>{{trans('violation.number')}}</strong>
                                        </span>
                    				@endif
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">{{trans('street.map')}}</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="us3-address" name="map" value=""/>
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
									<input type="text" class="form-control" style="width: 110px" id="us3-lat" name="latitude" value=""/>
								</div>
								<label class="p-r-small col-sm-2 control-label">{{trans('street.long')}}</label>

								<div class="col-sm-3">
									<input type="text" class="form-control" style="width: 110px" id="us3-lon" name="longitude" value=""/>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-5">
									<button type="submit" class="btn btn-primary"><i class="entypo-login"></i>
									{{trans('violation.update_violation')}}</button>
								</div>
							</div>
						</form>
						
					</div>
				  </div>
				</div>
			
			</div>
		</div>
		


		

	

@stop
