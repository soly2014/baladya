@extends('layouts.baladya')
@section('content')	


<hr />

<br />
@include('partials.entete', [
'title' => trans('uservisit.show_uservisit'),
'icon' => 'dashboard',
'fil' =>  link_to('admin/uservisit', trans('uservisit.uservisit')) .'  /  '.  trans('uservisit.show_uservisit')
])

<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->
            <div class="panel-heading">
                <div class="panel-title">
                    {{trans('uservisit.uservisit')}}
                </div>
            </div>
            <!-- panel body -->
            <div class="panel-body">
                <div class="panel-body">

                    <div class="col-md-12">
                        <label class="col-sm-3 control-label">{{trans('uservisit.facility')}}</label>
                        <input id="userVisitId" type="hidden" value="{{ $userVisit->id }}" />
                        <div class="col-sm-5">
                        @if($userVisit->facility)
                            {{ $userVisit->facility->banner_name }}
                        @endif
                        </div>
                    </div>



                    <div class="col-md-12">
                        <label class="col-sm-3 control-label">{{trans('uservisit.user')}}</label>
                        <div class="col-sm-5" >
                            @if($userVisit->user)
                            {{ $userVisit->user->first_name.' '.$userVisit->user->last_name  }}
                            @endif
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="col-sm-3 control-label">{{trans('uservisit.squar')}}</label>
                        <div class="col-sm-5" >
                            @if(App\Models\Facility::find($userVisit->facility_id))
                            @if( App\Models\ResQuar::find(App\Models\Facility::find($userVisit->facility_id)->res_quar_id))

                                {{App\Models\ResQuar::find(App\Models\Facility::find($userVisit->facility_id)->res_quar_id)->name}}

                            @endif
                            @endif
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="col-sm-3 control-label">{{trans('uservisit.street')}}</label>
                        <div class="col-sm-5" >
                            @if(App\Models\Facility::find($userVisit->facility_id))
                            @if( App\Models\Street::find(App\Models\Facility::find($userVisit->facility_id)->street_id))

                                {{App\Models\Street::find(App\Models\Facility::find($userVisit->facility_id)->street_id)->name}}

                            @endif
                            @endif
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="col-sm-5" >
                        @if(session('user_role') == 'moderator' || session('user_role') == 'admin' )
                            <input id='addv' type="button" class="btn btn-primary" value="{{trans('uservisit.addViolation')}}" />
                        @endif
                        </div>
                    </div>
                

                </div>
            </div>
        </div>

        @if(session('user_role') == 'contra_manager')

          @if($hviolation)
              <div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->
              <div class="panel-heading">
                  <div class="panel-title">
                      {{trans('uservisit.violation')}}
                  </div>
              </div>
              <!-- panel body -->
              <div class="panel-body">
                  <div class="panel-body">
                  
                      <table class="table table-bordered datatable vTable" id="table-1">
                        <thead>
                          <tr>
                            <th data-hide="phone">{{trans('uservisit.name')}}</th>
                          </tr>
                        </thead>
                        
                        <tbody id="hViolations">
                        
                        @if($hviolation->healthenvtypes)
                        @foreach($hviolation->healthenvtypes as $henv)
                          <tr><td>{{ $henv->name }}</td></tr>
                        @endforeach
                        @endif
                        </tbody>
                        

                        <tfoot>
                          <tr>
                            <th>{{trans('uservisit.name')}}</th>
                          </tr>
                        </tfoot>
                      </table>
                      
                      <div id="noticeForm" class="col-sm-10">
                         <label class="col-sm-3 control-label">{{trans('uservisit.notice')}}</label>
                         <p id="showNotice">{{$hviolation->notice}}</p>
                        
                      </div>
                  </div>
              </div>
          </div>
          @endif

        @else
        <div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->
            <div class="panel-heading">
                <div class="panel-title">
                    {{trans('uservisit.violation')}}
                </div>
            </div>
            <!-- panel body -->
            <div class="panel-body">
                <div class="panel-body">
                @if($hviolation)
                    <table class="table table-bordered datatable vTable" id="table-1">
                @else
                    <table class="table table-bordered datatable vTable" id="table-1" style="display:none;">
                @endif
                      <thead>
                        <tr>
                          <th data-hide="phone">{{trans('uservisit.name')}}</th>
                        </tr>
                      </thead>
                      
                      <tbody id="hViolations">
                      @if($hviolation)
                      @if($hviolation->healthenvtypes)
                      @foreach($hviolation->healthenvtypes as $henv)
                        <tr><td>{{ $henv->name }}</td></tr>
                      @endforeach
                      @endif
                      @endif
                      </tbody>
                      

                      <tfoot>
                        <tr>
                          <th>{{trans('uservisit.name')}}</th>
                        </tr>
                      </tfoot>
                    </table>
                    
                    <div id="noticeForm" class="col-sm-10">
                       <label class="col-sm-3 control-label">{{trans('uservisit.notice')}}</label>
                       @if($hviolation)
                       
                       <textarea id="enterNotice" class="form-control" style="display:none;"></textarea>
                       @if($hviolation->notice)
                       <p id="showNotice">{{$hviolation->notice}}</p>
                       @endif
                       <button id="noticeSubmit" style="display:none;" class="btn btn-primary">{{trans('uservisit.addNotice')}}</button>
                       
                       @else
                       <textarea id="enterNotice" class="form-control"></textarea>
                       <p id="showNotice"></p>
                       <button id="noticeSubmit" class="btn btn-primary">{{trans('uservisit.addNotice')}}</button>
                       
                       
                       @endif
                    </div>
                    @if(session('user_role') == 'moderator')
                    @if($userVisit->status == 'لم تتم الزياره')
                    <button id="finishVisit" class="btn btn-primary col-md-offset-5">{{trans('uservisit.finishVisit')}}</button>
                    @endif
                    @endif
                </div>
            </div>
        </div>
        @endif


    </div>
