@extends('layouts.baladya')
@section('content')		
@include('partials.entete', [
'title' => trans('activity.activity'),
'icon' => 'dashboard',
'fil' =>  link_to('admin/activity', trans('activity.activity'))
])
		<table class="table table-bordered datatable" id="table-1">
			<thead>
				<tr>
					<th data-hide="phone">{{trans('activity.name')}}</th>
					<th>{{trans('activity.actions')}}</th>
				</tr>
			</thead>
			<tbody>
			@foreach($activities as $activity)
				<tr class="odd gradeX">
					<td>{{ $activity->name }}</td>
					<td>
					<div class="col-lg-2">
						<a href="{{url('/admin/activity')}}/{{ $activity->id }}/edit" class="btn btn-default btn-sm btn-icon icon-left">
							<i class="entypo-pencil"></i>
							{{trans('activity.edit')}}
						</a>
					</div>
						<div class="col-lg-2">
						<form method="post" action="{{url('admin/activity')}}/{{ $activity->id }}" class="FormDelete">
						{{ method_field('DELETE') }}
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<button type="submit" class="btn btn-danger btn-sm btn-icon icon-left">
						<i class="entypo-cancel"></i>
						{{trans('activity.delete')}}</button>
						</form>
						</div>
					</td>
				</tr>
				

			@endforeach
			</tbody>
			<tfoot>
				<tr>
					<th>{{trans('activity.name')}}</th>
					<th>{{trans('activity.actions')}}</th>
				</tr>
			</tfoot>
		</table>
		
		<br />		
		<a href="{{ url('/admin/activity/create') }}" class="btn btn-primary">
			<i class="entypo-plus"></i>
			{{trans('activity.create_activity')}}
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