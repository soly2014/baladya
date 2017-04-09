@extends('layouts.baladya')
@section('content')	

		<hr />
		
		<br />

		    @include('partials.entete', [
    'title' => trans('facility.create_facility'),
    'icon' => 'dashboard',
    'fil' =>  link_to('admin/facility', trans('facility.facility')) .'  /  '.  trans('facility.create_facility')
    ])
		
	<div class="row">
    <div class="col-md-12">
		<div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->

            <!-- panel head -->
            <div class="panel-heading">
                <div class="panel-title">{{trans('facility.create_facility')}}</div>
            </div>

            <!-- panel body -->
            <div class="panel-body">

                <div class="panel-body">
						
						<form role="form" class="form-horizontal form-groups-bordered" action="{{ url('/admin/facility') }}" method="post">
			
							<input type="hidden" name="_token" value="{{ csrf_token() }}" />

							<div class="form-group">
								<label for="field-4" class="col-sm-3 control-label">{{trans('facility.banner_name')}}</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="field-4" name="banner_name" placeholder="{{trans('facility.banner_name')}}" value="{{ old('banner_name') }}">
									@if ($errors->has('banner_name'))
			                        <span class="help-block">
			                            <strong>{{trans('facility.required')}}</strong>
                                        </span>
                    				@endif
								</div>
							</div>

							<div class="form-group">
								<label for="field-4" class="col-sm-3 control-label">{{trans('facility.lyc_name')}}</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="field-4" name="lyc_name" placeholder="{{trans('facility.lyc_name')}}" value="{{ old('lyc_name') }}">
									@if ($errors->has('lyc_name'))
			                        <span class="help-block">
			                            <strong>{{trans('facility.required')}}</strong>
                                        </span>
                    				@endif
								</div>
							</div>

							<div class="form-group">
								<label for="field-4" class="col-sm-3 control-label">{{trans('facility.lyc_number')}}</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="field-4" name="lyc_number" placeholder="{{trans('facility.lyc_number')}}" value="{{ old('lyc_number') }}">
									@if ($errors->has('lyc_number'))
			                        <span class="help-block">
			                            <strong>{{trans('facility.number')}}</strong>
                                        </span>
                    				@endif
								</div>
							</div>

							<div class="form-group">
								<label for="field-4" class="col-sm-3 control-label">{{trans('facility.build_number')}}</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="field-4" name="build_number" placeholder="{{trans('facility.build_number')}}" value="{{ old('build_number') }}">
									@if ($errors->has('build_number'))
			                        <span class="help-block">
			                            <strong>{{trans('facility.number')}}</strong>
                                        </span>
                    				@endif
								</div>
							</div>



							<div class="form-group">
								<label for="field-4" class="col-sm-3 control-label">{{trans('facility.township')}}</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="field-4" name="township" placeholder="{{trans('facility.township')}}" value="{{ old('township') }}">
									@if ($errors->has('township'))
			                        <span class="help-block">
			                            <strong>{{trans('facility.required')}}</strong>
                                        </span>
                    				@endif
								</div>
							</div>

							<div class="form-group">
								<label for="field-4" class="col-sm-3 control-label">{{trans('facility.labour_number')}}</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="field-4" name="labour_number" placeholder="{{trans('facility.labour_number')}}" value="{{ old('labour_number') }}">
									@if ($errors->has('labour_number'))
			                        <span class="help-block">
			                            <strong>{{trans('facility.number')}}</strong>
                                        </span>
                    				@endif
								</div>
							</div>


							<div class="form-group">
								<label for="field-4" class="col-sm-3 control-label">{{trans('facility.owner_name')}}</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="field-4" name="owner_name" placeholder="{{trans('facility.owner_name')}}" value="{{ old('owner_name') }}">
									@if ($errors->has('owner_name'))
			                        <span class="help-block">
			                            <strong>{{trans('facility.required')}}</strong>
                                        </span>
                    				@endif
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">{{trans('facility.lyc_start')}}</label>
								
								<div class="col-sm-3">
									<div class="input-group">
										<input type="text" name="lyc_start" value="{{ old('lyc_start') }}" class="form-control datepicker" data-format="yyyy-mm-dd">
										
										<div class="input-group-addon">
											<a href="#"><i class="entypo-calendar"></i></a>
										</div>
										
									</div>
									@if ($errors->has('lyc_start'))
				                        <span class="help-block">
				                            <strong>{{trans('facility.required')}}</strong>
	                                        </span>
	                    				@endif
								</div>
							</div>

							<div class="form-group">
								<label for="field-4" class="col-sm-3 control-label">{{trans('facility.owner_id')}}</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="field-4" name="owner_id" placeholder="{{trans('facility.owner_id')}}" value="{{ old('owner_id') }}">
									@if ($errors->has('owner_id'))
			                        <span class="help-block">
			                            <strong>{{ $errors->first('owner_id') }}</strong>
                                        </span>
                    				@endif
								</div>
							</div>



							<div class="form-group">
								<label class="col-sm-3 control-label">{{trans('facility.squar')}}</label>
									<div class="col-sm-5">
										<select name="res_quar_id" class="selectboxit">
											
											@foreach($resquars as $resquar)
												<option value="{{ $resquar->id }}">{{ $resquar->name }}</option>
											@endforeach
											
										</select>
									</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">{{trans('facility.type')}}</label>
									<div class="col-sm-5">
										<select name="type" class="selectboxit">
												<option value="company">{{trans('facility.company')}}</option>
												<option value="service">{{trans('facility.service')}}</option>
										</select>
									</div>
							</div>


							{{-- <div class="form-group">
								<label class="col-sm-3 control-label">{{trans('facility.activity')}}</label>
									<div class="col-sm-5">
											@foreach($activities as $activity)
											<div class="col-md-3">
												<input name="activities[]" type="checkbox" value="{{ $activity->id }}"/>{{ $activity->name }}
											</div>
											@endforeach
									</div>
							</div> --}}

							<div class="form-group">
								<label class="col-sm-3 control-label">{{trans('facility.activity')}}</label>
									<div class="col-sm-5">
										<select name="activity_type_id" class="selectboxit">
											
											@foreach($activities as $activity)
												<option value="{{ $activity->id }}">{{ $activity->name }}</option>
											@endforeach
											
										</select>
									</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">{{trans('facility.street')}}</label>
									<div class="col-sm-5">
										<select name="street_id" class="selectboxit">
											
											@foreach($streets as $street)
												<option value="{{ $street->id }}">{{ $street->name }}</option>
											@endforeach
											
										</select>
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
									{{trans('facility.create_facility')}}</button>
								</div>
							</div>
						</form>
						
					</div>
				  </div>
				</div>
			
			</div>
		</div>


@stop
