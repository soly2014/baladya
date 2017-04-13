		@if(isset($first_squars))
		@foreach($first_squars as $resQuar)
		<option value="{{$resQuar->id}}">{{$resQuar->name}}</option>
		@endforeach
		@else
		@foreach($resQuars as $resQuar)
		<option value="{{$resQuar->id}}" >{{$resQuar->name}}</option>
		@endforeach
		@endif

		
