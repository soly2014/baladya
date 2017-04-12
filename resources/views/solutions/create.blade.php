@extends('layouts.baladya')
@section('content')	


<hr />

<br />


<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            

                            <?php switch (session('user_role')) {

                                case 'moderator':
                                    echo "عرض الحلول";
                                    break;
                                
                                case 'manager':
                                    echo "اداره";
                                    break;

                                case 'contra_moderator':
                                    echo "اضافه حل";
                                    break;
                                
                                case 'admin':
                                    echo "اداره";
                                    break;
                                
                                default:
                                    echo "عرض";
                                    break;
                            } ?>

        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <span class="fa fa-dashboard"></span> <a href="javascript:;">اداره الحلول</a> /
                

                            <?php switch (session('user_role')) {

                                case 'moderator':
                                    echo "عرض الحلول";
                                    break;
                                
                                case 'manager':
                                    echo "اداره";
                                    break;

                                case 'contra_moderator':
                                    echo "اضافه حل";
                                    break;
                                
                                case 'admin':
                                    echo "اداره";
                                    break;
                                
                                default:
                                    echo "عرض";
                                    break;
                            } ?>


            </li>
        </ol>
    </div>
</div>



<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->
            <div class="panel-heading">
                <div class="panel-title">
                    {{ trans('solution.violation') }}
                </div>
            </div>







            @if(session('user_role')!='moderator')
            <hr/>
            <div class="alert alert-success alert-dismissable hidden"> 
                    <button type="button" class="close" id="close_flash" data-dismiss="alert" aria-hidden="true">×</button>  
                    <i class="icon-check-sign"></i> <p id ="flash"></p>                   
            </div>
            
            <div class="panel-body violation" id="{{$violation->id}}">
                <form method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />


                    @if($violation->status['id'] == $statuses['new']   &&  session('user_role') != 'manager')
                    <div class="col-md-2" id='running'>
                        <input type="button" value="{{trans('violation.start')}}" class="change_status btn btn-primary" name="start_work"
                               status="{{$statuses['running']}}"/>
                    </div>                       

                    @elseif($violation->status['id'] == $statuses['running']  &&  session('user_role') != 'manager')
                    <div class="col-md-2" id="waiting">
                        <input type="button" value="{{trans('violation.finish')}}" class="change_status btn btn-primary" name="waiting_work"
                               status="{{$statuses['waiting']}}"/>
                    </div>                         

                    @elseif($violation->status['id'] == $statuses['waiting'] && (Sentinel::getUser()->roles[0]->slug =='admin' || Sentinel::getUser()->roles[0]->slug =='manager'))
                    <div class="col-md-2" id="accepted">
                        <input type="button" value="{{trans('violation.accept')}}" class="change_status btn btn-primary" name="accept_solution"
                               status="{{$statuses['accepted']}}"/>
                    </div>                     
                    <div class="col-md-2" id="rejected">
                        <input type="button" value="{{trans('violation.reject')}}" class="change_status btn btn-primary" name="reject_solution"
                               status="{{$statuses['rejected']}}"/>
                    </div>
                    @endif 


                    @if((Sentinel::getUser()->roles[0]->slug =='admin'||Sentinel::getUser()->roles[0]->slug =='manager')  && $violation->status['id'] != $statuses['finished'])
                    
                    <div class="col-md-2" id='finish'>
                        <input type="button" value="{{trans('violation.close')}}" class="change_status btn btn-primary" name="finish_work" id="finish_work"
                               status="{{$statuses['finished']}}"/>
                    </div>
                    @endif



                    @if(session('user_role')!='contra_moderator')
                        <div class="col-md-1">{{trans('solution.penalty')}}</div>

                        <div class="col-md-3">

                        <select class="form-control" data-id="{{$violation->id}}" id="penalty">
                        @if($violation_type)
                            <option value="{{trans('solution.nopenalty')}}">{{trans('solution.nopenalty')}}</option>
                            <option value="{{trans('solution.max')}}{{$violation_type->
                            max_amount}}">
                            {{trans('solution.max')}}{{$violation_type->max_amount}}
                            </option>
                            <option value="{{trans('solution.amount')}}{{$violation_type->amount}}">{{trans('solution.amount')}}{{$violation_type->amount}}</option>
                            <option value="{{trans('solution.min')}}{{$violation_type->min_amount}}">{{trans('solution.min')}}{{$violation_type->min_amount}}</option>
                            <option value="4">{{trans('solution.custom_penalty')}}</option>
                        @endif
                        </select>
                        </div>
                    @endif
                </form>

                @if(session('user_role')=='admin'||session('user_role')=='manager')
                <form role="form" class="form-horizontal form-groups-bordered" action="{{ url('/admin/violation/custompenalty') }}" method="post" enctype="multipart/form-data" id="custompenaltyform">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" name="violation_id" value="{{$violation->id}}" />

                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="field-4" name="custom_penalty" placeholder="Placeholder" value="{{ old('custom_penalty') }}">
                        @if ($errors->has('custom_penalty'))
                        <span class="help-block">
                            <strong>{{trans('solution.required')}}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-primary"><i class="entypo-login"></i>
                                
                            {{trans('solution.addpenalty')}}
                              
                        </button>
                    </div>
                </form>
                @endif
            </div>
            <hr />
            @endif
            <!-- panel body -->
            <div class="panel-body">
                <div class="panel-body">

                    <div class="col-md-12">
                        <label class="col-sm-3 control-label">{{trans('violation.squar')}}</label>
                        <div class="col-sm-5">
                                   {{ \App\Models\ResQuar::find($violation->res_quar_id)->name }}
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="col-sm-3 control-label">{{trans('violation.street')}}</label>
                        <div class="col-sm-5">
                        @if(count($violation->street)>0)
                            {{ $violation->street->name }}
                        @else 
                             لا يوجد شارع لهذا الحى  
                        @endif
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="col-sm-3 control-label">{{trans('violation.desc')}}</label>
                        <div class="col-sm-5" >
                            {{ $violation->desc }}
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="col-sm-3 control-label">{{trans('violation.code')}}</label>
                        <div class="col-sm-5" >
                            {{ $violation->code }}
                        </div>
                    </div>

                     <div class="col-md-12">
                        <label class="col-sm-3 control-label">{{trans('violation.violation_type')}}</label>
                        <div class="col-sm-5" >
                            {{ $violation->violationtype->name }}
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="col-sm-3 control-label">{{trans('violation.violation_status')}}</label>
                        <div class="col-sm-5" id="violation_status">
                            {{ $violation->status->name }}
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="col-sm-3 control-label">{{trans('violation.penalty')}}</label>
                        <div class="col-sm-5" id="penaltyvalue">
                            @if(count($penalty)>0)
                            {{ $penalty->name }}
                            @else
                            {{ trans('solution.nopenalty') }}
                            @endif
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="field-4" class="col-sm-3 control-label">{{trans('violation.custom_penalty')}}</label>
                        <div class="col-sm-5">
                            {{ $violation->custom_penalty }}
                        </div>
                    </div>

                    @if($violation->video)
                    <div class="col-md-12">
                        <label for="field-4" class="col-sm-3 control-label">{{trans('violation.video')}}</label>
                        <div class="col-sm-5">
                            <video width="320" height="240" controls>
                              <source src="{{url('/')}}{{$violation->video}}" type="video/mp4">
                              Your browser does not support the video tag.
                            </video>
                        </div>
                    </div>
                    @endif

                    @if($violation->audio)
                    <div class="col-md-12">
                        <label for="field-4" class="col-sm-3 control-label">{{trans('violation.voice')}}</label>
                        <div class="col-sm-5">
                            <audio width="320" height="240" controls>
                               <source src="{{url('/')}}{{$violation->audio}}" type="audio/mpeg">
                               Your browser does not support the audio element.
                            </audio>
                        </div>
                    </div>
                    @endif

                   



                    <div class="col-md-12">
                        <label class="col-sm-3 control-label">{{trans('solution.image')}}</label>

                        <div class="row">
                            <div class="col-lg-12">


                                @foreach($images as $image)
                                <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                                    <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Im so nice" data-caption="And if there is money left, my girlfriend will receive this car" data-image="{{url('/')}}{{$image->image}}" data-target="#image-gallery">
                                        <img class="img-responsive" src="{{url('/')}}{{$image->image}}" alt="Another alt text">
                                    </a>
                                </div>
                                @endforeach
                            </div>


                            <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only"></span></button>
                                            <h4 class="modal-title" id="image-gallery-title"></h4>
                                        </div>
                                        <div class="modal-body">
                                            <img id="image-gallery-image" class="img-responsive" src="">
                                        </div>
                                        <div class="modal-footer">

                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-primary" id="show-previous-image">{{trans('solution.previous')}}</button>
                                            </div>

                                            <div class="col-md-8 text-justify" id="image-gallery-caption">
                                                
                                            </div>

                                            <div class="col-md-2">
                                                <button type="button" id="show-next-image" class="btn btn-default">{{trans('solution.next')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="field-4" class="col-sm-3 control-label">{{trans('violation.address')}}</label>
                        <div class="col-sm-5">
                            {{ $violation->address }}
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="field-4" class="col-sm-1 control-label">{{trans('violation.map')}}</label>
                        <div class="col-sm-5">
                            <div id="map"></div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>












<!--  add single comment show [ solution recieved ] -->

@if($violation->seen == 1)
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->
            <div class="panel-heading">
                <div class="panel-title">
                    @if(session('user_role')!='moderator')
                            {{trans('solution.singlesolution')}}</button>
                    @else
                            {{trans('solution.comment')}}
                    @endif
                </div>
            </div>
            <!-- panel body -->
            <div class="panel-body">
                <div class="panel-body">
                    <div class="col-md-3">
                        <h4 class="col-sm-12 control-label"><i class="entypo-user"></i>
                        </h4>
                        <h5 class="col-sm-12 control-label"><i class="entypo-clock"></i>

                        </h5>
                    </div>

                    <div class="col-md-5">
                        <label class="col-sm-3 control-label">{{trans('solution.comment')}}</label>
                        <div class="col-sm-5">
                        تم استلام المخالفه وعليك البدا بالحل الان
                        </div>
                    </div>

                    <div class="col-md-4">
                         
                        
                        <div class="col-sm-5">



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- end single comment -->

@endif









@foreach($solutions as $solution)
<div class="row">
    <div class="col-md-12">
    
    <?php 

        if ($solution->user_role == 'moderator') {

            $class = 'panel-warning';

        } else if($solution->user_role == 'manager'){

            $class = 'panel-info';

        } else if($solution->user_role == 'contra_moderator'){

            $class = 'panel-danger';

        }else {

            $class = 'panel-default';

        }
        
     ?>


        <div class="panel {{ $class }} panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->
            <div class="panel-heading">
                <div class="panel-title">


                    @if(session('user_role') != 'moderator'  )
                            {{trans('solution.singlesolution')}}</button>
                    @else
                            {{trans('solution.comment')}}
                    @endif



                </div>
            </div>
            <!-- panel body -->
            <div class="panel-body">
                <div class="panel-body">
                    <div class="col-md-3">
                        <h4 class="col-sm-12 control-label"><i class="entypo-user"></i>{{ App\Models\User::findOrFail($solution->user_id)->first_name." ".App\Models\User::findOrFail($solution->user_id)->last_name." (".App\Models\User::findOrFail($solution->user_id)->roles()->first()->name.")"  }}</h4>
                        <h5 class="col-sm-12 control-label"><i class="entypo-clock"></i>
                            {{ $solution->created_at }}
                        </h5>
                    </div>

                    <div class="col-md-5">
                        <label class="col-sm-3 control-label">{{trans('solution.comment')}}</label>
                        <div class="col-sm-5">

                            {{ $solution->description }}
                        </div>
                    </div>

                    <div class="col-md-4">
                         
                        
                        <div class="col-sm-5">
                        @if($solution->image)
                            <label class="col-sm-3 control-label">{{trans('solution.image')}}</label>
                            <img id="myImg" src="{{url('/')}}{{$solution->image}}" alt="{{trans('violation.image')}}" class="oneimage" data-id="{{$solution->id}}" width="200" height="100">
                        @endif

                            <!-- The Modal -->
                            <div id="myModal{{$solution->id}}" data-id='{{$solution->id}}' class="modal">

                                <!-- The Close Button -->
                                <span id="c{{$solution->id}}" class="closeimg">&times;</span>

                                <!-- Modal Content (The Image) -->
                                <img class="modal-content" id="img0{{$solution->id}}" data-id="{{$solution->id}}">

                                <!-- Modal Caption (Image Text) -->
                                <div id="caption"></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach




<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->
            <div class="panel-heading">
                <div class="panel-title">
<!-- admin -->
                    @if(session('user_role') != 'moderator'  && session('user_role') != 'manager'  )

                                    {{ trans('solution.create_solution') }}

                    @else
                                    {{ trans('solution.create_comment') }}
                    @endif
                </div>
            </div>
            <!-- panel body -->
            <div class="panel-body">
                <div class="panel-body">

                    <form role="form" class="form-horizontal form-groups-bordered" action="{{ url('/admin/violation/{violation}/solution') }}" id="formID" method="post" enctype="multipart/form-data">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                        <input type="hidden" name="user_id" value="{{ session('user_object')->id }}" />

                        <input type="hidden" name="violation_id" value="{{ $violation->id }}" />

                        <div class="form-group">
                            <label for="field-4" class="col-sm-3 control-label">
                         

                            @if(session('user_role')!='moderator'  && session('user_role')!='manager')
                                     {{trans('solution.description')}}
                            @else
                                    {{trans('solution.create_comment')}}
                            @endif
                           
                            </label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="field-4" name="description" placeholder="" value="{{ old('description') }}">
                                @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{trans('solution.required')}}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <!-- add hidden input -->
                        <input type="hidden" name="user_role" value="{{ session('user_role') }}">

                        <div class="form-group">
                            <label class="col-sm-3 control-label">{{trans('violation.uploadImage')}}</label>

                            <div class="col-sm-5">

                                <input name="image" type="file" class="form-control inline btn btn-primary" data-label="<i class='glyphicon glyphicon-circle-arrow-up'></i> &nbsp;Browse Files" />

                            </div>
                        </div>

                        <!-- add messages -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label"></label>
                                <div id="productEditErrors">
                                        </div>
                            </div>
                        <!-- end add messages -->

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" id="applyFilter" class="btn btn-primary"><i class="entypo-login"></i>
                    @if(session('user_role') != 'moderator'  && session('user_role') != 'manager'  )

                                    {{ trans('solution.create_solution') }}

                    @else
                                    {{ trans('solution.create_comment') }}
                    @endif
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>

    </div>
</div>



@stop
@section('scripts')
<script>
    
    if(localStorage.getItem("message") != "")
     {
         $(".alert").removeClass('hidden');
         $("#flash").html(localStorage.getItem("message"));
         localStorage.setItem('message',"");
         setTimeout(function(){ $(".alert").addClass('hidden');},10000 );
     }
    $(".change_status").on('click', function () {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('value');
        var id = $(".violation").attr('id');
        var status = $(this).attr('status');
        change_violation_status(id, status, CSRF_TOKEN);
    });

    function change_violation_status(id, new_status, token)
    {
        var role = "{{Sentinel::getUser()->roles[0]->slug}}";
        $.ajax({
            method: "POST",
            url: "{{url('admin/violation/change_status')}}",
            data: {_token: token, id: id, new_status: new_status},
            success: function (response) {
                localStorage.setItem("message", "تم تغيير حاله المخالفه بنجاح ");
                window.location.reload();
            },
            error: function (response) {

            }
        });
    }

    $('#penalty').on('change', function(event) {
    	event.preventDefault();
    	/* Act on the event */
    	var penalty=$(this).val();

        if(penalty != 4)
        {
            $('#custompenaltyform').css('display','none');
            var x = confirm('هل تريد تغيير الغرامه الي '+penalty);
            if (x) {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "{{url('admin/violation/penalty')}}",
                    type: 'POST',
                    data: {_token: CSRF_TOKEN,
                                name: $(this).val(),
                                violation_id: $(this).attr('data-id')
                    },
                    dataType: 'JSON',
                    success: function (data) {
                            if(data['status']=='success'){


                                $('#penaltyvalue').html(penalty);

                            }
                    }
                });
            } else {

                event.preventDefault();
                return false;
            }
        }else{
            $('#custompenaltyform').css('display','block');
        }

    	
    });


    function initMap() {
        var uluru = {lat: {{ ($violation->latitude)? $violation->latitude: 0  }}, lng: {{($violation->longitude)? $violation->longitude: 0 }} };
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }

