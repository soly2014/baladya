@extends('layouts.baladya')
@section('content')	

<hr />

<br />

    @include('partials.entete', [
    'title' => trans('service.create_service'),
    'icon' => 'dashboard',
    'fil' =>  link_to('admin/service', trans('service.service')) .'  /  '.  trans('service.create_service')
    ])
    
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->

            <!-- panel head -->
            <div class="panel-heading">
                <div class="panel-title">{{trans('service.create_service')}}</div>
            </div>

            <!-- panel body -->
            <div class="panel-body">

                <div class="panel-body">

                    {!! Form::open(['url' => url('/admin/service')]) !!}	
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="form-group">
                        {!! Form::controlBootstrap('text', 12, 'name', $errors, '','','',trans('res_quar.name')) !!}
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">
                                <i class="entypo-login"></i>
                                {{trans('service.create_service')}}
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
