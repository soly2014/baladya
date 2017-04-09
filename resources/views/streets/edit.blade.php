@extends('layouts.baladya')
@section('content')	

		<hr />
		
		<br />
		@include('partials.entete', [
		'title' => trans('street.update_street'),
		'icon' => 'dashboard',
		'fil' =>  link_to('admin/street', trans('street.street')) .'  /  '.  trans('street.update_street')
		])
		
		<div class="row">
			<div class="col-md-12">
				
				<div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->

            <!-- panel head -->
            <div class="panel-heading">
                <div class="panel-title">{{trans('street.update_street')}}</div>
            </div>

            <!-- panel body -->
            <div class="panel-body">

                <div class="panel-body">
						
						<form role="form" class="form-horizontal form-groups-bordered" action="{{ url('/admin/street') }}/{{$street->id}}" method="post">
							
							{!! method_field('patch') !!}
							<input type="hidden" name="_token" value="{{ csrf_token() }}" />

							<div class="form-group">
								<label for="field-4" class="col-sm-3 control-label">{{trans('street.name')}}</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="field-4" name="name" placeholder="Placeholder" value="{{old('name')?:$street->name}}">
									@if ($errors->has('name'))
			                        <span class="help-block">
			                            <strong>{{trans('street.required')}}</strong>
                                        </span>
                    				@endif
								</div>
							</div>

							<div class="form-group">
								<label for="field-4" class="col-sm-3 control-label">{{trans('street.description')}}</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="field-4" name="desc" placeholder="Placeholder" value="{{old('desc')?:$street->desc}}">
								</div>
							</div>

							

							<div class="form-group">
								<label class="col-sm-3 control-label">{{trans('street.squar')}}</label>
									<div class="col-sm-5">
										<select name="res_quar_id" class="selectboxit">
											
											@foreach($resquars as $resquar)
												@if($street->res_quar_id == $resquar->id)
												<option value="{{ $resquar->id }}" selected>{{ $resquar->name }}</option>
												@else
												<option value="{{ $resquar->id }}">{{ $resquar->name }}</option>
												@endif
											@endforeach
											</optgroup>
										</select>
									</div>
							</div>

					
					          <div class="form-group">
					              <label class="col-sm-2 control-label">{{trans('street.map')}}</label>
					              <div class="col-sm-8">
					                  <input type="text" class="form-control" id="us3-address" name="map" value="{{$street->map}}"/>
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
					                  <input type="text" class="form-control" style="width: 110px" id="us3-lat" name="lat" value="{{$street->lat}}"/>
					              </div>
					              <label class="p-r-small col-sm-2 control-label">{{trans('street.long')}}</label>

					              <div class="col-sm-3">
					                  <input type="text" class="form-control" style="width: 110px" id="us3-lon" name="long" value="{{$street->long}}"/>
					              </div>
					          </div>
							
							
							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-5">
									<button type="submit" class="btn btn-primary"><i class="entypo-login"></i>
									{{trans('street.update_street')}}</button>
								</div>
							</div>
						</form>
						<button id="find_btn" class="btn btn-default" style="margin-right: 799px;"><i class="entypo-compass" aria-hidden="true"></i></button>
					</div>
				  </div>
				</div>
			
			</div>
		</div>
		


		

	

@stop
