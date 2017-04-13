		@foreach($first_squars as $resQuar)
		<option value="{{$resQuar->id}}" id="res{{$resQuar->id}}">{{$resQuar->name}}</option>
		@endforeach
