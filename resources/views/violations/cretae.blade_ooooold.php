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
                <div class="panel-title">{{trans('violation.create_violation')}}</div>
            </div>

            <!-- panel body -->
            <div class="panel-body">

                <div class="panel-body">
						
						<form role="form" class="form-horizontal form-groups-bordered" action="{{ url('/admin/violation') }}" method="post">
			
							<input type="hidden" name="_token" value="{{ csrf_token() }}" />

							{{--<div class="form-group">--}}
								{{--<label class="col-sm-3 control-label">{{trans('violation.date')}}</label>--}}
								{{----}}
								{{--<div class="col-sm-3">--}}
									{{--<div class="input-group">--}}
										{{--<input type="text" name="date" value="{{ old('date') }}" class="form-control datepicker" data-format="yyyy/mm/dd">--}}
										{{----}}
										{{--<div class="input-group-addon">--}}
											{{--<a href="#"><i class="entypo-calendar"></i></a>--}}
										{{--</div>--}}
									{{--</div>--}}
								{{--</div>--}}
								{{--@if ($errors->has('date'))--}}
			                        {{--<span class="help-block">--}}
			                            {{--<strong>{{trans('violation.required')}}</strong>--}}
                                        {{--</span>--}}
                    			{{--@endif--}}
							{{--</div>--}}

							{{--<div class="form-group">--}}
								{{--<label for="field-4" class="col-sm-3 control-label">{{trans('violation.code')}}</label>--}}
								{{--<div class="col-sm-5">--}}
									{{--<input type="text" class="form-control" id="field-4" name="code" placeholder="Placeholder" value="{{ old('code') }}">--}}
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
										<select name="res_quar_id" class="select2" data-allow-clear="true" >
											<optgroup label="United States">
											@foreach($resquars as $resquar)
												<option value="{{ $resquar->id }}">{{ $resquar->name }}</option>
											@endforeach
											</optgroup>
										</select>
									</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">{{trans('violation.street')}}</label>
									<div class="col-sm-5">
										<select name="street_id" class="select2" data-allow-clear="true" >
											<optgroup label="United States">
											@foreach($streets as $street)
												<option value="{{ $street->id }}">{{ $street->name }}</option>
											@endforeach
											</optgroup>
										</select>
									</div>
							</div>

							{{--<div class="form-group">--}}
								{{--<label class="col-sm-3 control-label">{{trans('violation.service')}}</label>--}}
									{{--<div class="col-sm-5">--}}
										{{--<select name="service_id" class="select2" data-allow-clear="true" >--}}
											{{--<optgroup label="United States">--}}
											{{--@foreach($services as $service)--}}
												{{--<option value="{{ $service->id }}">{{ $service->name }}</option>--}}
											{{--@endforeach--}}
											{{--</optgroup>--}}
										{{--</select>--}}
									{{--</div>--}}
							{{--</div>--}}

							<div class="form-group">
								<label class="col-sm-3 control-label">{{trans('violation.violation_type')}}</label>
									<div class="col-sm-5">
										<select name="violation_type_id" class="select2" data-allow-clear="true"  >
											<optgroup label="United States">
											@foreach($violationtypes as $violationtype)
												<option value="{{ $violationtype->id }}">{{ $violationtype->name }}</option>
											@endforeach
											</optgroup>
										</select>
									</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">{{trans('violation.violation_status')}}</label>
									<div class="col-sm-5">
										<select name="violation_status_id" class="select2" data-allow-clear="true" >
											<optgroup label="United States">
											@foreach($violationstatuses as $violationstatus)
												<option value="{{ $violationstatus->id }}">{{ $violationstatus->name }}</option>
											@endforeach
											</optgroup>
										</select>
									</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">{{trans('violation.penalty')}}</label>
									<div class="col-sm-5">
										<select name="violation_status_id" class="select2" data-allow-clear="true" >
											<optgroup label="United States">
											@foreach($penalties as $penalty)
												<option value="{{ $penalty->id }}">{{ $penalty->name }}</option>
											@endforeach
											</optgroup>
										</select>
									</div>
							</div>

							<div class="form-group">
								<label for="field-4" class="col-sm-3 control-label">{{trans('violation.custom_penalty')}}</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="field-4" name="custom_penalty" placeholder="Placeholder" value="{{ old('custom_penalty') }}">
									@if ($errors->has('custom_penalty'))
			                        <span class="help-block">
			                            <strong>{{trans('violation.number')}}</strong>
                                        </span>
                    				@endif
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">{{trans('violation.uploadImage')}}</label>

								<div class="col-sm-5">

									<input name="images" type="file" class="form-control file2 inline btn btn-primary" multiple="1" data-label="<i class='glyphicon glyphicon-circle-arrow-up'></i> &nbsp;Browse Files" />

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
									{{trans('violation.create_violation')}}</button>
								</div>
							</div>
						</form>
						
					</div>
				  </div>
				</div>
			
			</div>
		</div>
@stop
