<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @yield('header')

    <!-- Mainly css -->
    <link href="{{ asset('assets/auth/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <!-- Toastr style -->
    <link href="{{ asset('assets/auth/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
    <!-- Gritter -->
    <link href="{{ asset('assets/auth/js/plugins/gritter/jquery.gritter.css') }}" rel="stylesheet">
    <!-- DropZone -->
    <link href="{{ asset('assets/auth/css/plugins/dropzone/dropzone.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/auth/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/auth/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/auth/css/plugins/chosen/chosen.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/auth/css/plugins/fullcalendar/fullcalendar.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/auth/css/plugins/fullcalendar/fullcalendar.print.css') }}" rel='stylesheet' media='print'>

    <link href="{{ asset('assets/auth/css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/auth/css/plugins/clockpicker/clockpicker.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/auth/ckeditor/toolbarconfigurator/lib/codemirror/neo.css') }}">


    <!-- Mainly css -->
    <!-- Mainly scripts -->
    <script src="{{ asset('assets/auth/js/jquery-2.1.1.js') }}"></script>
    <!-- jQuery UI -->
    <script src="{{ asset('assets/auth/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/auth/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/auth/js/jquery.pjax.js') }}"></script>

    <script src="{{ asset('assets/auth/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('assets/auth/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <!-- Custom and plugin javascript -->
    <script src="{{ asset('assets/auth/js/plugins/pace/pace.min.js') }}"></script>
    <script src="{{ asset('assets/auth/js/inspinia.js') }}"></script>

    <!-- Mainly scripts -->
    <!-- Chosen -->
    <script src="{{ asset('assets/auth/js/plugins/chosen/chosen.jquery.js') }}"></script>
    <!-- Flot -->
    <script src="{{ asset('assets/auth/js/plugins/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('assets/auth/js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
    <script src="{{ asset('assets/auth/js/plugins/flot/jquery.flot.spline.js') }}"></script>
    <script src="{{ asset('assets/auth/js/plugins/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('assets/auth/js/plugins/flot/jquery.flot.pie.js') }}"></script>

    <!-- Peity -->
    <script src="{{ asset('assets/auth/js/plugins/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('assets/auth/js/demo/peity-demo.js') }}"></script>

    <!-- Sweet Alert -->
    <link href="{{ asset('assets/auth/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">


    <!-- GRITTER -->
    <script src="{{ asset('assets/auth/js/plugins/gritter/jquery.gritter.min.js') }}"></script>

    <!-- Sparkline -->
    <script src="{{ asset('assets/auth/js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Sparkline demo data  -->
    <script src="{{ asset('assets/auth/js/demo/sparkline-demo.js') }}"></script>

    <!-- ChartJS-->
    <script src="{{ asset('assets/auth/js/plugins/chartJs/Chart.min.js') }}"></script>

    <!-- Toastr -->
    <script src="{{ asset('assets/auth/js/plugins/toastr/toastr.min.js') }}"></script>


    <!-- iCheck -->
    <script src="{{ asset('assets/auth/js/plugins/iCheck/icheck.min.js') }}"></script>
    <!-- Data picker -->
    <script src="{{ asset('assets/auth/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
    <!-- Color picker -->
    <script src="{{ asset('assets/auth/js/plugins/colorpicker/bootstrap-colorpicker.min.js') }}"></script>

    <!-- Clock picker -->
    <script src="{{ asset('assets/auth/js/plugins/clockpicker/clockpicker.js') }}"></script>

    <script src="{{ asset('assets/auth/js/plugins/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('assets/auth/js/plugins/sweetalert/sweetalert.min.js') }}"></script>

    {{--ckeditor--}}
    <script src="{{ asset('assets/auth/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/auth/ckeditor/plugins/image/dialogs/image.js') }}"></script>
    <script src="{{ asset('assets/auth/ckeditor/plugins/table/dialogs/table.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flot.tooltip/0.8.5/jquery.flot.tooltip.min.js"></script>



<?php  use App\Fair;
    if (session('year') == null){
        $fair = Fair::orderBy('year', 'desc')->first();
        Session::put('year', $fair->year);
    }?>