</script>
<!-- 


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.1/jquery.form.min.js"></script>
<script type="text/javascript">

    $(document).ready(function () {
        


    /* edit Production Company form */
    $('#formID').ajaxForm({

        beforeSubmit: function() {

            $('#applyFilter').html('جاري التحميل...');

        },
        success: function(response) {
             
            $('#applyFilter').html('اضافه  حل');
            $('#productEditErrors').html('<div class="alert alert-success">تمت الاضافه بنجاح</div>'); //appending to a <div id="form-errors"></div> inside form

        },
        error: function(error) {
            //process validation errors here.
            var errors = error.responseJSON; //this will get the errors response data.
            //show them somewhere in the markup
            //e.g
            errorsHtml = '<div class="alert alert-danger"><ul>';

            $.each(errors, function(key, value) {
                errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
            });
            errorsHtml += '</ul></div>';
            $('#productEditErrors').html(errorsHtml); //appending to a <div id="form-errors"></div> inside form
            // swal(errorsHtml); //appending to a <div id="form-errors"></div> inside form

            $('#applyFilter').html('اضافه  حل');


        },

    });
    /* end edit Production Company form */

    

    });

</script> -->

<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCwon8Jnv37KIWpmnlhtB7Ua49ZvaEVkmk&callback=initMap">
    </script>


@endsection






