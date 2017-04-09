@extends('layouts.baladya')
@section('content')	

		<hr />
		
		<br />
		
		
		<div class="row">
			<div class="col-md-12">
				
				<div class="panel panel-primary" data-collapsed="0">
				
					<div class="panel-heading">
						<div class="panel-title">
							{{trans('violationtype.create_violationtype')}}
						</div>
						
						<div class="panel-options">
							<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
							<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
							<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
							<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
						</div>
					</div>
					
					<div class="panel-body">
						
						<form role="form" class="form-horizontal form-groups-bordered" action="{{ url('/admin/violationtype') }}" method="post">
			
							<input type="hidden" name="_token" value="{{ csrf_token() }}" />

							<div class="form-group">
								<label for="field-4" class="col-sm-3 control-label">{{trans('violationtype.name')}}</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="field-4" name="name" placeholder="Placeholder" value="{{ old('name') }}">
									@if ($errors->has('name'))
			                        <span class="help-block">
			                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                    				@endif
								</div>
							</div>

							<div class="form-group">
								<label for="field-4" class="col-sm-3 control-label">{{trans('violationtype.description')}}</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="field-4" name="desc" placeholder="Placeholder" value="{{ old('desc') }}">
									@if ($errors->has('desc'))
			                        <span class="help-block">
			                            <strong>{{ $errors->first('desc') }}</strong>
                                        </span>
                    				@endif
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">{{trans('violationtype.amount')}}</label>
								
								<div class="col-sm-5">
									
									<!-- Spinner Markup -->
									<div class="input-spinner">
										<button type="button" class="btn btn-default">-</button>
										<input type="text" name="amount" class="form-control size-1" value="{{ old('amount') }}" />
										<button type="button" class="btn btn-default">+</button>
									</div>
									
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">{{trans('violationtype.max_amount')}}</label>
								
								<div class="col-sm-5">
									
									<!-- Spinner Markup -->
									<div class="input-spinner">
										<button type="button" class="btn btn-default">-</button>
										<input type="text" name="max_amount" class="form-control size-1" value="{{ old('max_amount') }}" />
										<button type="button" class="btn btn-default">+</button>
									</div>
									
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">{{trans('violationtype.min_amount')}}</label>
								
								<div class="col-sm-5">
									
									<!-- Spinner Markup -->
									<div class="input-spinner">
										<button type="button" class="btn btn-default">-</button>
										<input type="text" name="min_amount" class="form-control size-1" value="{{ old('min_amount') }}" />
										<button type="button" class="btn btn-default">+</button>
									</div>
									
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
									<button type="submit" class="btn btn-default">{{trans('violationtype.create_violationtype')}}</button>
								</div>
							</div>
						</form>
						
					</div>
				
				</div>
			
			</div>
		</div>
@stop
