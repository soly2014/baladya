@extends('layouts.baladya')
@section('content')		
<hr />

<ol class="breadcrumb bc-3" >
    <li>
        <a href="index.html"><i class="fa-home"></i>Home</a>
    </li>
    <li>

        <a href="tables-main.html">Tables</a>
    </li>
    <li class="active">

        <strong>Data Tables</strong>
    </li>
</ol>

<h2>Data Tables</h2>

<br />



<table class="table table-bordered datatable" id="table-1">
    <thead>
        <tr>
            <th data-hide="phone">{{trans('res_quar.name') }}</th>
            <th data-hide="phone">{{trans('res_quar.desc') }}</th>
            <th>{{trans('res_quar.action') }}</th>
        </tr>
    </thead>
    <tbody>
    
        @foreach($resQuars as $res)
        <tr class="odd gradeX">
            <td>{{ $res->name }}</td>
            <td>{{ $res->desc }}</td>
            <td>

                <div class="col-lg-2">
                    {!! Form::open(['url' => url('/admin/res_quar/'.$res->id),'method' => 'DELETE']) !!}	
                    <button type="submit" class="btn btn-danger btn-sm btn-icon icon-left delete">
                        <i class="entypo-cancel"></i>
                        {{trans('res_quar.delete')}}
                    </button>
                    {!! Form::close() !!}        
                </div>
                <div class="col-lg-2">
                    <a href="{{url('/admin/res_quar/'.$res->id.'/edit')}}" class="btn btn-default btn-sm btn-icon icon-left">
                        <i class="entypo-pencil"></i>
                        {{trans('res_quar.edit')}}
                    </a>
                </div>
            </td>
        </tr>


        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th data-hide="phone">{{trans('res_quar.name') }}</th>
            <th data-hide="phone">{{trans('res_quar.desc') }}</th>
            <th>{{trans('res_quar.action') }}</th>
        </tr>
    </tfoot>
</table>

<br />		
<a href="{{ url('/admin/res_quar/create') }}" class="btn btn-primary">
    <i class="entypo-plus"></i>
    {{trans('res_quar.add')}}

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