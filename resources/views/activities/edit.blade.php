@extends('layouts.baladya')
@section('content')	

		<hr />
		
		<br />

		@include('partials.entete', [
		'title' => trans('activity.update_activity'),
		'icon' => 'dashboard',
		'fil' =>  link_to('admin/activity', trans('activity.activity')) .'  /  '.  trans('activity.update_activity')
		])
		
		
		<div class="row">
			<div class="col-md-12">
				
			<div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->
					<div class="panel-heading">
						<div class="panel-title">
							{{trans('activity.update_activity')}}
						</div>
					</div>
					<!-- panel body -->
            	<div class="panel-body">
					<div class="panel-body">
						
						<form role="form" class="form-horizontal form-groups-bordered" action="{{ url('/admin/activity') }}/{{$activity->id}}" method="post">
							
							{!! method_field('patch') !!}
							<input type="hidden" name="_token" value="{{ csrf_token() }}" />

							<div class="form-group">
								<label for="field-4" class="col-sm-3 control-label">{{trans('activity.name')}}</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="field-4" name="name" placeholder="Placeholder" value="{{old('name')?:$activity->name}}">
									@if ($errors->has('name'))
			                        <span class="help-block">
			                            <strong>{{trans('activity.required')}}</strong>
                                        </span>
                    				@endif
								</div>
							</div>
							
							
							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-5">
									<button type="submit" class="btn btn-primary"><i class="entypo-login"></i>
									{{trans('activity.update_activity')}}</button>
								</div>
							</div>
						</form>
						
					</div>
				</div>
			</div>
			
			</div>
		</div>
		


		

	

@stop