</div>

    <div id="addenvs" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" style="color:black;">{{trans('uservisit.healthenvs')}}</h4>
          </div>
          <div class="modal-body">
      <table class="table table-bordered datatable" id="table-1">
      <thead>
        <tr>
          <th data-hide="phone">{{trans('uservisit.name')}}</th>
          <th data-hide="phone">{{trans('uservisit.choose')}}</th>
        </tr>
      </thead>

      <tbody id="envchecks">
      </tbody>
      <tfoot>
        <tr>
          <th>{{trans('uservisit.name')}}</th>
          <th>{{trans('uservisit.choose')}}</th>
        </tr>
      </tfoot>
    </table>
                    
          </div>
          <div class="modal-footer">
              <button id="submit" type="button" class="btn btn-success" data-dismiss="modal">{{trans('uservisit.updatepass')}}</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">{{trans('uservisit.close')}}</button>
          
          </div>
        </div>

      </div>
    </div>

@section('scripts')
    <script>
        $(document).ready(function($) {
               $('#addv').on('click', function(event) {
                   event.preventDefault();
                   /* Act on the event */
                   $.ajax({
                       url: '/admin/violationtypes/'+{{$userVisit->facility_id}},
                       type: 'GET',
                       dataType: 'json'
                   })
                   .done(function(response) {
                       $('#envchecks').html('');
                       for (var i = response['dayvisits'].length - 1; i >= 0; i--) {
                         $('#envchecks').append('<tr><td>' + response['dayvisits'][i]['name'] +  '</td><td><input type="checkbox" value="'+
                          response['dayvisits'][i]['id'] +'"/></td></tr>');
                       };

                       $('#addenvs').modal('toggle');
                   })
                   .fail(function() {
                       console.log("error");
                   })
                   .always(function() {
                       console.log("complete");
                   });
                   
               });

              $('#submit').on('click', function(event) {
                event.preventDefault();
                /* Act on the event */

                var hviolations = [];
                $.each($("input[type='checkbox']:checked"), function(){            
                    hviolations.push($(this).val());
                });

                $.ajax({
                  url: '/admin/health_violation/save',
                  type: 'POST',
                  dataType: 'json',
                  data: {hviolations: hviolations, userVisitId:$('#userVisitId').val(),facilityStatus:0},
                })
                .done(function(response) {
                  $('#hViolations').html('');
                  for (var i = response['hviolations'].length - 1; i >= 0; i--) {
                     $('#hViolations').append('<tr><td>' + response['hviolations'][i]['name'] +  '</td></tr>');
                   };

                   $('.vTable').css('display', '');
                   $('#noticeForm').css('display', 'block');
                })
                .fail(function() {
                  console.log("error");
                })
                .always(function() {
                  console.log("complete");
                });
              });
              


              $('#noticeSubmit').on('click', function(event) {
                event.preventDefault();
                /* Act on the event */
                if($('#enterNotice').val() != '')
                {
                    $.ajax({
                      url: '/admin/health_violation/save/notice',
                      type: 'POST',
                      dataType: 'json',
                      data: {notice: $('#enterNotice').val(), userVisitId:$('#userVisitId').val()},
                    })
                    .done(function(response) {
                      $('#noticeSubmit').css('display', 'none');
                      $('#enterNotice').css('display', 'none');
                      $('#showNotice').html(response['hviolation']['notice']); 
                    })
                    .fail(function() {
                      console.log("error");
                    })
                    .always(function() {
                      console.log("complete");
                    });
                }else{
                    $('#enterNotice').css('border-color', 'red');
                }
              });

              $('#finishVisit').on('click', function(event) {
                event.preventDefault();
                /* Act on the event */
                $.ajax({
                  url: '/admin/uservisit/finish',
                  type: 'POST',
                  dataType: 'json',
                  data: { userVisitId: $('#userVisitId').val() },
                })
                .done(function(response) {
                  if(response['ok'] == 'OK'){
                    $('#finishVisit').css('display', 'none');
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
@endsection




@stop