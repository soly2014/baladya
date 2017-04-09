@extends('layouts.baladya')
@section('content')		
@include('partials.entete', [
'title' => trans('facility.facility'),
'icon' => 'dashboard',
'fil' =>  link_to('admin/facility', trans('facility.facility'))
])
		
		<table class="table table-bordered datatable" id="table-1">
			<thead>
				<tr>
					<th data-hide="phone">{{trans('facility.banner_name')}}</th>
					<th data-hide="phone">{{trans('facility.lyc_name')}}</th>
					<th data-hide="phone">{{trans('facility.build_number')}}</th>
					<th data-hide="phone">{{trans('facility.status')}}</th>
					
					
					<th>{{trans('facility.actions')}}</th>
				</tr>
			</thead>
			<tbody>
			@foreach($facilities as $facility)
				<tr class="odd gradeX">
					<td>{{ $facility->banner_name }}</td>
					<td>{{ $facility->lyc_name }}</td>
					<td>{{ $facility->build_number }}</td>
					<td>{{ $facility->status==1? trans('facility.active'):trans('facility.inactive') }}</td>
					<td>
						<div class="col-lg-2">
						<a href="{{url('/admin/facility')}}/{{ $facility->id }}/edit" class="btn btn-default btn-sm btn-icon icon-left">
							<i class="entypo-pencil"></i>
							{{trans('facility.edit')}}
						</a>
						</div>

						<div class="col-lg-2">
						
						<form method="post" action="{{url('admin/facility')}}/{{ $facility->id }}" class="FormDelete">
						{{ method_field('DELETE') }}
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<button type="submit" class="btn btn-danger btn-sm btn-icon icon-left">
						<i class="entypo-cancel"></i>
						{{trans('facility.delete')}}</button>
						</form>
						</div>
					</td>
				</tr>
				

			@endforeach
			</tbody>
			<tfoot>
				<tr>
					<th>{{trans('facility.banner_name')}}</th>
					<th>{{trans('facility.lyc_name')}}</th>
					<th>{{trans('facility.build_number')}}</th>
					<th>{{trans('facility.status')}}</th>
					<th>{{trans('facility.actions')}}</th>
				</tr>
			</tfoot>
		</table>
		
		<br />		
		<a href="{{ url('/admin/facility/create') }}" class="btn btn-primary">
			<i class="entypo-plus"></i>
			{{trans('facility.create_facility')}}
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