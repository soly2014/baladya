@extends('layouts.baladya')
@section('content')	

		<hr />
		
		<br />
		@include('partials.entete', [
		    'title' => trans('street.create_street'),
		    'icon' => 'dashboard',
		    'fil' =>  link_to('admin/street', trans('street.street')) .'  /  '.  trans('street.create_street')
		    ])
		
	<div class="row">
		<div class="col-md-12">
				
		<div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->

            <!-- panel head -->
            <div class="panel-heading">
                <div class="panel-title">{{trans('street.create_street')}}</div>
            </div>

            <!-- panel body -->
            <div class="panel-body">

                <div class="panel-body">
	
	<form role="form" class="form-horizontal form-groups-bordered" action="{{ url('/admin/street') }}" method="post">

		<input type="hidden" name="_token" value="{{ csrf_token() }}" />

		<div class="form-group">
			<label for="field-4" class="col-sm-3 control-label">{{trans('street.name')}}</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" id="field-4" name="name" placeholder="{{trans('street.name')}}" value="{{ old('name') }}">
				@if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{trans('street.required')}}</strong>
                    </span>
				@endif
			</div>
		</div>

		<div class="form-group">
			<label for="field-4" class="col-sm-3 control-label">{{trans('street.description')}}</label>
			<div class="col-sm-5">
			<textarea class="form-control" id="field-4" name="desc" placeholder="{{trans('street.description')}}">{{ old('desc') }}</textarea>
				@if ($errors->has('desc'))
                <span class="help-block">
                    <strong>{{ $errors->first('desc') }}</strong>
                    </span>
				@endif
			</div>
		</div>

		


		<div class="form-group">
			<label class="col-sm-3 control-label">{{trans('street.squar')}}</label>
				<div class="col-sm-5">
					<select name="res_quar_id" class="selectboxit" id="squarOne">
						
						@foreach($resquars as $resquar)
							<option value="{{ $resquar->id }}">{{ $resquar->name }}</option>
						@endforeach
						</optgroup>
					</select>
				</div>
		</div>



          <div class="form-group">
              <label class="col-sm-2 control-label">{{trans('street.map')}}</label>
              <div class="col-sm-8">
                  <input type="text" class="form-control" id="us3-address" name="map" value=""/>
                @if ($errors->has('map'))
                <span class="help-block">
                    <strong>{{trans('street.required')}}</strong>
                    </span>
				@endif
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-2 control-label">{{trans('street.radius')}}</label>

              <div class="col-sm-5">
                  <input type="text" class="form-control" name="radius" id="us3-radius" />
              </div>
          </div>



          <div id="us3" style="width: 550px; height: 400px;"></div>



          <div class="clearfix">&nbsp;</div>
          <div class="m-t-small">
              <label class="p-r-small col-sm-1 control-label">{{trans('street.lat')}}</label>

              <div class="col-sm-3">
                  <input type="text" class="form-control" style="width: 110px" id="us3-lat" name="lat" value=""/>
              </div>
              <label class="p-r-small col-sm-2 control-label">{{trans('street.long')}}</label>

              <div class="col-sm-3">
                  <input type="text" class="form-control" style="width: 110px" id="us3-lon" name="long" value=""/>
              </div>
          </div>
		
		
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-5">
				<button type="submit" class="btn btn-primary"><i class="entypo-login"></i>
				{{trans('street.create_street')}}</button>
			</div>
		</div>
	</form>
	<button id="find_btn" class="btn btn-default" style="margin-right: 799px;"><i class="entypo-compass" aria-hidden="true"></i></button>
</div>
</div>
</div>

</div>
</div>










<script>
	


	$(document).ready(function () {
		


		    long = '{{ $resquars->first()->long }}';	
		    lat    = '{{ $resquars->first()->lat }}';	

		     var data ={'lat':parseFloat(lat),'long':parseFloat(long)}; 


                               var map = new google.maps.Map(document.getElementById('us3'), {
	                                    zoom: 13,
	                                    center: {lat: data.lat, lng: data.long}
                                });

                                infoWindow = new google.maps.InfoWindow({map: map});
                                var pos = {lat: data.lat, lng: data.long};
                                $("#us3-lat").val(data.lat);
                                $("#us3-lon").val(data.long);

                                var geocoder = new google.maps.Geocoder();
                                var latLng = new google.maps.LatLng(data.lat,data.long);

			new google.maps.Marker({
			        position: pos,
			        map: map
			    });

                             if (geocoder) {
                                geocoder.geocode({ 'latLng': latLng}, function (results, status) {
                                   if (status == google.maps.GeocoderStatus.OK) {
                                       $("#us3-address").val(results[0].formatted_address);
                                   }
                                   else {
                                       $('#us3-address').val('Geocoding failed: '+status);
                                   }
                                }); 
                            }




		$('body').on('change','#squarOne',function () {
			
			var id = this.value;

			$.ajax({

			    url:'{{ url('district/location') }}',
			    type:'get',
			    data:{'id':id},
			    beforeSend:function () {

			    	//$('#Streets').html('loading....');
			    },
			    success:function (data) {

		     var data ={'lat':parseFloat(data.lat),'long':parseFloat(data.long)}; 


                               var map = new google.maps.Map(document.getElementById('us3'), {
	                                    zoom: 13,
	                                    center: {lat: data.lat, lng: data.long}
                                });

                                infoWindow = new google.maps.InfoWindow({map: map});
                                var pos = {lat: data.lat, lng: data.long};
                                $("#us3-lat").val(data.lat);
                                $("#us3-lon").val(data.long);

                                var geocoder = new google.maps.Geocoder();
                                var latLng = new google.maps.LatLng(data.lat,data.long);

			new google.maps.Marker({
			        position: pos,
			        map: map
			    });

                             if (geocoder) {
                                geocoder.geocode({ 'latLng': latLng}, function (results, status) {
                                   if (status == google.maps.GeocoderStatus.OK) {
                                       $("#us3-address").val(results[0].formatted_address);
                                   }
                                   else {
                                       $('#us3-address').val('Geocoding failed: '+status);
                                   }
                                }); 
                            }

                                // infoWindow.setPosition(pos);
                                // map.panTo(pos);



/*			    	if (data == 'false') {

			    	     $("#StreetsContainer").hide();
			    	     $("#Streets").html('لا توجد شوارع لهذا الحي');

			    	} else {

			    	     $("#StreetsContainer").show();
			    	     $("select[name='street_id'").html(' ');		
			    	     $("select[name='street_id'").html(data.view);		

			    	}
*/
			    },
			    error:function (errorres_quar_id) {
			    	alert('error in servers, please try again later');
			    }	

			});
		});
	});

</script>

<!--  editing map -->

<script type="text/javascript">
	



        





</script>

<!-- end editing map -->
@stop