</head>
<body>
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <span>
                            <img alt="image" width="45" class="img-circle" src="{{ asset('assets/img/logo.png') }}" />
                        </span>
                        <span class="clear">
                            <span class="block m-t-xs">
                                <strong class="font-bold" style="color: #fff;">{{ Auth::user()->name }}</strong>
                            </span>
                            <span class="text-muted text-xs block">職涯發展中心</span>
                        </span>
                    </div>
                    <div class="logo-element">
                        CF
                    </div>
                </li>
                <li>
                    <a href="/career/auth/{{ session('year')}}/dashboard" data-pjax><i class="fa fa-th-large"></i> <span class="nav-label">控制台</span></a>
                </li>
                <li>
                    <a href="/career/auth/{{ session('year')}}/fair/create" data-pjax><i class="fa fa-pencil"></i> <span class="nav-label">新增／編輯活動</span></a>
                </li>
                <li>
                    <a href="/career/auth/{{ session('year')}}/post" data-pjax><i class="fa fa-newspaper-o"></i> <span class="nav-label">公告</span></a>
                </li>
                <li>
                    <a href="/career/auth/{{session('year')}}/lecture" data-pjax><i class="fa fa-calendar"></i> <span class="nav-label">職涯活動</span><span class="label label-primary pull-right">NEW</span></a>
                </li>
                <li>
                    <a href="/career/auth/link" data-pjax><i class="fa fa-thumbs-o-up"></i> <span class="nav-label">相關連結</span></a>
                </li>
                <li>
                    <a href="/career/auth/{{session('year')}}/partner" data-pjax><i class="fa fa-black-tie"></i> <span class="nav-label">招募職缺</span><span class="label label-primary pull-right">NEW</span></a>
                </li>
                <li>
                    <a href="/career/auth/file"><i class="fa fa-archive"></i> <span class="nav-label">檔案管理員</span><span class="label label-primary pull-right">NEW</span></a>
                </li>
            </ul>

        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>

                    <span class="m-md pull-left">目前所在年度：<b>{{ session('year')}}</b></span>

                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <span class="m-r-sm text-muted welcome-message">歡迎來到就業博覽會管理系統</span>
                    </li>
                    <li>
                        <a href="/career/auth/logout">
                            <i class="fa fa-sign-out"></i> 登出
                        </a>
                    </li>
                </ul>

            </nav>
        </div>
        <div class="pjax-container">
            @yield('content')
        </div>
        <div class="footer">
            <div class="pull-right">
                <?php
                if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                    $freebytes = disk_free_space("C:");
                    $totalbytes = disk_total_space("C:");
                    $usedbytes = $totalbytes - $freebytes;
                }else{
                    $freebytes = disk_free_space(".");
                    $totalbytes = disk_total_space(".");
                    $usedbytes = $totalbytes - $freebytes;
                }
                $prefix = array( 'B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB' );
                $base = 1024;
                $usedclass = min((int)log($usedbytes , $base) , count($prefix) - 1);
                $totalclass = min((int)log($totalbytes , $base) , count($prefix) - 1);
                $used = sprintf('%1.2f' , $usedbytes / pow($base,$usedclass)) . ' ' . $prefix[$usedclass];
                $total = sprintf('%1.2f' , $totalbytes / pow($base,$totalclass)) . ' ' . $prefix[$totalclass];
                $percent = round(sprintf('%1.2f' , $usedbytes / pow($base,$usedclass))/sprintf('%1.2f' , $totalbytes / pow($base,$totalclass))*100);
                ?>
                使用了 {{ $used }} {!! $percent > 80 ? '<font color="red">('.$percent.'%)</font>': ($percent > 50 ? '<font color="#f8ac59">('.$percent.'%)</font>': "(".$percent."%)")!!} of <strong>{{$total}}</strong> 空間.
            </div>
            <div>
                <strong>版權所有</strong> 國立臺北大學 職涯發展中心 &copy; 2015 ｜ Abel
            </div>
        </div>
    </div>

