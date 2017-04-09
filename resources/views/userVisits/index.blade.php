@extends('layouts.baladya')
@section('content')		
@include('partials.entete', [
'title' => trans('uservisit.uservisit'),
'icon' => 'dashboard',
'fil' =>  link_to('admin/uservisit', trans('uservisit.uservisit'))
])
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
		
		<br />	
		@if(session('user_role') != 'moderator' )	
		<a href="{{ url('/admin/uservisit/create') }}" class="btn btn-primary">
			<i class="entypo-plus"></i>
			{{trans('uservisit.create_uservisit')}}
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