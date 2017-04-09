@extends('layouts.baladya')
@section('content')	

		<hr />
		
		<br />
		@include('partials.entete', [
		'title' => trans('healthenvtype.update_healthenvtype'),
		'icon' => 'dashboard',
		'fil' =>  link_to('admin/healthenvtype', trans('healthenvtype.healthenvtype')) .'  /  '.  trans('healthenvtype.update_healthenvtype')
		])
		
		<div class="row">
			<div class="col-md-12">
				
				<div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->

            <!-- panel head -->
            <div class="panel-heading">
                <div class="panel-title">{{trans('healthenvtype.update_healthenvtype')}}</div>
            </div>

            <!-- panel body -->
            <div class="panel-body">

                <div class="panel-body">
						
						<form role="form" class="form-horizontal form-groups-bordered" action="{{ url('/admin/healthenvtype') }}/{{$healthenvtype->id}}" method="post">
							
							{!! method_field('patch') !!}
							<input type="hidden" name="_token" value="{{ csrf_token() }}" />

							<div class="form-group">
								<label for="field-4" class="col-sm-3 control-label">{{trans('healthenvtype.name')}}</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="field-4" name="name" placeholder="{{trans('healthenvtype.name')}}" value="{{old('name')?:$healthenvtype->name}}">
									@if ($errors->has('name'))
			                        <span class="help-block">
			                            <strong>{{trans('healthenvtype.required')}}</strong>
                                        </span>
                    				@endif
								</div>
							</div>

						    <div class="form-group">
								<label for="field-4" class="col-sm-3 control-label">{{trans('healthenvtype.desc')}}</label>
								<div class="col-sm-5">
									<textarea type="text" class="form-control" id="field-4" name="desc" placeholder="{{trans('healthenvtype.desc')}}" value="">{{old('desc')?:$healthenvtype->desc}}</textarea>
									@if ($errors->has('desc'))
			                        <span class="help-block">
			                            <strong>{{trans('healthenvtype.required')}}</strong>
                                        </span>
                    				@endif
								</div>
							</div>

							<div class="form-group">
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
							</div>
							
							
							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-5">
									<button type="submit" class="btn btn-primary"><i class="entypo-login"></i>
									{{trans('healthenvtype.update_healthenvtype')}}</button>
								</div>
							</div>
						</form>
						
					</div>
				  </div>
				</div>
			
			</div>
		</div>
		


		

	

@stop
