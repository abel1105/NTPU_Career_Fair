<?php
    use Jenssegers\Date\Date;
    Date::setLocale('zh_TW');
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <title>{{$fair->name}}就業博覽會 | 國立臺北大學職涯發展中心{{ $fair->year }}</title>
    <link rel="shortcut icon" href="{{asset('assets/img/logo_32x32.png')}}" sizes="32x32" type="image/png">
    <link rel="apple-touch-icon-precomposed" href="{{asset('assets/img/logo_72x72.png')}}" type="image/png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('assets/img/logo_72x72.png')}}" type="image/png">
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="{{asset('assets/img/logo_120x120.png')}}" type="image/png">
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{asset('assets/img/logo_152x152.png')}}" type="image/png">
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Web Fonts -->
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600&subset=cyrillic,latin'>

    <!-- CSS Global Compulsory -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/one.style.css') }}">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/line-icons/line-icons.css') }}">
    <link href="{{ asset('assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/plugins/pace/pace-flash.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/owl-carousel/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/cube-portfolio/cubeportfolio/css/cubeportfolio.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/cube-portfolio/cubeportfolio/custom/custom-cubeportfolio.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/revolution-slider/rs-plugin/css/settings.css') }}" type="text/css" media="screen">
    <!--[if lt IE 9]><link rel="stylesheet" href="{{ asset('assets/plugins/revolution-slider/rs-plugin/css/settings-ie8.css') }}" type="text/css" media="screen"><![endif]-->

    <!-- Style Switcher -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/style-switcher.css') }}">

    <!-- CSS Theme -->
    <link rel="stylesheet" href="{{ asset('assets/css/theme-colors/default.css') }}" id="style_color">
    <link rel="stylesheet" href="{{ asset('assets/css/theme-skins/one.dark.css') }}">

    <!-- CSS Customization -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css?v=1.0') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/calendar.css') }}">

    {{--<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>--}}
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-73110570-1', 'auto');
        ga('send', 'pageview');
        ga('send', 'event', 'Year', '{{ $fair->year }}' , 'Visit' , 1);

    </script>
</head>

