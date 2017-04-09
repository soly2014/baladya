@extends('layouts.baladya')
@section('content')		
@include('partials.entete', [
'title' => trans('street.street'),
'icon' => 'dashboard',
'fil' =>  link_to('admin/street', trans('street.street'))
])
		<table class="table table-bordered datatable" id="table-1">
			<thead>
				<tr>
					<th data-hide="phone">{{trans('street.name')}}</th>
					<th data-hide="phone">{{trans('street.description')}}</th>
					<th data-hide="phone">{{trans('street.map')}}</th>
					<th data-hide="phone">{{trans('street.status')}}</th>
					
					
					<th>{{trans('street.actions')}}</th>
				</tr>
			</thead>
			<tbody>
			@foreach($streets as $street)
				<tr class="odd gradeX">
					<td>{{ $street->name }}</td>
					<td>{{ $street->desc }}</td>
					<td>{{ $street->map }}</td>
					<td>{{ $street->status==1? trans('street.active'):trans('street.inactive') }}</td>
					<td>
					<div class="col-lg-2">
						<a href="{{url('/admin/street')}}/{{ $street->id }}/edit" class="btn btn-default btn-sm btn-icon icon-left">
							<i class="entypo-pencil"></i>
							{{trans('street.edit')}}
						</a>
						</div>
					<div class="col-lg-2">
						<form method="post" action="{{url('admin/street')}}/{{ $street->id }}" class="FormDelete">
						{{ method_field('DELETE') }}
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<button type="submit" class="btn btn-danger btn-sm btn-icon icon-left">
						<i class="entypo-cancel"></i>
						{{trans('street.delete')}}</button>
						</form>
					</div>
					</td>
				</tr>
				

			@endforeach
			</tbody>
			<tfoot>
				<tr>
					<th>{{trans('street.name')}}</th>
					<th>{{trans('street.description')}}</th>
					<th>{{trans('street.map')}}</th>
					<th>{{trans('street.status')}}</th>
					<th>{{trans('street.actions')}}</th>
				</tr>
			</tfoot>
		</table>
		
		<br />		
		<a href="{{ url('/admin/street/create') }}" class="btn btn-primary">
			<i class="entypo-plus"></i>
			{{trans('street.create_street')}}
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