</div>
<div class="theme-config">
    <div class="theme-config-box">
        <div class="spin-icon">
            <i class="fa fa-cogs fa-spin"></i>
            <iframe id="tmp_downloadhelper_iframe" style="display: none;"></iframe></div>
        <div class="skin-setttings">
            <div class="title">設定</div>
            <div class="setings-item">
                        <span>
                            折疊選單
                        </span>

                <div class="switch">
                    <div class="onoffswitch">
                        <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="collapsemenu">
                        <label class="onoffswitch-label" for="collapsemenu">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="setings-item">
                        <span>
                            固定選單
                        </span>

                <div class="switch">
                    <div class="onoffswitch">
                        <input type="checkbox" name="fixedsidebar" class="onoffswitch-checkbox" id="fixedsidebar">
                        <label class="onoffswitch-label" for="fixedsidebar">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="setings-item">
                        <span>
                            置頂導航欄
                        </span>

                <div class="switch">
                    <div class="onoffswitch">
                        <input type="checkbox" name="fixednavbar" class="onoffswitch-checkbox" id="fixednavbar">
                        <label class="onoffswitch-label" for="fixednavbar">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="setings-item">
                        <span>
                            窄型排版
                        </span>

                <div class="switch">
                    <div class="onoffswitch">
                        <input type="checkbox" name="boxedlayout" class="onoffswitch-checkbox" id="boxedlayout">
                        <label class="onoffswitch-label" for="boxedlayout">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="setings-item">
                        <span>
                            固定頁尾
                        </span>

                <div class="switch">
                    <div class="onoffswitch">
                        <input type="checkbox" name="fixedfooter" class="onoffswitch-checkbox" id="fixedfooter">
                        <label class="onoffswitch-label" for="fixedfooter">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="title">樣式</div>
            <div class="setings-item default-skin">
                        <span class="skin-name ">
                             <a href="#" class="s-skin-0">
                                 預設
                             </a>
                        </span>
            </div>
            <div class="setings-item blue-skin">
                        <span class="skin-name ">
                            <a href="#" class="s-skin-1">
                                天空藍
                            </a>
                        </span>
            </div>
            <div class="setings-item yellow-skin">
                        <span class="skin-name ">
                            <a href="#" class="s-skin-3">
                                橘黃色
                            </a>
                        </span>
            </div>
        </div>
    </div>
</div>

