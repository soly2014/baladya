@extends('layouts.baladya')
@section('content')	

		<hr />
		
		<br />
		@include('partials.entete', [
		'title' => trans('facility.update_facility'),
		'icon' => 'dashboard',
		'fil' =>  link_to('admin/facility', trans('facility.facility')) .'  /  '.  trans('facility.update_facility')
		])
		
		<div class="row">
			<div class="col-md-12">
				
				 <div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->

            <!-- panel head -->
            <div class="panel-heading">
                <div class="panel-title">{{trans('facility.update_facility')}}</div>
            </div>

            <!-- panel body -->
            <div class="panel-body">

                <div class="panel-body">
						
						<form role="form" class="form-horizontal form-groups-bordered" action="{{ url('/admin/facility') }}/{{$facility->id}}" method="post">
							
							{!! method_field('patch') !!}
							<input type="hidden" name="_token" value="{{ csrf_token() }}" />


							<div class="form-group">
								<label for="field-4" class="col-sm-3 control-label">{{trans('facility.banner_name')}}</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="field-4" name="banner_name" placeholder="Placeholder" value="{{ old('banner_name')?:$facility->banner_name }}">
						
								</div>
								@if ($errors->has('banner_name'))
			                        <span class="help-block">
			                            <strong>{{trans('facility.required')}}</strong>
                                        </span>
                    				@endif
							</div>

							<div class="form-group">
								<label for="field-4" class="col-sm-3 control-label">{{trans('facility.lyc_name')}}</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="field-4" name="lyc_name" placeholder="Placeholder" value="{{ old('lyc_name')?:$facility->lyc_name }}">
								</div>
								@if ($errors->has('lyc_name'))
			                        <span class="help-block">
			                            <strong>{{trans('facility.required')}}</strong>
                                        </span>
                    				@endif
							</div>

							<div class="form-group">
								<label for="field-4" class="col-sm-3 control-label">{{trans('facility.lyc_number')}}</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="field-4" name="lyc_number" placeholder="Placeholder" value="{{ old('lyc_number')?:$facility->lyc_number }}">
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
									<input type="text" class="form-control" id="field-4" name="build_number" placeholder="Placeholder" value="{{ old('build_number')?:$facility->build_number }}">
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
									<input type="text" class="form-control" id="field-4" name="township" placeholder="Placeholder" value="{{ old('township')?:$facility->township }}">
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
									<input type="text" class="form-control" id="field-4" name="labour_number" placeholder="Placeholder" value="{{ old('labour_number')?:$facility->labour_number }}">
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
									<input type="text" class="form-control" id="field-4" name="owner_name" placeholder="Placeholder" value="{{ old('owner_name')?:$facility->owner_name }}">
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
										<input type="text" name="lyc_start" value="{{ old('lyc_start')?:$facility->lyc_start }}" class="form-control datepicker" data-format="yyyy/mm/dd">
										
										<div class="input-group-addon">
											<a href="#"><i class="entypo-calendar"></i></a>
										</div>
										@if ($errors->has('lyc_start'))
				                        <span class="help-block">
				                            <strong>{{trans('facility.required')}}</strong>
	                                        </span>
	                    				@endif
									</div>
								</div>
							</div>

							<div class="form-group">
								<label for="field-4" class="col-sm-3 control-label">{{trans('facility.owner_id')}}</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="field-4" name="owner_id" placeholder="Placeholder" value="{{ old('owner_id')?:$facility->owner_id }}">
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
											@if($facility->res_quar_id == $resquar->id)
												<option value="{{ $resquar->id }}" selected>{{ $resquar->name }}</option>
											@else
												<option value="{{ $resquar->id }}">{{ $resquar->name }}</option>
											@endif
											@endforeach
											
										</select>
									</div>
							</div>




							{{-- <div class="form-group">
								<label class="col-sm-3 control-label">{{trans('facility.activity')}}</label>
									<div class="col-sm-5">
											@foreach($activities as $activity)
											<div class="col-md-3">
												@if(in_array($activity->id, $act_ids))
												<input name="activities[]" type="checkbox" value="{{ $activity->id }}"  checked="checked"/>{{ $activity->name }}
												@else
												<input name="activities[]" type="checkbox" value="{{ $activity->id }}"/>{{ $activity->name }}
												@endif
											</div>
											@endforeach
									</div>
							</div> --}}

							<div class="form-group">
								<label class="col-sm-3 control-label">{{trans('facility.activity')}}</label>
									<div class="col-sm-5">
										<select name="activity_type_id" class="selectboxit">
											
											@foreach($activities as $activity)
												@if($facility->activity_type_id == $activity->id)
													<option value="{{ $activity->id }}" selected>{{ $activity->name }}</option>
												@else
													<option value="{{ $activity->id }}">{{ $activity->name }}</option>
												@endif
											@endforeach
											
										</select>
									</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">{{trans('facility.type')}}</label>
									<div class="col-sm-5">
										<select name="type" class="selectboxit">
												@if($facility->type == 'service')
													<option value="company">{{trans('facility.company')}}</option>
													<option value="service" selected>{{trans('facility.service')}}</option>
												@else
													<option value="company" selected>{{trans('facility.company')}}</option>
													<option value="service">{{trans('facility.service')}}</option>
												@endif
										</select>
									</div>
							</div>
							

							<div class="form-group">
								<label class="col-sm-3 control-label">{{trans('facility.street')}}</label>
									<div class="col-sm-5">
										<select name="res_quar_id" class="selectboxit">
											
											@foreach($streets as $street)
											@if($facility->street_id == $street->id)
												<option value="{{ $street->id }}" selected>{{ $street->name }}</option>
											@else
												<option value="{{ $street->id }}">{{ $street->name }}</option>
											@endif
											@endforeach
											
										</select>
									</div>
							</div>

							  <div class="form-group">
					              <label class="col-sm-2 control-label">{{trans('street.map')}}</label>
					              <div class="col-sm-8">
					                  <input type="text" class="form-control" id="us3-address" name="map" value="{{$facility->map}}"/>
					                @if ($errors->has('map'))
			                        <span class="help-block">
			                            <strong>{{trans('street.required')}}</strong>
                                        </span>
                    				@endif
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
					                  <input type="text" class="form-control" style="width: 110px" id="us3-lat" name="lat" value="{{$facility->latitude}}"/>
					              </div>
					              <label class="p-r-small col-sm-2 control-label">{{trans('street.long')}}</label>

					              <div class="col-sm-3">
					                  <input type="text" class="form-control" style="width: 110px" id="us3-lon" name="long" value="{{$facility->longitude}}"/>
					              </div>
					          </div>
							
							
							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-5">
									<button type="submit" class="btn btn-primary"><i class="entypo-login"></i>
									{{trans('facility.update_facility')}}</button>
								</div>
							</div>
						</form>
						
					</div>
				  </div>
				</div>
			
			</div>
		</div>
		


		

	

@stop
