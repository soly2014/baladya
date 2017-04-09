@extends('layouts.baladya')
@section('content')		
@include('partials.entete', [
'title' => trans('healthenvtype.healthenvtype'),
'icon' => 'dashboard',
'fil' =>  link_to('admin/healthenvtype', trans('healthenvtype.healthenvtype'))
])
		<table class="table table-bordered datatable" id="table-1">
			<thead>
				<tr>
					<th data-hide="phone">{{trans('healthenvtype.name')}}</th>
					<th>{{trans('healthenvtype.actions')}}</th>
				</tr>
			</thead>
			<tbody>
			@foreach($healthEnvTypes as $healthenvtype)
				<tr class="odd gradeX">
					<td>{{ $healthenvtype->name }}</td>
					<td>
					<div class="col-lg-2">
						<a href="{{url('/admin/healthenvtype')}}/{{ $healthenvtype->id }}/edit" class="btn btn-default btn-sm btn-icon icon-left">
							<i class="entypo-pencil"></i>
							{{trans('healthenvtype.edit')}}
						</a>
					</div>
					<div class="col-lg-2">
						<form method="post" action="{{url('admin/healthenvtype')}}/{{ $healthenvtype->id }}" class="FormDelete">
						{{ method_field('DELETE') }}
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<button type="submit" class="btn btn-danger btn-sm btn-icon icon-left">
						<i class="entypo-cancel"></i>
						{{trans('healthenvtype.delete')}}</button>
						</form>
					</div>
					</td>
				</tr>
				

			@endforeach
			</tbody>
			<tfoot>
				<tr>
					<th>{{trans('healthenvtype.name')}}</th>
					<th>{{trans('healthenvtype.actions')}}</th>
				</tr>
			</tfoot>
		</table>
		
		<br />		
		<a href="{{ url('/admin/healthenvtype/create') }}" class="btn btn-primary">
			<i class="entypo-plus"></i>
			{{trans('healthenvtype.create_healthenvtype')}}
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