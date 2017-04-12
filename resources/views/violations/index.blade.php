@extends('layouts.baladya')
@section('content')		
@include('partials.entete', [
'title' => trans('violation.violation'),
'icon' => 'dashboard',
'fil' =>  link_to('admin/violation', trans('violation.violation'))
])
		<table class="table table-bordered datatable" id="table-1">
			<thead>
				<tr>
					<th data-hide="phone">{{trans('violation.date')}}</th>
					<th data-hide="phone">{{trans('violation.code')}}</th>
					<th data-hide="phone">{{trans('violation.custom_penalty')}}</th>
					<th data-hide="phone">{{trans('violation.violation_status')}}</th>
					<th data-hide="phone">{{trans('users.contractor')}}</th>
					<th>{{trans('violation.actions')}}</th>
					
				</tr>
			</thead>
			<tbody>
			@foreach($violations as $violation)
				<tr class="odd gradeX">
					<td>{{ $violation->date }}</td>
					<td>{{ $violation->code }}</td>
					<td>{{ $violation->custom_penalty }}</td>
					<td>
						@if(App\Models\ViolationStatus::where('id','=',$violation->violation_status_id)->first())
						{{App\Models\ViolationStatus::where('id','=',$violation->violation_status_id)->first()->name}}
						@endif
					</td>
					<td>
					@if($violation->user_id)
					@if(App\Models\User::where('id','=',$violation->user_id)->first())
						{{App\Models\User::where('id','=',$violation->user_id)->first()->first_name.' '.App\Models\User::where('id','=',$violation->user_id)->first()->last_name}}
					@endif
					@endif
					</td>
					



					<td>
					<div class="col-lg-3">
					<a href="{{url('/admin/violation')}}/{{ $violation->id }}/solution" class="btn btn-success btn-sm btn-icon icon-left solve">
							<i class="entypo-pencil"></i>

							<?php switch (session('user_role')) {

								case 'moderator':
									echo "عرض";
									break;
								
								case 'manager':
									echo "اداره";
									break;

								case 'contra_moderator':
									echo "اضف حل";
									break;
								
								case 'admin':
									echo "اداره";
									break;
								
								default:
									echo "عرض";
									break;
							} ?>

						</a>
					</div>


					@if(session("user_role")=='admin' || session("user_role")=='manager')
						<div class="col-lg-3">
							<form method="post" action="{{url('admin/violation')}}/{{ $violation->id }}" class="FormDelete">
							{{ method_field('DELETE') }}
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<button type="submit" class="btn btn-danger btn-sm btn-icon icon-left">
							<i class="entypo-cancel"></i>
							{{trans('violation.delete')}}</button>
							</form>
						</div>
					@endif


					</td>
				</tr>
				

			@endforeach
			</tbody>
			<tfoot>
				<tr>
					<th>{{trans('violation.date')}}</th>
					<th>{{trans('violation.code')}}</th>
					<th>{{trans('violation.custom_penalty')}}</th>
					<th>{{trans('violation.violation_status')}}</th>
					<th data-hide="phone">{{trans('users.contractor')}}</th>
					<th>{{trans('violation.actions')}}</th>
					
				</tr>
			</tfoot>
		</table>
		
		<br />	
                
                @if(session("user_role") !='contra_moderator')
                    <a href="{{ url('/admin/violation/create') }}" class="btn btn-primary">
                            <i class="entypo-plus"></i>
                            {{trans('violation.create_violation')}}
                    </a>               
                @endif

@stop

	@section('scripts')
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                var $table1 = jQuery('#table-1');

                // Initialize DataTable
                $table1.DataTable({
                    "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    "bStateSave": true
                });

                // Initalize Select Dropdown after DataTables is created
                $table1.closest('.dataTables_wrapper').find('select').select2({
                    minimumResultsForSearch: -1
                });
            });
        </script>
@stop