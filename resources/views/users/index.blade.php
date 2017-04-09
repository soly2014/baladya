@extends('layouts.baladya')
@section('content')		
@include('partials.entete', [
'title' => trans('users.users'),
'icon' => 'dashboard',
'fil' =>  link_to('admin/users', trans('users.users'))
])
		
		<table class="table table-bordered datatable" id="table-1">
			<thead>
				<tr>
					<th data-hide="phone">{{trans('users.code')}}</th>
					<th data-hide="phone">{{trans('users.name')}}</th>
					<th data-hide="phone">{{trans('users.email')}}</th>
					<th data-hide="phone">{{trans('users.contractor')}}</th>
					<th data-hide="phone">{{trans('users.permissions')}}</th>
					<th data-hide="phone">{{trans('users.last_login')}}</th>
					<th>{{trans('users.actions')}}</th>
				</tr>
			</thead>
			<tbody>
			@foreach($users as $user)

				<tr class="odd gradeX">
					<td>{{ $user->code }}</td>
					<td>{{ $user->first_name.' '.$user->last_name }}</td>
					<td>{{ $user->email }}</td>
					<td>
					@if($user->user_id)
					@if(App\Models\User::where('id','=',$user->user_id)->first())
						{{App\Models\User::where('id','=',$user->user_id)->first()->first_name.' '.App\Models\User::where('id','=',$user->user_id)->first()->last_name}}
					@endif
					@endif
					</td>

					<td>
					@if($user->roles())
						{{$user->roles[0]->name }}
					@endif
					</td>
					<td>{{ $user->last_login }}</td>

					<td>
						<div class="col-lg-3">
							<a href="{{url('/admin/users')}}/{{ $user->id }}" class="btn btn-warning btn-sm btn-icon icon-left">
								<i class="entypo-eye"></i>
								{{trans('dashboard.details')}}
							</a>
						</div>

					<div class="col-lg-3">
						<a href="{{url('/admin/users')}}/{{ $user->id }}/edit" class="btn btn-default btn-sm btn-icon icon-left">
							<i class="entypo-pencil"></i>
							{{trans('users.edit')}}
						</a>
						</div>


						<div class="col-lg-3">
						<form method="post" action="{{url('admin/users')}}/{{ $user->id }}" class="FormDelete">
						{{ method_field('DELETE') }}
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<button type="submit" class="btn btn-danger btn-sm btn-icon icon-left">
						<i class="entypo-cancel"></i>
						{{trans('users.delete')}}</button>
						</form>
						</div>
						
					</td>
				</tr>
				

			@endforeach
			</tbody>
			<tfoot>
			<tr>
				<th data-hide="phone">{{trans('users.code')}}</th>
				<th data-hide="phone">{{trans('users.name')}}</th>
				<th data-hide="phone">{{trans('users.email')}}</th>
				<th data-hide="phone">{{trans('users.contractor')}}</th>
				<th data-hide="phone">{{trans('users.permissions')}}</th>
				<th data-hide="phone">{{trans('users.last_login')}}</th>
				<th>{{trans('users.actions')}}</th>
			</tr>
			</tfoot>
		</table>
		
		<br />		
		<a href="{{ url('/admin/users/create') }}" class="btn btn-primary">
			<i class="entypo-plus"></i>
			{{trans('users.create_user')}}
		</a>

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