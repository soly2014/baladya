@extends('layouts.baladya')
@section('content')		
@include('partials.entete', [
'title' => trans('companies.companies'),
'icon' => 'dashboard',
'fil' =>  link_to('admin/companies', trans('companies.companies'))
])
		
		<table class="table table-bordered datatable" id="table-1">
			<thead>
				<tr>
					<th data-hide="phone">{{trans('companies.code')}}</th>
					<th data-hide="phone">{{trans('companies.name')}}</th>
					<th data-hide="phone">{{trans('companies.email')}}</th>
					<th data-hide="phone">{{trans('companies.phone')}}</th>
					<th data-hide="phone">{{trans('companies.status')}}</th>
					<th>{{trans('companies.actions')}}</th>
				</tr>
			</thead>
			<tbody>
			@foreach($companies as $company)

				<tr class="odd gradeX">
					<td>{{ $company->code }}</td>
					<td>{{ $company->name}}</td>
					<td>{{ $company->email }}</td>
					<td>{{$company->phone }}</td>
					<td>{{ $company->status }}</td>

					<td>
						<div class="col-lg-3">
							<a href="{{url('/admin/companies')}}/{{ $company->id }}" class="btn btn-warning btn-sm btn-icon icon-left">
								<i class="entypo-eye"></i>
								{{trans('dashboard.details')}}
							</a>
						</div>

					<div class="col-lg-3">
						<a href="{{url('/admin/companies')}}/{{ $company->id }}/edit" class="btn btn-default btn-sm btn-icon icon-left">
							<i class="entypo-pencil"></i>
							{{trans('companies.edit')}}
						</a>
						</div>


						<div class="col-lg-3">
						<form method="post" action="{{url('admin/companies')}}/{{ $company->id }}" class="FormDelete">
						{{ method_field('DELETE') }}
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<button type="submit" class="btn btn-danger btn-sm btn-icon icon-left">
						<i class="entypo-cancel"></i>
						{{trans('companies.delete')}}</button>
						</form>
						</div>
						
					</td>
				</tr>
				

			@endforeach
			</tbody>
			<tfoot>
			<tr>
                <th data-hide="phone">{{trans('companies.code')}}</th>
                <th data-hide="phone">{{trans('companies.name')}}</th>
                <th data-hide="phone">{{trans('companies.email')}}</th>
                <th data-hide="phone">{{trans('companies.phone')}}</th>
                <th data-hide="phone">{{trans('companies.status')}}</th>
				<th>{{trans('companies.actions')}}</th>
			</tr>
			</tfoot>
		</table>
		
		<br />		
		<a href="{{ url('/admin/companies/create') }}" class="btn btn-primary">
			<i class="entypo-plus"></i>
			{{trans('companies.create_company')}}
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