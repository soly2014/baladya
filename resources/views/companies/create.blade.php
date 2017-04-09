@extends('layouts.baladya')
@section('content')	

		    @include('partials.entete', [
    'title' => trans('companies.create_company'),
    'icon' => 'dashboard',
    'fil' =>  link_to('admin/companies', trans('companies.companies')) .'  /  '.  trans('companies.create_company')
    ])
		
		<div class="row">
			<div class="col-md-12">
				
		<div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->

            <!-- panel head -->
            <div class="panel-heading">
                <div class="panel-title">{{trans('companies.create_company')}}</div>
            </div>

            <!-- panel body -->
            <div class="panel-body">

                <div class="panel-body">
						
						<form role="form" class="form-horizontal form-groups-bordered" action="{{ url('/admin/companies') }}" method="post">
			
							<input type="hidden" name="_token" value="{{ csrf_token() }}" />

							<div class="form-group">
								<label for="field-4" class="col-sm-3 control-label">{{trans('companies.code')}}</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="field-4" name="code" placeholder="Placeholder" value="{{ old('code') }}">
									@if ($errors->has('code'))
										<span class="error">
			                            <strong>{{ trans('companies.required') }}</strong>
                                        </span>
									@endif
								</div>
							</div>

							<div class="form-group">
								<label for="field-4" class="col-sm-3 control-label">{{trans('companies.name')}}</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="field-4" name="name" placeholder="Placeholder" value="{{ old('name') }}">
									@if ($errors->has('name'))
										<span class="error">
			                            <strong>{{ trans('companies.required') }}</strong>
                                        </span>
									@endif
								</div>
							</div>
							<div class="form-group">
								<label for="field-4" class="col-sm-3 control-label">{{trans('companies.email')}}</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="field-4" name="email" placeholder="Placeholder" value="{{ old('email') }}">
									@if ($errors->has('email'))
										<span class="error">
			                            <strong>{{ $errors->first('email') }}</strong>
                                    </span>
									@endif
								</div>
							</div>
							<div class="form-group">
								<label for="field-4" class="col-sm-3 control-label">{{trans('companies.address')}}</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="field-4" name="address" placeholder="Placeholder" value="{{ old('address') }}">
									@if ($errors->has('address'))
			                        <span class="error">
			                            <strong>{{ trans('companies.required') }}</strong>
                                        </span>
                    				@endif
								</div>
							</div>


							<div class="form-group">
								<label for="field-4" class="col-sm-3 control-label">{{trans('companies.phone')}}</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="field-4" name="phone" placeholder="Placeholder" value="{{ old('phone') }}">
									@if ($errors->has('phone'))
										<span class="error">
			                            <strong>{{ trans('companies.required')  }}</strong>
                                    </span>
									@endif
								</div>
							</div>

							<div class="form-group">
								<label for="field-4" class="col-sm-3 control-label">{{trans('companies.lyc_status')}}</label>
								<div class="col-sm-5">
									<select class="form-control" name="lyc_status">
										<option value="1"> تعمل</option>
										<option value="0">ﻻ تعمل</option>
									</select>
									@if ($errors->has('lyc_status'))
										<span class="error">
			                            <strong>{{ trans('companies.required')  }}</strong>
                                    </span>
									@endif
								</div>
							</div>
							<div class="form-group">
								<label for="field-4" class="col-sm-3 control-label">{{trans('companies.lyc_start')}}</label>
								<div class="col-sm-5">
									<input type="date" class="form-control" id="field-4" name="lyc_start" placeholder="Placeholder" value="{{ old('lyc_start') }}">
									@if ($errors->has('lyc_start'))
										<span class="error">
			                            <strong>{{ trans('companies.required')  }}</strong>
                                    </span>
									@endif
								</div>
							</div>
							<div class="form-group">
								<label for="field-4" class="col-sm-3 control-label">{{trans('companies.lyc_end')}}</label>
								<div class="col-sm-5">
									<input type="date" class="form-control" id="field-4" name="lyc_end" placeholder="Placeholder" value="{{ old('lyc_end') }}">
									@if ($errors->has('lyc_end'))
										<span class="error">
			                            <strong>{{ trans('companies.required')  }}</strong>
                                    </span>
									@endif
								</div>
							</div>
							<div class="form-group">
								<label for="field-4" class="col-sm-3 control-label">{{trans('companies.lyc_number')}}</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="field-4" name="lyc_number" placeholder="Placeholder" value="{{ old('lyc_number') }}">
									@if ($errors->has('lyc_number'))
										<span class="error">
			                            <strong>{{ trans('companies.required')  }}</strong>
                                    </span>
									@endif
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-5">
									<button type="submit" class="btn btn-primary">{{trans('companies.create_company')}}</button>
								</div>
							</div>

							<input type="hidden" class="form-control" id="field-4" name="status" placeholder="Placeholder" value="1">

						</form>
						
					</div>
				  </div>
				</div>
			
			</div>
		</div>
@stop
