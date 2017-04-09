@extends('layouts.baladya')
@section('content')

@include('partials.entete', [
'title' => trans('dashboard.dashboard'),
'icon' => 'dashboard',
'fil' =>  link_to('admin/solution', trans('solution.solution')) .'  /  '.  trans('solution.create_solution')
])

	<div class="row">
		<div class="col-sm-3 col-xs-6">

			<div class="tile-stats tile-red">
				<div class="icon"><i class="entypo-users"></i></div>
				<div class="num" data-start="0" data-end="{{$users}}" data-postfix="" data-duration="1500" data-delay="0">0</div>

				<h3>{{trans('generalReport.usersCount')}}</h3>
				{{--<p>so far in our blog, and our website.</p>--}}
			</div>

		</div>

		<div class="col-sm-3 col-xs-6">

			<div class="tile-stats tile-green">
				<div class="icon"><i class="entypo-eye"></i></div>
				<div class="num" data-start="0" data-end="{{$violations}}" data-postfix="" data-duration="1500" data-delay="600">0</div>

				<h3>{{trans('generalReport.violationsCount')}}</h3>
				{{--<p>this is the average value.</p>--}}
			</div>

		</div>

		<div class="clear visible-xs"></div>

		<div class="col-sm-3 col-xs-6">

			<div class="tile-stats tile-aqua">
				<div class="icon"><i class="entypo-compass"></i></div>
				<div class="num" data-start="0" data-end="{{$companies}}" data-postfix="" data-duration="1500" data-delay="1200">0</div>

				<h3>{{trans('generalReport.companiesCount')}}</h3>
				{{--<p>messages per day.</p>--}}
			</div>

		</div>

		<div class="col-sm-3 col-xs-6">

			<div class="tile-stats tile-blue">
				<div class="icon"><i class="entypo-layout"></i></div>
				<div class="num" data-start="0" data-end="{{$resQuars}}" data-postfix="" data-duration="1500" data-delay="1800">0</div>

				<h3>{{trans('generalReport.resQuarsCount')}}</h3>
				{{--<p>on our site right now.</p>--}}
			</div>

		</div>
	</div>

	<br />
<hr/>

        {{--<div class="main-content">--}}

            <div class="row">
                <div class="col-md-12">

                    <div class="panel panel-primary">

                        <div class="panel-heading">
                            <div class="panel-title">{{trans('dashboard.dashboard')}}</div>

                            <div class="panel-options">
                                <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
                                <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                                <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                                <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                            </div>
                        </div>

                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <td width="50%">
                                    <strong>{{trans('generalReport.violVsDays')}}</strong>
                                    <br />
                                    <div id="chart10" style="height: 300px"></div>
                                </td>
                                <td>
                                    <strong>{{trans('generalReport.violVsResQuars')}}</strong>
                                    <br />
                                    <div id="chart8" style="height: 300px"></div>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <td width="50%">
                                    <strong>{{trans('generalReport.violVsResQuars')}}</strong>
                                    <br />

                                    <div id="chart3" style="height: 250px"></div>
                                </td>
                                <td>
                                    <strong>{{trans('generalReport.violVsServices')}}</strong>
                                    <br />
                                    <div id="chart4" style="height: 250px"></div>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <td width="50%">
                                    <strong>{{trans('generalReport.visitVsResQuar')}}</strong>
                                    <br />
                                    <div id="chart5" style="height: 250px"></div>
                                </td>
                                <td width="50%">
                                    <strong>{{trans('generalReport.visitlVsDays')}}</strong>
                                    <br />
                                    <div id="chart6" style="height: 250px"></div>
                                </td>
                                {{--<td width="33%">--}}
                                    {{--<strong>Formatted</strong>--}}
                                    {{--<br />--}}
                                    {{--<div id="chart7" style="height: 250px"></div>--}}
                                {{--</td>--}}
                            </tr>
                            </tbody>
                        </table>

                        {{--<table class="table table-bordered">--}}
                            {{--<tbody>--}}
                            {{--<tr>--}}
                                {{--<td>--}}
                                    {{--<strong>Line Chart</strong>--}}
                                    {{--<br />--}}
                                    {{--<div id="chart9" style="height: 300px"></div>--}}
                                {{--</td>--}}
                            {{--</tr>--}}
                            {{--</tbody>--}}
                        {{--</table>--}}

                    </div>

                </div>
            </div>


        {{--</div>--}}

    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d927764.3178256714!2d47.38165106209185!3d24.724155383801993!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e2f03890d489399%3A0xba974d1c98e79fd5!2z2KfZhNix2YrYp9i2INin2YTYs9i52YjYr9mK2Kk!5e0!3m2!1sar!2s!4v1485460037931" width="950" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>


	<!-- Footer -->


@stop