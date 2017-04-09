@extends('layouts.baladya')
@section('content')	

<hr />

<ol class="breadcrumb bc-3" >
    <li>
        <a href="index.html"><i class="fa-home"></i>Home</a>
    </li>
    <li>

        <a href="forms-main.html">Forms</a>
    </li>
    <li class="active">

        <strong>Basic Elements</strong>
    </li>
</ol>

<h2>Basic Form Elements</h2>
<br />


<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    Create Activity 
                </div>

                <div class="panel-options">
                    <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
                    <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                    <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                    <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                </div>
            </div>

            <div class="panel-body">

                <form role="form" class="form-horizontal form-groups-bordered" action="{{ url('/admin/activity/save') }}" method="post">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                    <div class="form-group">
                        <label for="field-4" class="col-sm-3 control-label">name</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="field-4" name="name" placeholder="Placeholder" value="{{ old('title') }}">
                            @if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-default">Create Activity</button>
                        </div>
                    </div>
                </form>

            </div>

        </div>

    </div>
</div>







@stop