</body>
@yield('footer')
    {{--<script src="{{ asset('assets/auth/js/pjax_custom.js') }}"></script>--}}
    <script>
        $(function(){
            $('[data-toggle="tooltip"]').tooltip();
        })
    </script>
    <script>
        // output error or success
        $(function(){
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "progressBar": true,
                "preventDuplicates": false,
                "positionClass": "toast-top-right",
                "onclick": null,
                "showDuration": "400",
                "hideDuration": "1000",
                "timeOut": "7000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            @if (isset($error))
            toastr.error('{{ $error }}');
            @endif
            @if (session('success') != null)
            toastr.success('{{ session('success') }}');
            @endif
            @if (isset($success))
            toastr.success('{{ $success }}');
            @endif
        })
        // chosen
        var config = {
            '.chosen-select'           : {},
            '.chosen-select-deselect'  : {allow_single_deselect:true},
            '.chosen-select-no-single' : {disable_search_threshold:10},
            '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
            '.chosen-select-width'     : {width:"95%"}
        }
        for (var selector in config) {
            $(selector).chosen(config[selector]);
        }
    </script>
    <script>
    // Config box

    // Enable/disable fixed top navbar
    $('#fixednavbar').click(function () {
        if ($('#fixednavbar').is(':checked')) {
            $(".navbar-static-top").removeClass('navbar-static-top').addClass('navbar-fixed-top');
            $("body").removeClass('boxed-layout');
            $("body").addClass('fixed-nav');
            $('#boxedlayout').prop('checked', false);

            if (localStorageSupport) {
                localStorage.setItem("boxedlayout",'off');
            }

            if (localStorageSupport) {
                localStorage.setItem("fixednavbar",'on');
            }
        } else {
            $(".navbar-fixed-top").removeClass('navbar-fixed-top').addClass('navbar-static-top');
            $("body").removeClass('fixed-nav');

            if (localStorageSupport) {
                localStorage.setItem("fixednavbar",'off');
            }
        }
    });

    // Enable/disable fixed sidebar
    $('#fixedsidebar').click(function () {
        if ($('#fixedsidebar').is(':checked')) {
            $("body").addClass('fixed-sidebar');
            $('.sidebar-collapse').slimScroll({
                height: '100%',
                railOpacity: 0.9
            });

            if (localStorageSupport) {
                localStorage.setItem("fixedsidebar",'on');
            }
        } else {
            $('.sidebar-collapse').slimscroll({destroy: true});
            $('.sidebar-collapse').attr('style', '');
            $("body").removeClass('fixed-sidebar');

            if (localStorageSupport) {
                localStorage.setItem("fixedsidebar",'off');
            }
        }
    });

    // Enable/disable collapse menu
    $('#collapsemenu').click(function () {
        if ($('#collapsemenu').is(':checked')) {
            $("body").addClass('mini-navbar');
            SmoothlyMenu();

            if (localStorageSupport) {
                localStorage.setItem("collapse_menu",'on');
            }

        } else {
            $("body").removeClass('mini-navbar');
            SmoothlyMenu();

            if (localStorageSupport) {
                localStorage.setItem("collapse_menu",'off');
            }
        }
    });

    // Enable/disable boxed layout
    $('#boxedlayout').click(function () {
        if ($('#boxedlayout').is(':checked')) {
            $("body").addClass('boxed-layout');
            $('#fixednavbar').prop('checked', false);
            $(".navbar-fixed-top").removeClass('navbar-fixed-top').addClass('navbar-static-top');
            $("body").removeClass('fixed-nav');
            $(".footer").removeClass('fixed');
            $('#fixedfooter').prop('checked', false);

            if (localStorageSupport) {
                localStorage.setItem("fixednavbar",'off');
            }

            if (localStorageSupport) {
                localStorage.setItem("fixedfooter",'off');
            }


            if (localStorageSupport) {
                localStorage.setItem("boxedlayout",'on');
            }
        } else {
            $("body").removeClass('boxed-layout');

            if (localStorageSupport) {
                localStorage.setItem("boxedlayout",'off');
            }
        }
    });

    // Enable/disable fixed footer
    $('#fixedfooter').click(function () {
        if ($('#fixedfooter').is(':checked')) {
            $('#boxedlayout').prop('checked', false);
            $("body").removeClass('boxed-layout');
            $(".footer").addClass('fixed');

            if (localStorageSupport) {
                localStorage.setItem("boxedlayout",'off');
            }

            if (localStorageSupport) {
                localStorage.setItem("fixedfooter",'on');
            }
        } else {
            $(".footer").removeClass('fixed');

            if (localStorageSupport) {
                localStorage.setItem("fixedfooter",'off');
            }
        }
    });

    // SKIN Select
    $('.spin-icon').click(function () {
        $(".theme-config-box").toggleClass("show");
    });

    // Default skin
    $('.s-skin-0').click(function () {
        $("body").removeClass("skin-1");
        $("body").removeClass("skin-2");
        $("body").removeClass("skin-3");

        if (localStorageSupport) {
            localStorage.setItem("skin",'default');
        }
    });

    // Blue skin
    $('.s-skin-1').click(function () {
        $("body").removeClass("skin-2");
        $("body").removeClass("skin-3");
        $("body").addClass("skin-1");
        if (localStorageSupport) {
            localStorage.setItem("skin",'skin-1');
        }
    });

    // Yellow skin
    $('.s-skin-3').click(function () {
        $("body").removeClass("skin-1");
        $("body").removeClass("skin-2");
        $("body").addClass("skin-3");
        if (localStorageSupport) {
            localStorage.setItem("skin",'skin-3');
        }
    });

    if (localStorageSupport) {
        var collapse = localStorage.getItem("collapse_menu");
        var fixedsidebar = localStorage.getItem("fixedsidebar");
        var fixednavbar = localStorage.getItem("fixednavbar");
        var boxedlayout = localStorage.getItem("boxedlayout");
        var fixedfooter = localStorage.getItem("fixedfooter");
        var skin = localStorage.getItem("skin");

        if (collapse == 'on') {
            $('#collapsemenu').prop('checked','checked')
        }
        if (fixedsidebar == 'on') {
            $('#fixedsidebar').prop('checked','checked')
        }
        if (fixednavbar == 'on') {
            $('#fixednavbar').prop('checked','checked')
        }
        if (boxedlayout == 'on') {
            $('#boxedlayout').prop('checked','checked')
        }
        if (fixedfooter == 'on') {
            $('#fixedfooter').prop('checked','checked')
        }
        if (skin != null && skin != 'default'){
            $("body").addClass(skin);
        }
    }
</script>
</html>