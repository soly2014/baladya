@extends('layouts.baladya')
@section('content')		
@include('partials.entete', [
'title' => trans('healthviolation.healthviolation'),
'icon' => 'dashboard',
'fil' =>  link_to('admin/health_violation', trans('healthviolation.healthviolation'))
])
		<table class="table table-bordered datatable" id="table-1">
			<thead>
				<tr>
					<th data-hide="phone">{{trans('healthviolation.visit')}}</th>
					<th data-hide="phone">{{trans('healthviolation.status')}}</th>
					<th data-hide="phone">{{trans('healthviolation.facility')}}</th>
					<th data-hide="phone">{{trans('healthviolation.squar')}}</th>
					<th data-hide="phone">{{trans('healthviolation.visitStatus')}}</th>
					<th data-hide="phone">{{trans('healthviolation.actions')}}</th>
				</tr>
			</thead>
			<tbody>
			@foreach($healthviolations as $healthviolation)
				<tr class="odd gradeX">
					<td>
					@if($healthviolation->visit_id)
					{{ App\Models\UserVisit::find($healthviolation->visit_id)->date }}
					@endif
					</td>
					<td>
					@if($healthviolation->facility_status_id)
					{{ App\Models\FacilityStatus::find($healthviolation->facility_status_id)->name }}
					@endif
					</td>
					<td>
					@if($healthviolation->visit->facility)
					{{$healthviolation->visit->facility->banner_name}}
					@endif
					</td>


					<td>
					@if($healthviolation->visit->facility)
					
					
					@if(App\Models\ResQuar::find($healthviolation->visit->facility->res_quar_id))
					{{ App\Models\ResQuar::find($healthviolation->visit->facility->res_quar_id)->name }}
					@endif
					
					@endif
					</td>


					<td>{{$healthviolation->visit->status}}</td>


					<td>
					<div class="col-lg-2">
						<a href="{{url('/admin/health_violation')}}/{{ $healthviolation->id }}/edit" class="btn btn-default btn-sm btn-icon icon-left">
							<i class="entypo-pencil"></i>
							{{trans('healthviolation.edit')}}
						</a>
					</div>
					<div class="col-lg-2">
						<form method="post" action="{{url('admin/health_violation')}}/{{ $healthviolation->id }}" class="FormDelete">
						{{ method_field('DELETE') }}
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<button type="submit" class="btn btn-danger btn-sm btn-icon icon-left">
						<i class="entypo-cancel"></i>
						{{trans('healthviolation.delete')}}</button>
						</form>
					</div>
					</td>
				</tr>
				

			@endforeach
			</tbody>
			<tfoot>
				<tr>
					<th>{{trans('healthviolation.visit')}}</th>
					<th>{{trans('healthviolation.status')}}</th>
					<th>{{trans('healthviolation.facility')}}</th>
					<th>{{trans('healthviolation.squar')}}</th>
					<th>{{trans('healthviolation.visitStatus')}}</th>
					<th>{{trans('healthviolation.actions')}}</th>
				</tr>
			</tfoot>
		</table>
		
		<br />		
		{{-- <a href="{{ url('/admin/health_violation/create') }}" class="btn btn-primary">
			<i class="entypo-plus"></i>
			{{trans('healthviolation.create_healthviolation')}}
		</a> --}}

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