<!--
The #page-top ID is part of the scrolling feature.
The data-spy and data-target are part of the built-in Bootstrap scrollspy function.
-->
<body id="body" data-spy="scroll" data-target=".one-page-header" class="demo-lightbox-gallery">
        <!-- Google Tag Manager -->
        <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-PR9XSZ"
                          height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                    '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-PR9XSZ');</script>
        <!-- End Google Tag Manager -->
    <!--=== Header ===-->
    <nav class="one-page-header navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="menu-container page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="navbar-brand" href="#">
                    <img src="{{$fair->logo=='' ? asset('assets/img/logo-01.png') : $fair->logo }}" alt="Logo" style="max-width:150px; max-height: 60px; margin-top: -17px;">
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <div class="menu-container">
                    <ul class="nav navbar-nav">
                        <li class="page-scroll home">
                            <a href="#intro"><i class="fa fa-home"></i> 首頁</a>
                        </li>
                        <li class="page-scroll">
                            <a href="#news"><i class="fa fa-newspaper-o"></i> 最新消息</a>
                        </li>
                        <li class="page-scroll">
                            <a href="#lectures"><i class="fa fa-calendar"></i> 職涯活動</a>
                        </li>
                        <li class="page-scroll">
                            <a href="#job"><i class="fa fa-black-tie"></i> 招募職缺</a>
                        </li>
                        <li class="page-scroll">
                            <a href="#link"><i class="fa fa-link"></i> 相關連結</a>
                        </li>
                        {{--<li class="page-scroll">--}}
                            {{--<a href="#company"><i class="fa fa-building"></i> 合作廠商</a>--}}
                        {{--</li>--}}
                    </ul>
                </div>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <!--=== End Header ===-->

    <!-- Intro Section -->
    <section id="intro" class="intro-section">
        <div class="fullscreenbanner-container">
            <div class="fullscreenbanner">
                <ul>
                    <!-- SLIDE 1 -->
                    <li data-transition="{{ empty($setting->img1_anim) ? 'fade' : $setting->img1_anim }}" data-slotamount="5" data-masterspeed="700" data-title="Slide 1">
                        <!-- MAIN IMAGE -->
                        <img src="{{ empty($setting->img1_input) ? asset('assets/img/img1.JPG') : $setting->img1_input }}" alt="slidebg1" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat">
                    <!-- LAYERS -->
                    <div class="tp-caption rs-caption-1 sft start"
                         data-x="center"
                         data-hoffset="0"
                         data-y="100"
                         data-speed="800"
                         data-start="2000"
                         data-easing="Back.easeInOut"
                         data-endspeed="300" style="font-weight: bold;text-shadow:rgb(204, 204, 204) 2px 2px 3px;">
                        {{ $fair->year }}年度就業博覽會
                    </div>

                    <!-- LAYER -->
                    <div class="tp-caption rs-caption-2 sft"
                         data-x="center"
                         data-hoffset="0"
                         data-y="200"
                         data-speed="1000"
                         data-start="3000"
                         data-easing="Power4.easeOut"
                         data-endspeed="300"
                         data-endeasing="Power1.easeIn"
                         data-captionhidden="off"
                         style="z-index: 6;font-weight:bold;">
                        {!! $setting->slogan or '' !!}
                    </div>

                    <!-- LAYER -->
                    <div class="tp-caption rs-caption-3 sft"
                         data-x="center"
                         data-hoffset="0"
                         data-y="360"
                         data-speed="800"
                         data-start="3500"
                         data-easing="Power4.easeOut"
                         data-endspeed="300"
                         data-endeasing="Power1.easeIn"
                         data-captionhidden="off"
                         style="z-index: 6;">
                        <span class="page-scroll"><a href="#news" class="btn-u btn-brd btn-brd-hover btn-u-light">最新消息</a></span>
                        <span class="page-scroll"><a href="#lectures" class="btn-u btn-brd btn-brd-hover btn-u-light">職涯活動</a></span>
                    </div>
                    </li>

                    {{--<!-- SLIDE 2 -->--}}
                    {{--<li data-transition="{{$setting->img2_anim or 'fade'}}" data-slotamount="5" data-masterspeed="1000" data-title="Slide 2">--}}
                        {{--<!-- MAIN IMAGE -->--}}
                        {{--<img src="{{ $setting->img2_input or asset('assets/img/img2.JPG')}}" alt="slidebg1"  data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat">--}}

                        {{--<!-- LAYERS -->--}}
                        {{--<div class="tp-caption rs-caption-1 sft start"--}}
                             {{--data-x="center"--}}
                             {{--data-hoffset="0"--}}
                             {{--data-y="100"--}}
                             {{--data-speed="800"--}}
                             {{--data-start="1500"--}}
                             {{--data-easing="Back.easeInOut"--}}
                             {{--data-endspeed="300">--}}
                            {{--DEDICATED ADVANCED TEAM--}}
                        {{--</div>--}}

                        {{--<!-- LAYER -->--}}
                        {{--<div class="tp-caption rs-caption-2 sft"--}}
                             {{--data-x="center"--}}
                             {{--data-hoffset="0"--}}
                             {{--data-y="200"--}}
                             {{--data-speed="1000"--}}
                             {{--data-start="2500"--}}
                             {{--data-easing="Power4.easeOut"--}}
                             {{--data-endspeed="300"--}}
                             {{--data-endeasing="Power1.easeIn"--}}
                             {{--data-captionhidden="off"--}}
                             {{--style="z-index: 6">--}}
                            {{--We are creative technology company providing<br>--}}
                            {{--key digital services on web and mobile.--}}
                        {{--</div>--}}

                        {{--<!-- LAYER -->--}}
                        {{--<div class="tp-caption rs-caption-3 sft"--}}
                             {{--data-x="center"--}}
                             {{--data-hoffset="0"--}}
                             {{--data-y="360"--}}
                             {{--data-speed="800"--}}
                             {{--data-start="3500"--}}
                             {{--data-easing="Power4.easeOut"--}}
                             {{--data-endspeed="300"--}}
                             {{--data-endeasing="Power1.easeIn"--}}
                             {{--data-captionhidden="off"--}}
                             {{--style="z-index: 6">--}}
                            {{--<span class="page-scroll"><a href="one_page_dark.html#about" class="btn-u btn-brd btn-brd-hover btn-u-light">Learn More</a></span>--}}
                            {{--<span class="page-scroll"><a href="one_page_dark.html#portfolio" class="btn-u btn-brd btn-brd-hover btn-u-light">Our Work</a></span>--}}
                        {{--</div>--}}
                    {{--</li>--}}

                    {{--<!-- SLIDE 3 -->--}}
                    {{--<li data-transition="{{$setting->img3_anim or 'fade'}}" data-slotamount="5" data-masterspeed="700"  data-title="Slide 3">--}}
                        {{--<!-- MAIN IMAGE -->--}}
                        {{--<img src="{{ $setting->img3_input or asset('assets/img/img3.JPG') }}"  alt="slidebg1"  data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat">--}}

                        {{--<!-- LAYERS -->--}}
                        {{--<div class="tp-caption rs-caption-1 sft start"--}}
                             {{--data-x="center"--}}
                             {{--data-hoffset="0"--}}
                             {{--data-y="110"--}}
                             {{--data-speed="800"--}}
                             {{--data-start="1500"--}}
                             {{--data-easing="Back.easeInOut"--}}
                             {{--data-endspeed="300">--}}
                            {{--WE DO THINGS DIFFERENTLY--}}
                        {{--</div>--}}

                        {{--<!-- LAYER -->--}}
                        {{--<div class="tp-caption rs-caption-2 sfb"--}}
                             {{--data-x="center"--}}
                             {{--data-hoffset="0"--}}
                             {{--data-y="210"--}}
                             {{--data-speed="800"--}}
                             {{--data-start="2500"--}}
                             {{--data-easing="Power4.easeOut"--}}
                             {{--data-endspeed="300"--}}
                             {{--data-endeasing="Power1.easeIn"--}}
                             {{--data-captionhidden="off"--}}
                             {{--style="z-index: 6">--}}
                            {{--Creative freedom matters user experience.<br>--}}
                            {{--We minimize the gap between technology and its audience.--}}
                        {{--</div>--}}

                        {{--<!-- LAYER -->--}}
                        {{--<div class="tp-caption rs-caption-3 sfb"--}}
                             {{--data-x="center"--}}
                             {{--data-hoffset="0"--}}
                             {{--data-y="370"--}}
                             {{--data-speed="800"--}}
                             {{--data-start="3500"--}}
                             {{--data-easing="Power4.easeOut"--}}
                             {{--data-endspeed="300"--}}
                             {{--data-endeasing="Power1.easeIn"--}}
                             {{--data-captionhidden="off"--}}
                             {{--style="z-index: 6">--}}
                            {{--<span class="page-scroll"><a href="one_page_dark.html#about" class="btn-u btn-brd btn-brd-hover btn-u-light">Learn More</a></span>--}}
                            {{--<span class="page-scroll"><a href="one_page_dark.html#portfolio" class="btn-u btn-brd btn-brd-hover btn-u-light">Our Work</a></span>--}}
                        {{--</div>--}}
                    {{--</li>--}}
                    </ul>
                    <div class="tp-bannertimer tp-bottom"></div>
                    <div class="tp-dottedoverlay twoxtwo"></div>
            </div>
        </div>
        </section>
        <!-- End Intro Section -->

        {{--Start 下載field,設成最多三個--}}
        @if(!empty($setting->doc1_url) || !empty($setting->doc2_url) )
            <div class="block-v1  bg-grey">
                <div class="container">
                    <div class="row content-boxes-v3">
                        @if(!empty($setting->doc1_url))
                        <div class="col-sm-6 md-margin-bottom-30" style="text-align: center;">
                            <div class="content-boxes-in-v3">
                                <h2 class="heading-sm"><i class="icon-custom rounded-x icon-bg-dark fa fa-cloud-download"></i>下載《{{ $setting->doc1_name or '校園徵才就業博覽會報名表' }}》</h2>
                                <p></p>
                                <div class="animated fadeInRight">
                                    <a href="{{ $setting->doc1_url or 'http://www.ntpu.edu.tw/files/event/20160112160743.doc' }}" target="_blank" class="btn-u btn-u-lg"><i class="fa fa-cloud-download"></i> 立即下載</a>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(!empty($setting->doc2_url))
                            <div class="col-sm-6 md-margin-bottom-30" style="text-align: center;">
                            <div class="content-boxes-in-v3">
                                <h2 class="heading-sm"><i class="icon-custom rounded-x icon-bg-dark fa fa-cloud-download"></i>下載《{{ $setting->doc2_name or '企業實習暨徵才說明會報名表' }}》</h2>
                                <p></p>
                                <div class="animated fadeInRight">
                                    <a href="{{ $setting->doc2_url or 'http://www.ntpu.edu.tw/files/event/20160104170504.doc' }}" target="_blank" class="btn-u btn-u-lg"><i class="fa fa-cloud-download"></i> 立即下載</a>
                                </div>
                            </div>
                        </div>
                        @endif
                        {{--<div class="col-sm-4 md-margin-bottom-30" style="text-align: center;">--}}
                            {{--<!-- career-1 -->--}}
                            {{--<ins class="adsbygoogle hidden-xs"--}}
                                 {{--style="display:inline-block;width:336px;height:280px"--}}
                                 {{--data-ad-client="ca-pub-5385454271786912"--}}
                                 {{--data-ad-slot="8554997988"></ins>--}}
                            {{--<script>--}}
                                {{--(adsbygoogle = window.adsbygoogle || []).push({});--}}
                            {{--</script>--}}
                            {{--<!-- career-2 -->--}}
                            {{--<ins class="adsbygoogle visible-xs"--}}
                                 {{--style="display:inline-block;width:320px;height:100px"--}}
                                 {{--data-ad-client="ca-pub-5385454271786912"--}}
                                 {{--data-ad-slot="2508464388"></ins>--}}
                            {{--<script>--}}
                                {{--(adsbygoogle = window.adsbygoogle || []).push({});--}}
                            {{--</script>--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>
        @endif
        {{--End 下載field,設成最多三個--}}

        <!--  About Section -->
        <section id="news" class="news-section">
            <div class="container content-lg">
                <div class="title-v1">
                    <h1>最新消息</h1>
                </div>
                <div class="carousel news-v1">
                    <?php $count = 1 ?>
                    @foreach($posts as $value)
                        @if(!empty($value->content))
                            <div class="item">
                                <div class="col-md-12" style="margin-bottom: 15px;">
                                    <div class="news-v1-in">
                                        <?php
                                        $doc=new DOMDocument();
                                        $description_html = mb_convert_encoding($value->content, 'HTML-ENTITIES', "UTF-8");
                                        $doc->loadHTML($description_html);
                                        $xml=simplexml_import_dom($doc);
                                        $images=$xml->xpath('//img');
                                        ?>
                                        <div class="overflow-hidden" style="height: 220px; background-image: url('{{$images[0]['src'] or asset('assets/img/img1.JPG') }}'); background-size: cover;background-position: center center;background-repeat: no-repeat;">
                                            {{--<img class="img-responsive" src="" alt="" style="min-height: 220px;">--}}
                                        </div>
                                        <div class="news-v1-body">
                                        <h3><a href="#" data-toggle="modal" data-target="#modal_post_{{$count}}">{{$value->title}}</a></h3>
                                        <p>{{strip_tags($value->content)}}</p>
                                        </div>
                                        <ul class="list-inline news-v1-info">
                                            <?php $time = \Carbon\Carbon::createFromFormat('Y-m-d H:m:s', $value->updated_at->format('Y-m-d H:m:s')) ?>
                                            <li><i class="fa fa-clock-o"></i> {{ltrim($time->timezone('Asia/Taipei')->subyear('1911')->format('Y年m月d日'),'0')}}</li>
                                            <li class="pull-right">{{Date::make($value->updated_at, 'Asia/Taipei')->diffForHumans()}}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <?php $count++; ?>
                    @endforeach
                </div>
                <?php $count = 1 ?>
                @foreach($posts as $value)
                <div class="modal fade" id="modal_post_{{$count}}" tabindex="-1" role="dialog"  aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="font-size: 30px;">&times;</span><span class="sr-only">Close</span></button>
                                <?php $time = \Carbon\Carbon::createFromFormat('Y-m-d H:m:s', $value->updated_at->format('Y-m-d H:m:s')) ?>
                                <h3>{{$value->title}}</h3><h5><i class="fa fa-clock-o"></i> {{ltrim($time->timezone('Asia/Taipei')->subyear('1911')->format('Y年m月d日'),'0')}}</h5>
                                <hr class="devider devider-dashed" style="margin: 11px 15px;">
                                <div class="postcontent">
                                    {!! $value->content !!}
                                </div>
                                <div class="row">
                                    <button type="button" class="btn btn-u pull-right m-t" data-dismiss="modal">關閉</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $count++; ?>
                @endforeach
            </div>
            <div class="parallax-twitter parallaxBg" style="background: #333 url('{{ empty($setting->img2_input) ? asset('assets/img/img2.JPG') : $setting->img2_input }}') 50% 0 fixed; background-size: cover;">
                <div class="container parallax-twitter-in">
                    <div class="margin-bottom-30">
                        <i class="icon-custom rounded-x fa fa-facebook-square" style="background: #4c69ba; color: #fff; border:none;"></i>
                    </div>

                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <ul class="list-unstyled owl-twitter-v1">
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--  About Section -->

        <!-- Lectures Section -->
        <section id="lectures">
            <div class="container content-lg">
                <div class="title-v1">
                    <h2>職涯活動</h2>
                </div>
                <div class="lecture-btn-container">
                    <button class="btn-u btn-brd btn-brd-hover rounded btn-lecture active" data-title="recent" type="button">近期</button>
                    <button class="btn-u btn-brd btn-brd-hover rounded btn-lecture" data-title="today" type="button">今天</button>
                    <button class="btn-u btn-brd btn-brd-hover rounded btn-lecture" data-title="tomorrow" type="button">明天</button>
                    <button class="btn-u btn-brd btn-brd-hover rounded btn-lecture" data-title="week" type="button">本週</button>
                </div>
                <div class="clearfix"></div>
                <div id="lecture-container">
                @foreach($lectures as $key=>$value)
                    @if($key%3 == 0) <div class="row" style="margin-top: 30px;"> @endif
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="lecture-box service-block-v1 md-margin-bottom-50">
                                <i class="rounded-x fa {{$value->Category->fontawesome}}" style="background: {{$value->Category->color}}"></i>
                                <span class="label rounded label-border" style="font-size:13px;border: 1px solid {{$value->Category->color}}; color: {{$value->Category->color}};">{{$value->Category->title}}</span>
                                <ul class="lecture-info">
                                    <li class="lecture-date">{{str_replace('星期','',Date::parse($value->date)->format('m/d (D)'))}}</li>
                                    <li class="lecture-place">{{$value->place}}</li>
                                    <li class="lecture-time">{{$value->start.'-'.$value->end}}</li>
                                </ul>
                                <h3 class="title-v3-bg text-uppercase">{{$value->title}}</h3>
                                <p></p>
                                <a class="text-uppercase" href="#" data-toggle="modal" data-target="#modal_lecture_{{$value->id}}">Read More</a>
                            </div>
                        </div>
                    @if($key%3 == 2 || $key == count($lectures)) </div> @endif
                        <div class="modal fade" id="modal_lecture_{{$value->id}}" tabindex="-1" role="dialog"  aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="font-size: 30px;">&times;</span><span class="sr-only">Close</span></button>
                                        <h3>{{$value->title}}</h3>
                                        <ul class="lecture-info">
                                            <li class="lecture-date">{{str_replace('星期','',Date::parse($value->date)->format('m/d (D)'))}}</li>
                                            <li class="lecture-place">{{$value->place}}</li>
                                            <li class="lecture-time">{{$value->start.'-'.$value->end}}</li>
                                        </ul>
                                        <hr class="devider devider-dashed" style="margin: 11px 15px;">
                                        <div class="postcontent">
                                            {!! $value->info !!}
                                        </div>
                                        <div class="row">
                                            <button type="button" class="btn btn-u pull-right m-t" data-dismiss="modal">關閉</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endforeach
                </div>
                @if(count($lectures) == 6 || count($lectures) < 6 )
                    <div id="show-more" data-title="recent"
                         style="{{ count($lectures)<6 ? 'background: #333;border:1px solid #333;' : ''}}">
                        {{ count($lectures)<6 ? 'NO MORE DATA' : 'SHOW MORE'}}
                    </div>
                @endif
                {{--<!--Auto Create by Calendar.js-->--}}
                {{--<div class="row ">--}}
                    {{--<div class="col-md-4">--}}
                        {{--<div id="my-calendar"></div>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-8">--}}
                        {{--<div id="calendar_list"></div>--}}
                        {{--<div class="showmorelecture" style="text-align: center;margin-top: 20px;display: none;">--}}
                            {{--<span class="label label-success" style="font-size: 17px;cursor: pointer;">Show More</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<!--Auto Create by Calendar.js-->--}}
            </div>
        </section>
        <!-- End Lectures Section -->
        <section id="job" class="service-block-v4">
            <div class="container content-lg">
                <div class="title-v1">
                    <h2>招募職缺</h2>
                    @if(!$partners->isEmpty())<h5>點擊企業 Logo 即可下載觀看招募資訊檔</h5>@endif
                </div>
                @if($partners->isEmpty())
                    <div class="col-xs-12 text-center">
                        <h5>目前尚無企業職缺資料</h5>
                    </div>
                @else
                @foreach($partners as $item)
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="margin: 5px 0;">
                    <a href="{{$item->link}}" target="_blank">
                        <div class="easy-block-v3 service-or equal-height-column bg-color-dark" style="height: 180px;">
                            <div class="service-bg"></div>
                            <div class="block-info" style="text-align: center;">
                                <div style="width:100%; height:110px;">
                                    <span class="helper"></span>
                                    <img src="{{$item->img}}" style="max-width: 230px; max-height:80px; vertical-align: middle;"/>
                                </div>
                                <h3 style="color: #fff;">{{$item->company}}</h3>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
                @endif
            </div>
        </section>


        <!-- Link Section -->
        <section id="link" class="about-section">
            <div class="clients-section parallaxBg" style="background: #333 url('{{ empty($setting->img3_input) ? asset('assets/img/img5.JPG') : $setting->img3_input }}') center fixed; background-size: cover;">
                <div class="container">
                    <div class="title-v1">
                        <h2>相關連結</h2>
                    </div>
                    <ul class="owl-clients-v2">
                        @foreach($links as $value)
                            <li class="item"><a target="_blank" href="{{$value->link}}"><div><img src="{{ $value->img }}" alt="{{$value->name}}"></div></a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>
        <!-- Link Section -->

        <!-- Contact Section -->
        <section id="footer" class="" style="background: #333;">
            <div class="container content-lg">
                <div class="row">

                    <div class="col-xs-12 col-sm-3 footer-card">
                        <img src="{{asset('assets/img/logo_120x120.png')}}" width="100%" style="max-width: 150px;"/>
                    </div>

                    <div class="col-xs-12 col-sm-3 footer-card">
                        <p class="footer-title">{{$fair->year}} 就業博覽會</p>
                        <ul class="footer-category">
                            <li class="page-scroll">
                                <a class="footer-content" target="_self" href="#news">最新消息</a>
                            </li>
                            <li class="page-scroll">
                                <a class="footer-content" target="_self" href="#lectures">職涯活動</a>
                            </li>
                            <li class="page-scroll">
                                <a class="footer-content" target="_self" href="#job">招募職缺</a>
                            </li>
                            <li class="page-scroll">
                                <a class="footer-content" target="_self" href="#link">相關連結</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-xs-12 col-sm-6 footer-card">
                        <address>
                            <p class="footer-title">國立臺北大學職涯發展中心</p>
                            <p class="footer-content">聯絡信箱：career@mail.ntpu.edu.tw</p>
                            <p class="footer-content">上班時間：週一至週五 06:30-18:30</p>
                            <p class="footer-content">聯絡電話：(02)8674-1111 #66206-66210</p>
                            <p class="footer-content">聯絡地址：23741 新北市三峽區大學路151號行政大樓4F</p>
                        </address>
                    </div>
                </div><!-- end row -->
            </div>

            <div class="copyright-section">
                <p>{{ $fair->year }} &copy; 版權所有 <a target="_blank" href="https://www.facebook.com/chiling.lee.75">Abel</a>｜國立臺北大學學務處職涯發展中心 就業博覽會網站</p>
                <ul class="social-icons">
                    <li><a target="_blank" href="https://www.facebook.com/NTPUCDC/"><i class="fa fa-facebook-official" style="font-size:20px;"></i></a></li>
                </ul>
                <span class="page-scroll"><a href="#news"><i class="fa fa-angle-double-up back-to-top"></i></a></span>
            </div>
        </section>
        <!-- End Contact Section -->

    <!-- JS Global Compulsory -->
    {{--<script type="text/javascript" src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>--}}
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js'></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
{{--    <script type="text/javascript" src="{{ asset('assets/plugins/jquery/jquery-migrate.min.js') }}"></script>--}}
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/1.3.0/jquery-migrate.js'></script>
    {{--<script type="text/javascript" src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>--}}
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js'></script>
    <!-- JS Implementing Plugins -->
    {{--<script type="text/javascript" src="{{ asset('assets/plugins/smoothScroll.js') }}"></script>--}}
    <script src='https://cdnjs.cloudflare.com/ajax/libs/smoothscroll/1.4.1/SmoothScroll.min.js'></script>
    {{--<script type="text/javascript" src="{{ asset('assets/plugins/jquery.easing.min.js') }}"></script>--}}
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
    {{--<script type="text/javascript" src="{{ asset('assets/plugins/pace/pace.min.js') }}"></script>--}}
    <script src='https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js'></script>

    {{--<script type="text/javascript" src="{{ asset('assets/plugins/jquery.parallax.js') }}"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parallax/2.1.3/jquery.parallax.js"></script>
    {{--<script type="text/javascript" src="{{ asset('assets/plugins/counter/waypoints.min.js') }}"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.0/jquery.waypoints.min.js"></script>
    {{--<script type="text/javascript" src="{{ asset('assets/plugins/counter/jquery.counterup.min.js') }}"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js"></script>
    {{--<script type="text/javascript" src="{{ asset('assets/plugins/owl-carousel/owl.carousel.js') }}"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
    {{--<script type="text/javascript" src="{{ asset('assets/plugins/sky-forms-pro/skyforms/js/jquery.form.min.js') }}"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js"></script>
    {{--<script type="text/javascript" src="{{ asset('assets/plugins/sky-forms-pro/skyforms/js/jquery.validate.min.js') }}"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.14.0/jquery.validate.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/revolution-slider/rs-plugin/js/jquery.themepunch.tools.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/revolution-slider/rs-plugin/js/jquery.themepunch.revolution.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/cube-portfolio/cubeportfolio/js/jquery.cubeportfolio.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/moment/moment.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.1/moment.min.js"></script>

    <!-- JS Page Level-->
    <script type="text/javascript" src="{{ asset('assets/js/one.app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/forms/login.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/forms/contact.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/pace-loader.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/owl-carousel.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/style-switcher.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/revolution-slider.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/cube-portfolio/cube-portfolio-lightbox.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/calendar.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/masonry/4.0.0/masonry.pkgd.min.js"></script>
    <script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '1493639750941370',
            xfbml      : true,
            version    : 'v2.5'
        });
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    </script>
    <script type="text/javascript">
    jQuery(document).ready(function() {
        App.init();
        App.initCounter();
        App.initParallaxBg();
        LoginForm.initLoginForm();
        ContactForm.initContactForm();
        OwlCarousel.initOwlCarousel();
        StyleSwitcher.initStyleSwitcher();
        RevolutionSlider.initRSfullScreen();
        $.ajax({
            url: 'https://graph.facebook.com/v2.5/NTPUCDC/feed?access_token=1493639750941370|ehjJ0Jw7gCKLoWCiKoMVm47bDic',
            success: function(data){
                for(var i=0; i< 10; i++){
                    if(typeof(data.data[i].message) !== 'undefined') {
                        var time = moment(data.data[i].created_time).locale('zh-tw').fromNow();
                        var id = data.data[i].id.split('_')[1];
                        data.data[i].message.length > 150 ? more='...': more = '' ;
                        content = '<li class="item"><p>' + data.data[i].message.substring(0, 150)+ more + '</p><span>' + time + '從 <a class="fb-link" target="_blank" href="https://www.facebook.com/NTPUCDC/posts/' + id + '">臺北大學職涯發展中心粉絲專頁</a></span></li>';
                        $('.owl-twitter-v1').data('owlCarousel').addItem(content);
                    }
                }
            }
        });
        $.ajax({
            url: 'https://graph.facebook.com/v2.3/NTPUCDC/feed?fields=full_picture&access_token=1493639750941370|ehjJ0Jw7gCKLoWCiKoMVm47bDic',
            success: function(data){
                for(var i=0; i< 10; i++){
                    if(typeof(data.data[i].full_picture) !== 'undefined') {
                        content = '<img src="' + data.data[i].full_picture + '" style="float: left;max-width: 120px;max-height: 120px;margin-right: 20px;"/>';
                        $('.owl-twitter-v1 .item:eq('+i+')').prepend(content);
                    }
                }
            }
        });
        {{--$("#my-calendar").abel_calendar({--}}
            {{--language: "zh-tw",--}}
            {{--ajax: { url: "{{route('lecture-ajax', ['year' => $fair->year])}}" }--}}
        {{--});--}}
        $('.lecture-btn-container button').bind('click', function(){
            if($(this).hasClass('active')){
                return false;
            }
            $('.lecture-btn-container button').removeClass('active');
            $(this).addClass('active');
            kind = $(this).data('title');
            $('#show-more').attr('style', '').hide().text('SHOW MORE').attr('data-title', kind);
            $('#lecture-container').empty();
            $('#show-more').bind('click');
            $.ajax({
                url: '/career/{{$fair->year}}/lecture/'+kind,
                success: function(data){
                    addData(data);
                }
            })
        });
        $('#show-more').bind('click', function(){
            if($(this).data('title') == 'no'){
                return false;
            }
            kind = $(this).data('title');
            page = Math.ceil($('.lecture-box').size()/6+1);
            if(page > 1){
                $.ajax({
                    url: '/career/{{$fair->year}}/lecture/'+kind+'?page='+page,
                    success: function(data){
                        $('#show-more').hide();
                        addData(data);
                    }
                })
            }
        });
        function addData(data){
            if(data.length != 0) {
                var html = "";
                for (var i = 0; i < data.length; i++) {
                    if (i % 3 == 0) {
                        html += '<div class="row" style="margin-top: 30px;">';
                    }
                    html += '<div class="col-md-4 col-sm-4 col-xs-12">';
                    html += '<div class="lecture-box service-block-v1 md-margin-bottom-50">';
                    html += '<i class="rounded-x fa ' + data[i].fontawesome + '" style="background:' + data[i].color + '"></i>';
                    html += '<span class="label rounded label-border" style="font-size:13px; border: 1px solid ' + data[i].color + '; color: ' + data[i].color + ';">' + data[i].category + '</span>';
                    html += '<ul class="lecture-info">';
                    html += '<li class="lecture-date">' + data[i].showdate + '</li>';
                    html += '<li class="lecture-place">' + data[i].place + '</li>';
                    html += '<li class="lecture-time">' + data[i].start + '-' + data[i].end + '</li>';
                    html += '</ul>';
                    html += '<h3 class="title-v3-bg text-uppercase">' + data[i].title + '</h3>';
                    html += '<p></p>';
                    html += '<a class="text-uppercase" href="#" data-toggle="modal" data-target="#modal_lecture_'+data[i].id+'">Read More</a>';
                    html += '</div>';
                    html += '</div>';
                    if (i % 3 == 2 || i + 1 == data.length) {
                        html += '</div>';
                    }
                }
                for(var i = 0; i < data.length; i++){
                    html += '<div class="modal fade" id="modal_lecture_'+ data[i].id +'" tabindex="-1" role="dialog"  aria-hidden="true">';
                    html += '<div class="modal-dialog modal-lg" role="document">';
                    html += '<div class="modal-content">';
                    html += '<div class="modal-body">';
                    html += '<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="font-size: 30px;">&times;</span><span class="sr-only">Close</span></button>';
                    html += '<h3>' + data[i].title + '</h3>';
                    html += '<ul class="lecture-info">';
                    html += '<li class="lecture-date">'+ data[i].showdate +'</li>';
                    html += '<li class="lecture-place">' + data[i].place + '</li>';
                    html += '<li class="lecture-time">' + data[i].start + '-' + data[i].end + '</li>';
                    html += '</ul>';
                    html += '<hr class="devider devider-dashed" style="margin: 11px 15px;">';
                    html += '<div class="postcontent">';
                    html += data[i].info;
                    html += '</div>';
                    html += '<div class="row">';
                    html += '<button type="button" class="btn btn-u pull-right m-t" data-dismiss="modal">關閉</button>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                }
                $('#lecture-container').append(html);
                $('#show-more').show();
            }else{
                $('#show-more').attr('data-title', 'no').text('NO MORE DATA').css('background', '#333').css('border', '1px solid #333').show();
            }
        }

    });
    </script>
    <!--[if lt IE 9]>
    <script src="assets/plugins/respond.js"></script>
    <script src="assets/plugins/html5shiv.js"></script>
    <script src="assets/js/plugins/placeholder-IE-fixes.js"></script>
    <script src="assets/plugins/sky-forms-pro/skyforms/js/sky-forms-ie8.js"></script>
    <![endif]-->

    <!--[if lt IE 10]>
    <script src="assets/plugins/sky-forms-pro/skyforms/js/jquery.placeholder.min.js"></script>
    <![endif]-->
</body>
</html>