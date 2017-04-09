@extends('layouts.baladya')
@section('content')	

        <hr />
        
        <br />

            @include('partials.entete', [
    'title' => trans('facility_status.create_facility_status'),
    'icon' => 'dashboard',
    'fil' =>  link_to('admin/facility_status', trans('facility_status.facility_status')) .'  /  '.  trans('facility_status.create_facility_status')
    ])
        
    <div class="row">
    <div class="col-md-12">
        <div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->

            <!-- panel head -->
            <div class="panel-heading">
                <div class="panel-title">{{trans('facility_status.create_facility_status')}}</div>
            </div>

            <!-- panel body -->
            <div class="panel-body">

                <div class="panel-body">

                {!! Form::open(['url' => url('/admin/facility_status')]) !!}	
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="form-group">
                    {!! Form::controlBootstrap('text', 12, 'name', $errors, '','','',trans('facility_status.name')) !!}
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="entypo-login"></i>
                            {{trans('facility_status.save')}}
                        </button>
                    </div>
                </div>
                {!! Form::close() !!}

            </div>
          </div>
        </div>

    </div>
</div>







@stop
