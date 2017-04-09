@extends('layouts.baladya')
@section('content')	

		<hr />
		
		<br />
			@include('partials.entete', [
		    'title' => trans('uservisit.create_uservisit'),
		    'icon' => 'dashboard',
		    'fil' =>  link_to('admin/uservisit', trans('uservisit.uservisit')) .'  /  '.  trans('uservisit.create_uservisit')
		    ])
		
		<div class="row">
			<div class="col-md-12">
				
				<div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->

            <!-- panel head -->
            <div class="panel-heading">
                <div class="panel-title">{{trans('uservisit.create_uservisit')}}</div>
            </div>

            <!-- panel body -->
            <div class="panel-body">

                <div class="panel-body">
						
						<form role="form" class="form-horizontal form-groups-bordered" action="{{ url('/admin/uservisit') }}" method="post">
			
							<input type="hidden" name="_token" value="{{ csrf_token() }}" />

							<div class="form-group">
								<label class="col-sm-3 control-label">{{trans('uservisit.date')}}</label>
								
								<div class="col-sm-3">
									<div class="input-group">
										<input id="date" type="text" name="date" value="{{  date('m/d/Y') }}" class="form-control datepicker" data-format="yyyy/mm/dd" readonly="true">
										
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
										<select data-allow-clear="true" name="users_id" class="select2">
											
											@foreach($users as $user)
												<option value="{{ $user->id }}">{{ $user->first_name." ".$user->last_name }}</option>
											@endforeach

										</select>
									</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">{{trans('uservisit.facility')}}</label>
									<div class="col-sm-5">
										<select data-allow-clear="true" name="facility_id" class="select2">
											
											@foreach($facilities as $facility)
												<option value="{{ $facility->id }}">{{ $facility->banner_name }}</option>
											@endforeach

										</select>
									</div>
							</div>

							

							
							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-5">
									<button type="submit" class="btn btn-primary"><i class="entypo-login"></i>
									{{trans('uservisit.create_uservisit')}}</button>
								</div>
							</div>
						</form>
						
					</div>
				  </div>
				</div>
			
			</div>
		</div>

		{{-- <div class="row">
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
		</div> --}}

		<table class="table table-bordered datatable" id="table-1">
			<thead>
				<tr>
					<th data-hide="phone">{{trans('uservisit.name')}}</th>
					<th data-hide="phone">{{trans('uservisit.facility')}}</th>
					<th data-hide="phone">{{trans('uservisit.squar')}}</th>
					<th data-hide="phone">{{trans('uservisit.date')}}</th>
					<th>{{trans('uservisit.actions')}}</th>
				</tr>
			</thead>
			<tbody>
			@foreach($uservisits as $uservisit)
				<tr class="odd gradeX">
				
					<td>
					@if(App\Models\User::find($uservisit->users_id))
					{{ App\Models\User::find($uservisit->users_id)->first_name.' '.App\Models\User::find($uservisit->users_id)->last_name  }}
					@endif
					</td>

					<td>
					@if(App\Models\Facility::find($uservisit->facility_id))
					{{ App\Models\Facility::find($uservisit->facility_id)->banner_name }}
					@endif
					</td>

					<td>
					@if(App\Models\Facility::find($uservisit->facility_id))
					@if( App\Models\ResQuar::find(App\Models\Facility::find($uservisit->facility_id)->res_quar_id))

						{{App\Models\ResQuar::find(App\Models\Facility::find($uservisit->facility_id)->res_quar_id)->name}}

					@endif
					@endif
					</td>

				
					<td>{{ $uservisit->date }}</td>
					<td>
					<div class="col-lg-2">
						<a href="{{url('/admin/uservisit')}}/{{ $uservisit->id }}/edit" class="btn btn-default btn-sm btn-icon icon-left">
							<i class="entypo-pencil"></i>
							{{trans('uservisit.edit')}}
						</a>
					</div>
					<div class="col-lg-2">
						<a href="{{url('/admin/uservisit')}}/{{ $uservisit->id }}" class="btn btn-default btn-sm btn-icon icon-left">
							<i class="entypo-pencil"></i>
							{{trans('uservisit.show')}}
						</a>
					</div>
					<div class="col-lg-2">
						<form method="post" action="{{url('admin/uservisit')}}/{{ $uservisit->id }}" class="FormDelete">
						{{ method_field('DELETE') }}
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<button type="submit" class="btn btn-danger btn-sm btn-icon icon-left">
						<i class="entypo-cancel"></i>
						{{trans('uservisit.delete')}}</button>
						</form>
					</div>
					</td>
				</tr>
				

			@endforeach
			</tbody>
			<tfoot>
				<tr>
					<th>{{trans('uservisit.name')}}</th>
					<th>{{trans('uservisit.facility')}}</th>
					<th>{{trans('uservisit.squar')}}</th>
					<th>{{trans('uservisit.date')}}</th>
					<th>{{trans('uservisit.actions')}}</th>
				</tr>
			</tfoot>
		</table>
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
