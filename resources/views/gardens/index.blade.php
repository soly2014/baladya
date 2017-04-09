@extends('layouts.baladya')
@section('content')		
@include('partials.entete', [
'title' => trans('gardens.gardens'),
'icon' => 'dashboard',
'fil' =>  link_to('admin/gardens', trans('gardens.gardens'))
])
   <table class="table table-bordered datatable" id="table-1">
			<thead>
				<tr>
					<th data-hide="phone">{{trans('gardens.name')}}</th>
					<th data-hide="phone">{{trans('gardens.street')}}</th>
					<th data-hide="phone">{{trans('gardens.resQuar')}}</th>
					<th data-hide="phone">{{trans('gardens.desc')}}</th>
					<th>{{trans('gardens.actions')}}</th>
				</tr>
			</thead>
			<tbody>

			@foreach($gardens as $garden)

				<tr class="odd gradeX">
					<td>{{ $garden->name }}</td>
					@if(count($garden->street)>0)
					<td>{{ $garden->street->name }}</td>
					@else
					<td></td>
					@endif
					@if(count($garden->resQuar)>0)
					<td>{{ $garden->resQuar->name }}</td>
					@else
					<td></td>
					@endif
					<td>{{ $garden->desc}}</td>

					<td>
					<div class="col-lg-2">
						<a href="{{url('/admin/gardens')}}/{{ $garden->id }}/edit" class="btn btn-default btn-sm btn-icon icon-left">
							<i class="entypo-pencil"></i>
							{{trans('gardens.edit')}}
						</a>
						</div>


						<div class="col-lg-2">
						<form method="post" action="{{url('admin/gardens')}}/{{ $garden->id }}" class="FormDelete">
						{{ method_field('DELETE') }}
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<button type="submit" class="btn btn-danger btn-sm btn-icon icon-left">
						<i class="entypo-cancel"></i>
						{{trans('gardens.delete')}}</button>
						</form>
						</div>
						
					</td>
				</tr>
				

			@endforeach
			</tbody>
			<tfoot>
			<tr>
				<th data-hide="phone">{{trans('gardens.name')}}</th>
				<th data-hide="phone">{{trans('gardens.street')}}</th>
				<th data-hide="phone">{{trans('gardens.resQuar')}}</th>
				<th data-hide="phone">{{trans('gardens.desc')}}</th>
				<th>{{trans('gardens.actions')}}</th>
			</tr>
			</tfoot>
		</table>
		
		<br />		
		<a href="{{ url('/admin/gardens/create') }}" class="btn btn-primary">
			<i class="entypo-plus"></i>
			{{trans('gardens.create_garden')}}
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