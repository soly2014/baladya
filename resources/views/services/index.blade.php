@extends('layouts.baladya')
@section('content')		

@include('partials.entete', [
'title' => trans('service.service'),
'icon' => 'dashboard',
'fil' =>  link_to('admin/service', trans('service.service'))
])
<table class="table table-bordered datatable" id="table-1">
    <thead>
        <tr>
            <th data-hide="phone">{{trans('service.name')}}</th>
            <th>{{trans('service.actions')}}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($services as $service)
        <tr class="odd gradeX">
            <td>{{ $service->name }}</td>
            <td>
                <div class="col-lg-2">
                    <a href="{{url('/admin/service')}}/{{ $service->id }}/edit" class="btn btn-default btn-sm btn-icon icon-left">
                        <i class="entypo-pencil"></i>
                        {{trans('service.edit')}}
                    </a>
                </div>
                <div class="col-lg-2">
                    {!! Form::open(['url' => url('admin/service/'.$service->id),'class'=>'FormDelete', 'method' => 'DELETE']) !!}	
                    {!! Form::destroyBootstrap(trans('service.delete'), trans('back/comments.destroy-warning'), 'btn btn-default btn-sm btn-icon icon-left') !!}
                    {!! Form::close() !!}
                </div>
            </td>
        </tr>


        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>{{trans('service.name')}}</th>
            <th>{{trans('service.actions')}}</th>
        </tr>
    </tfoot>
</table>

<br />		
<a href="{{ url('/admin/service/create') }}" class="btn btn-primary">
    <i class="entypo-plus"></i>
    {{trans('service.create_service')}}
</a>

@endsection


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





