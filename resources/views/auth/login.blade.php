@extends('layouts.login')

@section('content')

    <div class="section home active parallax-background image-4 login" id="section0">
        <div id="large-header" class="large-header">
            <canvas id="demo-canvas1"></canvas>
        </div>
        <!-- START CONTAINER -->
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">


                    <a href="{{url('/')}}"><img src="{{url('landing/images/logo2.png')}}" /></a>
                    <h3>تسجيل الدخول</h3>
                    <div class="line-separate line-white line-center" data-animation-delay="200"><span></span></div>
                    @if(session()->has('error'))

                        @include('partials/error', ['type' => 'danger', 'message' => session('error')])
                    @endif

                    {!! Form::open(['url' => 'login']) !!}

                    <input type="hidden" name="type" value="{{$type}}" />
                    <div class="form-group">
                        <input type="text" name="code" placeholder="{{trans('auth.code')}}" />
                        @if ($errors->has('code'))
                        <span class="help-block">
                            <strong style="color:red;">{{trans('facility.required')}}</strong>
                            </span>
                        @endif
                        {{--{!! Form::controlBootstrap('text', 12, 'code', $errors, '','','',trans('auth.code')) !!}--}}
                    </div>

                    <div class="form-group">
                        <input type="password" name="password" placeholder="{{trans('auth.password')}}" />
                        @if ($errors->has('password'))
                        <span class="help-block">
                            <strong style="color:red;">{{trans('facility.required')}}</strong>
                            </span>
                        @endif
                        {{--{!! Form::controlBootstrap('password', 6, 'password', $errors, '','','',trans('auth.password')) !!}--}}
                    </div>
                    <div>
                        <a href="#" id="forget" >{{trans('auth.forget')}}</a>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="دخول" />
                    </div>

                    {!! Form::close() !!}
                </div>

            </div><!-- END ROW -->
        </div><!-- END CONTAINER -->
        <!-- OVERLAY -->
        <div class="overlay">
            <div class="gradient-overlay background-blue-dark opacity-40"></div>
        </div>
    </div>

    <div id="editPassword" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" style="color:black;">{{trans('auth.modalheader')}}</h4>
          </div>
          <div class="modal-body">
                <div>
                    <span id="erroruser"></span>
                </div>
                <form id="passwordform" role="form" class="form-horizontal form-groups-bordered" action="{{ url('/users/pass') }}" method="post">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    
                    <div class="form-group">
                        <input id='code' type="text" name="code" style="background-color:aliceblue;" placeholder="{{trans('auth.code')}}" />
                        @if ($errors->has('code'))
                        <span class="help-block">
                            <strong style="color:red;">{{trans('facility.required')}}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <input id="password" type="password" name="password" style="background-color:aliceblue;" placeholder="{{trans('auth.password')}}" />
                        @if ($errors->has('password'))
                        <span class="help-block">
                            <strong style="color:red;">{{trans('facility.required')}}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input id="confirmpassword" type="password" name="password" style="background-color:aliceblue;" placeholder="{{trans('auth.password')}}" />
                        @if ($errors->has('password'))
                        <span class="help-block">
                            <strong style="color:red;">{{trans('facility.required')}}</strong>
                            </span>
                        @endif
                    </div>
                    <button id="submit" type="button" class="btn btn-success">{{trans('auth.updatepass')}}</button>
                </form>
                    
          </div>
          <div class="modal-footer">
          
              <button type="button" class="btn btn-danger" data-dismiss="modal">{{trans('auth.close')}}</button>
          
          </div>
        </div>

      </div>
    </div>


@endsection

@section('scripts')
 <script>
 $(document).ready(function() {
    $('#forget').on('click', function(event) {
        event.preventDefault();
        /* Act on the event */
        $('#editPassword').modal('toggle');
    });

    $('#submit').on('click', function(event) {
        if($('#code').val()=='')
        {
            $('#code').css('border-color', 'red');
            return false;
        }

        if($('#password').val()=='')
        {
            $('#password').css('border-color', 'red');
            return false;
        }

        if($('#confirmpassword').val()=='')
        {
            $('#confirmpassword').css('border-color', 'red');
            return false;
        }

        if($('#password').val() != $('#confirmpassword').val())
        {
            $('#password').css('border-color', 'red');
            $('#confirmpassword').css('border-color', 'red');
            return false;
        }

        event.preventDefault();
        /* Act on the event */
        $.ajax({
            url: '/users/pass',
            type: 'POST',
            dataType: 'json',
            data: {code: $('#code').val() , password: $('#password').val() , confirmpassword: $('#confirmpassword').val() },
        })
        .done(function(response) {
            if(response['status'])
            {
                $('#erroruser').html('تم التعديل');
                $('#erroruser').css('color', 'green');
                $('#editPassword').dismiss();
            }
            else
            {
                $('#erroruser').html('لا يوجد مستخدم بهذا الرقم');
                $('#erroruser').css('color', 'red');
                return false;
            }
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
        
    });
 });
 </script>
@stop

