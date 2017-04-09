@extends('layouts.baladya')
@section('content')		
		<hr />
		
					
		
		<br />
		
		<script type="text/javascript">
		jQuery( document ).ready( function( $ ) {
			var $table1 = jQuery( '#table-1' );
			
			// Initialize DataTable
			$table1.DataTable( {
				"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
				"bStateSave": true
			});
			
			// Initalize Select Dropdown after DataTables is created
			$table1.closest( '.dataTables_wrapper' ).find( 'select' ).select2( {
				minimumResultsForSearch: -1
			});
		} );
		</script>
		
		<table class="table table-bordered datatable" id="table-1">
			<thead>
				<tr>
					<th data-hide="phone">{{trans('violationtype.name')}}</th>
					<th data-hide="phone">{{trans('violationtype.description')}}</th>
					<th data-hide="phone">{{trans('violationtype.status')}}</th>
					<th data-hide="phone">{{trans('violationtype.amount')}}</th>
					<th data-hide="phone">{{trans('violationtype.max_amount')}}</th>
					<th data-hide="phone">{{trans('violationtype.min_amount')}}</th>
					<th>{{trans('violationtype.actions')}}</th>
				</tr>
			</thead>
			<tbody>
			@foreach($violationTypes as $violationtype)
				<tr class="odd gradeX">
					<td>{{ $violationtype->name }}</td>
					<td>{{ $violationtype->desc }}</td>
					<td>{{ $violationtype->status==1? trans('violationtype.active'):trans('violationtype.inactive') }}
					</td>
					<td>{{ $violationtype->amount }}</td>
					<td>{{ $violationtype->min_amount }}</td>
					<td>{{ $violationtype->max_amount }}</td>
					<td>
						<a href="{{url('/admin/violationtype')}}/{{ $violationtype->id }}/edit" class="btn btn-default btn-sm btn-icon icon-left">
							<i class="entypo-pencil"></i>
							{{trans('violationtype.edit')}}
						</a>
						
						<form method="post" action="{{url('admin/violationtype')}}/{{ $violationtype->id }}" class="form">
						{{ method_field('DELETE') }}
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<button type="submit" class="btn btn-danger btn-sm btn-icon icon-left">
						<i class="entypo-cancel"></i>
						{{trans('violationtype.delete')}}</button>
						</form>
					</td>
				</tr>
				

			@endforeach
			</tbody>
			<tfoot>
				<tr>
					<th>{{trans('violationtype.name')}}</th>
					<th>{{trans('violationtype.description')}}</th>
					<th>{{trans('violationtype.status')}}</th>
					<th>{{trans('violationtype.amount')}}</th>
					<th>{{trans('violationtype.max_amount')}}</th>
					<th>{{trans('violationtype.min_amount')}}</th>
					<th>{{trans('violationtype.actions')}}</th>
				</tr>
			</tfoot>
		</table>
		
		<br />		
		<a href="{{ url('/admin/violationtype/create') }}" class="btn btn-primary">
			<i class="entypo-plus"></i>
			{{trans('violationtype.create_violationtype')}}
		</a>

@stop