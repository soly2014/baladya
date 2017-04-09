		<!-- type one -->
		<div class="form-group">
			<label class="col-sm-3 control-label">{{trans('violationtype.health_env')}}</label>
				<div class="col-sm-5">
					<select name="health_env_type_id" class="selectboxit">
					@if(isset($health_envs))
						@foreach($health_envs as $health_env)
							<option value="{{ $health_env->id }}">{{ $health_env->name }}</option>
						@endforeach
					@endif
						</optgroup>
					</select>
				</div>
		</div>
