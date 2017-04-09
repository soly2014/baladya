@extends('layouts.baladya')
@section('content')		
@include('partials.entete', [
'title' => trans('facility_status.facility_status'),
'icon' => 'dashboard',
'fil' =>  link_to('admin/facility_status', trans('facility_status.facility_status'))
])



<table class="table table-bordered datatable" id="table-1">
    <thead>
        <tr>
            <th data-hide="phone">{{trans('facility_status.name') }}</th>
            <th>{{trans('facility_status.action') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($facilityStatuses as $res)
        <tr class="odd gradeX">
            <td>{{ $res->name }}</td>
            <td>

                <div class="col-lg-2">
                    {!! Form::open(['url' => url('/admin/facility_status/'.$res->id),'method' => 'DELETE']) !!}	
                    <button type="submit" class="btn btn-danger btn-sm btn-icon icon-left delete">
                        <i class="entypo-cancel"></i>
                        {{trans('facility_status.delete')}}
                    </button>
                    {!! Form::close() !!}        
                </div>
                <div class="col-lg-2">
                    <a href="{{url('/admin/facility_status/'.$res->id.'/edit')}}" class="btn btn-default btn-sm btn-icon icon-left">
                        <i class="entypo-pencil"></i>
                        {{trans('facility_status.edit')}}
                    </a>
                </div>
            </td>
        </tr>


        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th data-hide="phone">{{trans('facility_status.name') }}</th>
            <th>{{trans('facility_status.action') }}</th>
        </tr>
    </tfoot>
</table>
    
<br />		
<a href="{{ url('/admin/facility_status/create') }}" class="btn btn-primary">
    <i class="entypo-plus"></i>
    {{trans('facility_status.add')}}

</a>


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