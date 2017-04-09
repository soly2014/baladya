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

<table class="table table-bordered datatable" id="table-1">
    <thead>
        <tr>
            <th data-hide="phone">Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($activities as $activity)
        <tr class="odd gradeX">
            <td>{{ $activity->name }}</td>
            <td>
                <a href="{{url('/admin/activity/edit')}}/{{ $activity->id }}" class="btn btn-default btn-sm btn-icon icon-left">
                    <i class="entypo-pencil"></i>
                    Edit
                </a>

                <a href="{{url('/admin/activity/delete')}}/{{ $activity->id }}" class="btn btn-danger btn-sm btn-icon icon-left">
                    <i class="entypo-cancel"></i>
                    Delete
                </a>
            </td>
        </tr>


        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>Name</th>
            <th>Actions</th>
        </tr>
    </tfoot>
</table>

<br />		
<a href="{{ url('/admin/activity/create') }}" class="btn btn-primary">
    <i class="entypo-plus"></i>
    Add Row
</a>

@stop