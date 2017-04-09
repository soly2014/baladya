@extends('layouts.baladya')
@section('content')	

		<hr />
		
		<br />
		    @include('partials.entete', [
    'title' => trans('contractor.create_contractor'),
    'icon' => 'dashboard',
    'fil' =>  link_to('admin/contractor', trans('contractor.contractor')) .'  /  '.  trans('contractor.create_contractor')
    ])
		
		<div class="row">
			<div class="col-md-12">
				
		<div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->

            <!-- panel head -->
            <div class="panel-heading">
                <div class="panel-title">{{trans('contractor.create_contractor')}}</div>
            </div>

            <!-- panel body -->
            <div class="panel-body">

                <div class="panel-body">
						
						<form role="form" class="form-horizontal form-groups-bordered" action="{{ url('/admin/contractor') }}" method="post">
			
							<input type="hidden" name="_token" value="{{ csrf_token() }}" />

							<div class="form-group">
								<label for="field-4" class="col-sm-3 control-label">{{trans('contractor.name')}}</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="field-4" name="name" placeholder="{{trans('contractor.name')}}" value="{{ old('name') }}">
									@if ($errors->has('name'))
			                        <span class="help-block">
			                            <strong>{{ trans('contractor.required') }}</strong>
                                        </span>
                    				@endif
								</div>
							</div>

							<div class="form-group">
								<label for="field-4" class="col-sm-3 control-label">{{trans('contractor.description')}}</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="field-4" name="desc" placeholder="{{trans('contractor.description')}}" value="{{ old('desc') }}">
									@if ($errors->has('desc'))
			                        <span class="help-block">
			                            <strong>{{ $errors->first('desc') }}</strong>
                                    </span>
                    				@endif
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">الأحياء</label>

								<div class="col-sm-5">

									<select id="select2" name="resQuars[]" class="select2" multiple >
										<option></option>
										@foreach($resQuars as $resQuar)
										<option value="{{$resQuar->id}}" >{{$resQuar->name}}</option>
										@endforeach
									</select>

								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-5">
									<div class="radio">
										<label>
											<input type="radio" name="status" id="optionsRadios1" value="1" checked>{{trans('contractor.active')}}
										</label>
									</div>
									<div class="radio">
										<label>
											<input type="radio" name="status" id="optionsRadios2" value="0">{{trans('contractor.inactive')}}
										</label>
									</div>
								</div>
							</div>
							
							
							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-5">
									<button type="submit" class="btn btn-primary">{{trans('contractor.create_contractor')}}</button>
								</div>
							</div>
						</form>
						
					</div>
				  </div>
				</div>
			
			</div>
		</div>

@stop