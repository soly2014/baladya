@extends('layouts.baladya')
@section('content')
    <!-- Comments List Panel -->
    <div class="row">

        <div class="col-md-12">

            <div class="panel panel-primary">

                <div class="panel-heading">
                    <div class="panel-title">
                        <h4>
                            مخالفة رقم {{$violation->id}}

                        </h4>
                    </div>
                </div>


                <div class="panel-body">

                    <form role="form" class="form-horizontal form-groups-bordered" action="{{ url('/admin/comment') }}" method="post" enctype="multipart/form-data">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="violation_id" value="{{ $violation->id}}" />
                        <input type="hidden" name="user_id" value="{{ Sentinel::getUser()->id }}" />


                        <div class="form-group">
                            <label for="field-4" class="col-sm-3 control-label">التعليق</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="field-4" name="comment" placeholder="Placeholder" value="{{ old('desc') }}">
                                @if ($errors->has('desc'))
                                    <span class="help-block">
			                            <strong>{{trans('violation.required')}}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">{{trans('violation.uploadImage')}}</label>

                            <div class="col-sm-5">

                                <input name="image" type="file" class="btn btn-default"/>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" class="btn btn-primary"><i class="entypo-login"></i>
                                    اضافة تعليق</button>
                            </div>
                        </div>
                    </form>

                </div>

<hr>
<hr>
                <div class="panel-body no-padding">

                    <!-- List of Comments -->
                    <ul class="comments-list">
                        @foreach($comments as $comment)
                        <!-- Comment Entry -->
                        <li>
                            {{--<div class="comment-checkbox">--}}
                                {{--<div class="checkbox checkbox-replace">--}}
                                    {{--<input type="checkbox">--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            <div class="comment-details">

                                <div class="comment-head">
                                    <a href="#">{{$comment->user->first_name}}</a> ({{$comment->user->roles[0]->name}})
                                </div>

                                <p class="comment-text">
                                    {{$comment->comment}}
                                </p>
                                @if(isset($comment->image) && !empty($comment->image))
                               <a href="{{url($comment->image)}}" target="_blank"><img width="100" height="100" src="{{url($comment->image)}}"></a>
@endif
                                <div class="comment-footer">

                                    <div class="comment-time">
                                        {{$comment->created_at->diffForHumans()}}
                                    </div>

                                    {{--<div class="action-links">--}}

                                        {{--<a href="#" class="approve">--}}
                                            {{--<i class="entypo-check"></i>--}}
                                            {{--Approve--}}
                                        {{--</a>--}}

                                        {{--<a href="#" class="delete">--}}
                                            {{--<i class="entypo-cancel"></i>--}}
                                            {{--Delete--}}
                                        {{--</a>--}}


                                        {{--<a href="javascript:;" onclick="jQuery('#modal-edit-comment').modal('show');" class="edit">--}}
                                            {{--<i class="entypo-pencil"></i>--}}
                                            {{--Edit--}}
                                        {{--</a>--}}

                                    {{--</div>--}}

                                </div>

                            </div>
                        </li>
                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    </div>
    @endsection