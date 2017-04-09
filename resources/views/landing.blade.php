@extends('layouts.land')

@section('content')
<!-- HOME SECTION -->
<div class="section home active parallax-background image-1" id="section0">
    <div id="large-header" class="large-header">
        <canvas id="demo-canvas1"></canvas>
    </div>
    <!-- START CONTAINER -->
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="top-intro">
                    <h1>
                        <span class="title-intro">البلدية</span>
                    </h1>
                </div>
                <div class="description-intro">
                    <h2>
                        مشروع بلدية محافظة الخرج
                    </h2>
                </div>
                <div class="bottom-intro">
                    <h1>
                        <span class="title-intro">البلدية</span>
                    </h1>
                </div>


                <div class="line-separate line-white line-center" data-animation-delay="200"><span></span></div>

                <p>
                    الأداة الأفضل للبلدية للتحكم بمواردها وادارتها بسهولة وامان من أي مكان مع نظام سلس يسمح لكافة العاملين باستخدام التطبيق للقيام بالمهام الخاصة به.
                </p>
            </div>

        </div><!-- END ROW -->
    </div><!-- END CONTAINER -->
    <!-- OVERLAY -->
    <div class="overlay">
        <div class="gradient-overlay background-blue-dark opacity-40"></div>
    </div>
</div>

<!-- second SECTION -->
<div class="section parallax-background image-2" id="section1">
    <div id="large-header" class="large-header1">
        <canvas id="demo-canvas"></canvas>
    </div>
    <!-- START CONTAINER -->
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <!-- START SECTION HEADER -->
                <div class="section-header color-white">
                    <!-- START TITLE -->
                    <h2 class="section-title animated" data-animation="fadeInUp">برنامج مراقبة الخدمات</h2><!-- END TITLE -->
                    <div class="line-separate line-white line-center animated" data-animation="fadeInUp" data-animation-delay="200"><span></span></div>
                </div><!-- END SECTION HEADER -->
                <div class="slide-content">
                    <p class="animated" data-animation="fadeInUp" data-animation-delay="200"> </p>

                    <div class="col-md-3 col-sm-6 animated" data-animation="fadeInUp" data-animation-delay="200">
                        <figure>
                            <img src="{{url('landing/images/gardens.png')}}" />
                            <figcaption>
                                <h4>الحدائق</h4>
                                <p>
                                    من أجل حياة نظيفة و مريحة يجب دائما أن نراقب عملية جمع النفايات بشكل...
                                </p>
                                <a href="{{url('user/login')}}/0" class="border-sm-button">اقرأ المزيد</a>
                            </figcaption>
                        </figure>
                    </div>


                    <div class="col-md-3 col-sm-6 animated" data-animation="fadeInUp" data-animation-delay="400">
                        <figure>
                            <img src="{{url('landing/images/cleanless.png')}}" />
                            <figcaption>
                                <h4>النظافة</h4>
                                <p>
                                    من أجل حياة نظيفة و مريحة يجب دائما أن نراقب عملية جمع النفايات بشكل...
                                </p>
                                <a href="{{url('user/login')}}/0" class="border-sm-button">اقرأ المزيد</a>
                            </figcaption>
                        </figure>
                    </div>


                    <div class="col-md-3 col-sm-6 animated" data-animation="fadeInUp" data-animation-delay="600">
                        <figure>
                            <img src="{{url('landing/images/maintenance.png')}}" />
                            <figcaption>
                                <h4>الصيانة</h4>
                                <p>
                                    من أجل حياة نظيفة و مريحة يجب دائما أن نراقب عملية جمع النفايات بشكل...
                                </p>
                                <a href="{{url('user/login')}}/0" class="border-sm-button">اقرأ المزيد</a>
                            </figcaption>
                        </figure>
                    </div>

                    <div class="col-md-3 col-sm-6 animated" data-animation="fadeInUp" data-animation-delay="800">
                        <figure>
                            <img src="{{url('landing/images/enviroment.png')}}" />
                            <figcaption>
                                <h4>نظافة البيئة</h4>
                                <p>
                                    من أجل حياة نظيفة و مريحة يجب دائما أن نراقب عملية جمع النفايات بشكل...
                                </p>
                                <a href="{{url('user/login')}}/1" class="border-sm-button">اقرأ المزيد</a>
                            </figcaption>
                        </figure>
                    </div>
                </div>
            </div>
        </div><!-- END ROW -->
    </div><!-- END CONTAINER -->
    <!-- OVERLAY -->
    <div class="overlay">
        <div class="gradient-overlay background-blue-dark opacity-20"></div>
    </div>
</div>


<!-- third SECTION -->
<div class="section parallax-background image-3" id="section2">
    <div id="large-header" class="large-header1">
        <canvas id="demo-canvas"></canvas>
    </div>
    <!-- START CONTAINER -->
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <!-- START SECTION HEADER -->
                <div class="section-header color-white">
                    <!-- START TITLE -->
                    <h2 class="section-title animated" data-animation="fadeInUp">تتبع السيارات</h2><!-- END TITLE -->
                    <div class="line-separate line-white line-center animated" data-animation="fadeInUp" data-animation-delay="200"><span></span></div>
                </div><!-- END SECTION HEADER -->
                <div class="slide-content">
                    <p class="animated" data-animation="fadeInUp" data-animation-delay="200">
                    يعمل بسهوله وآمان، حيث يمكن العميل من تتبع موقع المركبة وتحديد مناطق آمنة والحصول على تنبية عند تجاوز المركبة السرعة المحددة لها وكذلك الكثير من المزايا الرائعة
                     </p>

                    <a href="#" class="border-sm-button">اقرأ المزيد</a>

                </div>
            </div>
        </div><!-- END ROW -->
    </div><!-- END CONTAINER -->
    <!-- OVERLAY -->
    <div class="overlay">
        <div class="gradient-overlay background-blue-dark opacity-20"></div>
    </div>
</div>
@endsection
