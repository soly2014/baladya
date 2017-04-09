@extends('layouts.baladya')
@section('content')		
@include('partials.entete', [
'title' => trans('contractor.contractor'),
'icon' => 'dashboard',
'fil' =>  link_to('admin/contractor', trans('contractor.contractor'))
])
		
		<table class="table table-bordered datatable" id="table-1">
			<thead>
				<tr>
					<th data-hide="phone">{{trans('contractor.name')}}</th>
					<th data-hide="phone">{{trans('contractor.description')}}</th>
					<th data-hide="phone">{{trans('contractor.status')}}</th>
					<th>{{trans('contractor.actions')}}</th>
				</tr>
			</thead>
			<tbody>
			@foreach($contractors as $contractor)
				<tr class="odd gradeX">
					<td>{{ $contractor->name }}</td>
					<td>{{ $contractor->desc }}</td>
					<td>{{ $contractor->status==1? trans('contractor.active'):trans('contractor.inactive') }}</td>
					<td>
					<div class="col-lg-2">
						<a href="{{url('/admin/contractor')}}/{{ $contractor->id }}/edit" class="btn btn-default btn-sm btn-icon icon-left">
							<i class="entypo-pencil"></i>
							{{trans('contractor.edit')}}
						</a>
						</div>


						<div class="col-lg-2">
						<form method="post" action="{{url('admin/contractor')}}/{{ $contractor->id }}" class="FormDelete">
						{{ method_field('DELETE') }}
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<button type="submit" class="btn btn-danger btn-sm btn-icon icon-left">
						<i class="entypo-cancel"></i>
						{{trans('contractor.delete')}}</button>
						</form>
						</div>
						
					</td>
				</tr>
				

			@endforeach
			</tbody>
			<tfoot>
				<tr>
					<th>{{trans('contractor.name')}}</th>
					<th>{{trans('contractor.description')}}</th>
					<th>{{trans('contractor.status')}}</th>
					<th>{{trans('contractor.actions')}}</th>
				</tr>
			</tfoot>
		</table>
		
		<br />		
		<a href="{{ url('/admin/contractor/create') }}" class="btn btn-primary">
			<i class="entypo-plus"></i>
			{{trans('contractor.create_contractor')}}
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