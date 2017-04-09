@extends('layouts.baladya')
@section('content')	

		<hr />
		
		<br />
		@include('partials.entete', [
		'title' => trans('uservisit.update_uservisit'),
		'icon' => 'dashboard',
		'fil' =>  link_to('admin/uservisit', trans('uservisit.uservisit')) .'  /  '.  trans('uservisit.update_uservisit')
		])
		
		<div class="row">
			<div class="col-md-12">
				
				<div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->

            <!-- panel head -->
            <div class="panel-heading">
                <div class="panel-title">{{trans('uservisit.update_uservisit')}}</div>
            </div>

            <!-- panel body -->
            <div class="panel-body">

                <div class="panel-body">
						
						<form role="form" class="form-horizontal form-groups-bordered" action="{{ url('/admin/uservisit') }}/{{$userVisit->id}}" method="post">
							
							{!! method_field('patch') !!}
							<input type="hidden" name="_token" value="{{ csrf_token() }}" />

							<div class="form-group">
								<label class="col-sm-3 control-label">{{trans('uservisit.date')}}</label>
								
								<div class="col-sm-3">
									<div class="input-group">
										<input id="date" type="text" name="date" value="{{ old('date')?:$userVisit->date }}" class="form-control datepicker" data-format="yyyy/mm/dd">
										
										<div class="input-group-addon">
											<a href="#"><i class="entypo-calendar"></i></a>
										</div>
									</div>
								</div>
								@if ($errors->has('date'))
			                        <span class="help-block">
			                            <strong>{{trans('uservisit.required')}}</strong>
                                        </span>
                    			@endif
							</div>

							

							<div class="form-group">
								<label class="col-sm-3 control-label">{{trans('uservisit.user')}}</label>
									<div class="col-sm-5">
										<select name="users_id" class="select2">
											<option></option>
											@foreach($users as $user)
											@if($userVisit->users_id == $user->id)
												<option value="{{ $user->id }}" selected>{{ $user->first_name." ".$user->last_name }}</option>
											@else
												<option value="{{ $user->id }}">{{ $user->first_name." ".$user->last_name }}</option>
											@endif
											@endforeach

										</select>
									</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">{{trans('uservisit.facility')}}</label>
									<div class="col-sm-5">
										<select name="facility_id" class="select2">
											<option></option>
											@foreach($facilities as $facility)
											@if($userVisit->facility_id == $facility->id)
												<option value="{{ $facility->id }}" selected>{{ $facility->banner_name }}</option>
											@else
												<option value="{{ $facility->id }}">{{ $facility->banner_name }}</option>
											@endif
											@endforeach

										</select>
									</div>
							</div>

							



							
							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-5">
									<button type="submit" class="btn btn-primary"><i class="entypo-login"></i>
									{{trans('uservisit.update_uservisit')}}</button>
								</div>
							</div>
						</form>
						
					</div>
				  </div>
				</div>
			
			</div>
		</div>

		<div class="row">
		    <div class="col-md-12">
		        <div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->
		            <div class="panel-heading">
		                <div class="panel-title">
		                   {{trans('uservisit.visits')}}
		                </div>
		            </div>
		            <!-- panel body -->
		            <div class="panel-body">
		                <div class="panel-body" id="dayvisits">
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
		


		

	

@stop
@section('scripts')
<script>
	$(document).ready(function($) {
		$('#date').on('change', function(event) {
			event.preventDefault();
			/* Act on the event */
			$.ajax({
				url: '/admin/dayvisits',
				type: 'POST',
				dataType: 'json',
				data: {day: $('#date').val()},
			})
			.done(function(response) {
				console.log(response);
				var html ='';
                for (var i = response['dayvisits'].length - 1; i >= 0; i--) {
                	html += '<a href="'+ response['dayvisits'][i]['url'] +'">';
                	html += '<div class="row">';
	                html +=	"<div class='col-md-3'>";
	                html += "المراقب :"+ response['dayvisits'][i]['user'] ;
	                html +=	"</div>";
	                html +=	"<div class='col-md-3'>";
	                html +=	"التاريخ :"+ response['dayvisits'][i]['date'];
	                html +=	"</div>";
	                html +=	"<div class='col-md-3'>";
	                html +=	"المنشاه :"+ response['dayvisits'][i]['facility'];
	                html +=	"</div>";
	                html += "</a>";
                    html += "</div><hr>";
                } 
                
                $('#dayvisits').html(html);
				
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			
		});
	});
</script>
@stop
