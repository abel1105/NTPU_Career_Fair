@extends('auth.auth')

@section('header')

    <title>就業博覽會 | 控制台</title>

@endsection

@section('content')
    <div class="row  border-bottom white-bg dashboard-header">
        <div class="col-sm-3">
            <h2>歡迎 {{ $user->name or '' }}</h2>
            @if(isset($fair))
                <small>目前所在就業博覽會年次</small>
            @else
                <small>新增就業博覽會年度</small>
            @endif
            <ul class="list-group clear-list m-t">
                <li class="list-group-item fist-item text-center">
                    <img src="{{$fair->logo}}" alt="" style="max-width:100%; max-height: 120px;" >
                </li>
                <li class="list-group-item fist-item">
                    <span class="pull-right">
                        {{ $fair->year }}
                    </span>
                    <span class="label label-success">年度</span>
                </li>
                <li class="list-group-item">
                    <span class="pull-right">
                        {{ $fair->name }}
                    </span>
                    <span class="label label-info">名稱</span>
                </li>
                <li class="list-group-item">
                    <span class="pull-right">
                        {!! $fair->active == 1 ? '<a href="/career/auth/'.$fair->year.'/active"><span class="label label-primary">上線</span></a>': '<a href="/career/auth/'.$fair->year.'/active"><span class="label label-warning">尚未上線</span></a>'  !!}
                    </span>
                    <span class="label label-primary">狀態/切換</span>
                </li>
                <li class="list-group-item">
                    <span class="pull-right">
                        <div>
                            <div class="input-group">
                                <select data-placeholder="選擇年度" class="chosen-select" style="width:100px;" tabindex="2" onChange="location = this.options[this.selectedIndex].value;">
                                    <option value="">選擇年度</option>
                                    @foreach($fairs as $value)
                                        <option value="{{ route('dashboard', $value->year) }}">{{$value->year}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </span>
                    <span class="label label-info">更改年次</span>
                </li>
            </ul>

        </div>
        <div class="col-sm-8 pull-right">
            <h2>最近七天{{$fair->year}}就博會流量</h2>
            <div class="flot-chart dashboard-chart">
                <div class="flot-chart-content" id="flot-dashboard-chart"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins {{--collapsed--}}">
                            <div class="ibox-title">
                                <h5>頁面設計</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        <i class="fa fa-wrench"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-user">
                                        <li><a href="index.html#">Config option 1</a>
                                        </li>
                                        <li><a href="index.html#">Config option 2</a>
                                        </li>
                                    </ul>
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <form id="fair-set" action="/career/auth/fair/set" method="post">
                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="panel panel-primary">
                                                <div class="panel-heading">
                                                    設定封面圖片
                                                </div>
                                                <div class="panel-body">
                                                    @for($i=1; $i < 4; $i++)
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <input type="text" id="img{{$i}}_input" name="img{{$i}}_input" style="display: none;">
                                                                <div id="img{{$i}}" class="set-image"></div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <button type="button" class="btn btn-primary btn-block btn-sm img_modal" data-index="{{$i}}" style="width:120px;">
                                                                    @if($i == 1)
                                                                        選擇封面照片
                                                                    @elseif($i == 2)
                                                                        選擇背景圖片(二)
                                                                    @elseif($i == 3)
                                                                        選擇背景圖片(三)
                                                                    @endif
                                                                </button>
                                                                @if($i == 1)
                                                                    <div class="form-group">
                                                                        <label>第{{$i}}張圖片動畫</label>
                                                                        <select name="img{{$i}}_anim">
                                                                            <option value="">選擇動畫</option>
                                                                            <option value="boxslide">盒狀滑出</option>
                                                                            <option value="boxfade">盒狀浮現</option>
                                                                            <option value="slotslide-horizontal">百葉窗水平</option>
                                                                            <option value="slotslide-vertical">百葉窗垂直</option>
                                                                            <option value="curtain-1">窗簾1</option>
                                                                            <option value="curtain-2">窗簾2</option>
                                                                            <option value="curtain-3">窗簾3</option>
                                                                            <option value="slotzoom-horizontal">百葉窗漸進水平</option>
                                                                            <option value="slotzoom-vertical">百葉窗漸進垂直</option>
                                                                            <option value="slotfade-horizontal">百葉窗浮現水平</option>
                                                                            <option value="slotfade-vertical">百葉窗浮現垂直</option>
                                                                            <option value="fade">浮現</option>
                                                                            <option value="slideleft">從右滑入左</option>
                                                                            <option value="slideup">從下滑入上</option>
                                                                            <option value="slidedown">從上滑入下</option>
                                                                            <option value="slideright">從左滑入右</option>
                                                                            <option value="papercut">剪紙</option>
                                                                            <option value="3dcurtain-horizontal">3D窗簾水平</option>
                                                                            <option value="3dcurtain-vertical">3D窗簾垂直</option>
                                                                            <option value="cubic">立方體1</option>
                                                                            <option value="cube">立方體2</option>
                                                                            <option value="flyin">飛入</option>
                                                                            <option value="incube">反立方體</option>
                                                                            <option value="turnoff">逆轉</option>
                                                                            <option value="cubic-horizontal">立方體1水平</option>
                                                                            <option value="cube-horizontal">立方體2水平</option>
                                                                            <option value="incube-horizontal">反立方體水平</option>
                                                                            <option value="turnoff-vertical">逆轉垂直</option>
                                                                            <option value="fadefromright">從右浮現</option>
                                                                            <option value="fadefromleft">從左浮現</option>
                                                                            <option value="fadefromtop">從上浮現</option>
                                                                            <option value="fadefrombottom">從下浮現</option>
                                                                            <option value="fadetoleftfadefromright">從右浮現向左</option>
                                                                            <option value="fadetorightfadetoleft">同時向右向左浮現</option>
                                                                            <option value="fadetobottomfadefromtop">從上浮現向下</option>
                                                                            <option value="fadetotopfadefrombottom">從下浮現向上</option>
                                                                            <option value="parallaxtoright">視差向右</option>
                                                                            <option value="parallaxtotop">視差向上</option>
                                                                            <option value="parallaxtoleft">視差向左</option>
                                                                            <option value="parallaxtobottom">視差向下</option>
                                                                            <option value="scaledownfromright">縮小向右</option>
                                                                            <option value="scaledownfromleft">縮小向左</option>
                                                                            <option value="scaledownfromtop">縮小向上</option>
                                                                            <option value="scaledownfrombottom">縮小向下</option>
                                                                            <option value="zoomout">縮小</option>
                                                                            <option value="zoomin">放大</option>
                                                                            <option value="notransition">無動畫</option>
                                                                        </select>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            @if($i != 3)
                                                                <div class="col-lg-12">
                                                                    <div class="hr-line-dashed"></div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endfor
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="panel panel-success">
                                                <div class="panel-heading">
                                                    Slogan 設定
                                                </div>
                                                <div class="panel-body">
                                                    <textarea name="slogan" id="editor" rows="10" cols="80" placeholder="內文" required>{!! $setting->slogan or '' !!}</textarea>
                                                    <script>
                                                        CKEDITOR.replace('editor', {
                                                            customConfig: '/career/assets/js/ckeditor_slogan.js'
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="panel panel-info">
                                                <div class="panel-heading">
                                                    檔案上傳
                                                </div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        @for($i=1; $i < 3; $i++)
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <input type="text" id="doc{{$i}}_name" placeholder="檔案顯示名稱" name="doc{{$i}}_name" class="form-control">
                                                                    <input type="text" id="doc{{$i}}_url" name="doc{{$i}}_url" class="form-control" style="display: none;">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <button type="button" class="btn btn-primary btn-sm doc_modal" data-index="{{$i}}" style="width:120px;">
                                                                    @if($i == 1)
                                                                        選擇第一個檔案
                                                                    @elseif($i == 2)
                                                                        選擇第二個檔案
                                                                    @endif
                                                                </button>
                                                                <button type="button" class="btn btn-warning btn-sm doc_clean" data-index="{{$i}}" style="width:50px;">
                                                                    清除
                                                                </button>
                                                            </div>
                                                            @if($i != 2)
                                                            <div class="col-lg-12">
                                                                <div class="hr-line-dashed"></div>
                                                            </div>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                </div>
                                                <div class="panel-footer">
                                                    如果只選擇第一個檔案，則只會出現一個
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="row">
                                        <div class="pull-right m-r-lg">
                                            <button class="btn btn-sm btn-primary m-t-n-xs save" type="submit"><strong>儲存</strong></button>
                                        </div>
                                    </div>
                                    <input type="hidden" name="id" value="{{$fair->id}}">
                                    <input type="hidden" name="year" value="{{$fair->year}}">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--上傳圖片 Modal--}}
            <div class="modal inmodal" id="img_upload" tabindex="-1" role="dialog"  aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content animated fadeIn">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <div class="tabs-container">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#img-tab-1" aria-expanded="false">圖庫</a></li>
                                    <li class=""><a data-toggle="tab" href="#img-tab-2" aria-expanded="true">自行上傳</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="img-tab-1" class="tab-pane active ">
                                        <div class="panel-body">
                                            <div class="gallery scroll_content">
                                                <div class="gallery-img" style="background-image: url('{{asset('assets/img/img1.JPG')}}')"></div>
                                                <div class="gallery-img" style="background-image: url('{{asset('assets/img/img2.JPG')}}')"></div>
                                                <div class="gallery-img" style="background-image: url('{{asset('assets/img/img3.JPG')}}')"></div>
                                                <div class="gallery-img" style="background-image: url('{{asset('assets/img/img4.JPG')}}')"></div>
                                                <div class="gallery-img" style="background-image: url('{{asset('assets/img/img5.JPG')}}')"></div>
                                                <div class="gallery-img" style="background-image: url('{{asset('assets/img/img6.JPG')}}')"></div>
                                                <div class="gallery-img" style="background-image: url('{{asset('assets/img/img7.JPG')}}')"></div>
                                                <div class="gallery-img" style="background-image: url('{{asset('assets/img/img8.JPG')}}')"></div>
                                                <div class="gallery-img" style="background-image: url('{{asset('assets/img/img9.JPG')}}')"></div>
                                                <div class="gallery-img" style="background-image: url('{{asset('assets/img/img10.JPG')}}')"></div>
                                                <div class="gallery-img" style="background-image: url('{{asset('assets/img/img11.JPG')}}')"></div>
                                                <div class="row text-center" style="clear: both;">
                                                    <button class="btn btn-l btn-primary m-md loadmoreimg" type="button" style="width:300px">載入其他上傳圖片</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="img-tab-2" class="tab-pane">
                                        <div class="panel-body">
                                            <form id="uploadimage" class="dropzone" action="/career/auth/upload">
                                                {!! csrf_field() !!}
                                                <div class="dropzone-previews"></div>
                                                <button type="submit" class="btn btn-primary pull-right">上傳照片</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <button type="button" class="btn btn-white pull-right m-t" data-dismiss="modal">關閉</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--上傳圖片 Modal--}}
            {{--上傳檔案 Modal--}}
            <div class="modal inmodal" id="doc_upload" tabindex="-1" role="dialog"  aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content animated fadeIn">
                            <div class="modal-body">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <div class="tabs-container">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a data-toggle="tab" href="#doc-tab-1" aria-expanded="false">檔案夾</a></li>
                                        <li class=""><a data-toggle="tab" href="#doc-tab-2" aria-expanded="true">自行上傳</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="doc-tab-1" class="tab-pane active">
                                            <div class="panel-body">
                                                <div class="scroll_content">
                                                    <ul id="file-list" class="col-lg-12">
                                                        @foreach($files as $file)
                                                        <li id="file-{{ $file->id }}" data-url="{{ $file->url }}" data-name="{{ $file->name }}" class="col-xs-4 col-sm-3 col-md-2 file-box">
                                                            <div class="file no-padding">
                                                                <div>
                                                                    <div class="icon">
                                                                        <i class="fa fa-file"></i>
                                                                    </div>
                                                                    <div class="file-name">
                                                                        {{ $file->name }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                    <div class="row text-center" style="clear: both;">
                                                        <button class="btn btn-l btn-primary m-md loadmoredoc" type="button" style="width:300px">載入其他上傳檔案</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="doc-tab-2" class="tab-pane">
                                            <div class="panel-body">
                                                <form id="uploaddoc" class="dropzone" action="/career/auth/upload">
                                                    {!! csrf_field() !!}
                                                    <div class="dropzone-previews"></div>
                                                    <button type="submit" class="btn btn-primary pull-right">上傳檔案</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <button type="button" class="btn btn-white pull-right m-t" data-dismiss="modal">關閉</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {{--上傳檔案 Modal--}}


        </div>
    </div>
    <script>
        $(document).on('ready pjax-success',function(){
            dashboardInit();
        });
        dashboardInit = function(){
//            $('.scroll_content').slimscroll({
//                height: '400px'
//            });
            @if(isset($setting))
                @foreach($setting as $key => $value)
                    @if($key == 'img1_anim' or $key == 'img2_anim' or $key == 'img3_anim')
                        $('select[name="{{$key}}"] option[value="{{$value}}"]').attr('selected', '');
                    @elseif($key == 'img1_input' or $key == 'img2_input' or $key == 'img3_input')
                        $("div#{{substr($key,0,4)}}").css('background-image', 'url("{!! $value !!}")');
                        $("input#{{$key}}").val('{!! $value !!}');
                    @elseif($key == 'doc1_name' or $key == 'doc2_name' or $key == 'doc1_url' or $key == 'doc2_url')
                        @if(!empty($value))
                            $('input#{{$key}}').val('{!! $value !!}');
                            $('.doc_modal[data-index="{{substr($key, 3, 1)}}"]').hide();
                            $('.doc_clean[data-index="{{substr($key, 3, 1)}}"]').show();
                        @else
                            $('.doc_modal[data-index="{{substr($key, 3, 1)}}"]').show();
                            $('.doc_clean[data-index="{{substr($key, 3, 1)}}"]').hide();
                        @endif
                    @endif
                @endforeach
            @endif
            $('.img_modal').on('click', function(){
                var index = $(this).data('index');
                $('#img_upload').data("index", index).modal('show');
            });
            $('.doc_modal').on('click', function(){
                var index = $(this).data('index');
                $('#doc_upload').data("index", index).modal('show');
            });
            {{--@for($i=1; $i < 4; $i++)--}}
            $("#uploadimage").dropzone({
                autoProcessQueue: false,
                uploadMultiple: false,
                maxFiles: 1,
                maxFilesize: 2,
                parallelUploads: 1,
                acceptedFiles: 'image/*',
                // Dropzone settings
                init: function() {
                    var myDropzone = this;
                    this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        myDropzone.processQueue();
                    });
                    this.on('success', function(file,data){
                        var index = $('#doc_upload').data("index");
                        $("div#img" + index).css('background-image', 'url("'+data['url']+'")');
                        $("input#img" + index + "_input").val(data['url']);
                        $('#img_upload').modal('hide');
                        this.removeFile(file);
                    })
                }
            });
            $("#uploaddoc").dropzone({
                autoProcessQueue: false,
                uploadMultiple: false,
                maxFiles: 1,
                maxFilesize: 2,
                parallelUploads: 1,
                acceptedFiles: 'application/*',
                // Dropzone settings
                init: function() {
                    var myDropzone = this;
                    this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        myDropzone.processQueue();
                    });
                    this.on('success', function(file,data){
                        var index = $('#doc_upload').data("index");
                        $('#doc'+index+'_name').val(data['name']);
                        $('#doc'+index+'_url').val(data['url']);
                        $('#doc_upload').modal('hide');
                        $('.doc_modal[data-index="'+index+'"]').hide();
                        $('.doc_clean[data-index="'+index+'"]').show();
                        this.removeFile(file);
                    })
                }
            });

        };
        $(".chosen-select").chosen();
    </script>
    <script>
        $(function(){
            var data1 = [
                [0, {{ $view1['rows'][0][1] }}]
                @for($i = 1; $i < count($view1['rows']); $i++ )
                ,[{{$i}},{{$view1['rows'][$i][1]}}]
                @endfor
            ];
            var chartData = {axis: [[0, "{{ str_split(substr($view1['rows'][0][0], 4),2)[0].'/'.str_split(substr($view1['rows'][0][0], 4),2)[1] }}"]
                @for($i = 1; $i < count($view1['rows']); $i++ )
                , [{{$i}}, "{{str_split(substr($view1['rows'][$i][0], 4),2)[0].'/'.str_split(substr($view1['rows'][$i][0], 4),2)[1]}}"]
                @endfor
            ]};
            $("#flot-dashboard-chart").length && $.plot($("#flot-dashboard-chart"), [
                        { label: "第一組", data: data1 }
                    ],
                    {
                        series: {
                            lines: {
                                show: false,
                                fill: true
                            },
                            splines: {
                                show: true,
                                tension: 0.4,
                                lineWidth: 1,
                                fill: 0.4
                            },
                            points: {
                                radius: 3,
                                show: true
                            },
                            shadowSize: 2
                        },
                        grid: {
                            hoverable: true,
                            clickable: true,
                            tickColor: "#d5d5d5",
                            borderWidth: 1,
                            color: '#d5d5d5'
                        },
                        colors: [ "#1C84C6", "#ed5565","#1ab394"],
                        xaxis:{
                            ticks: chartData.axis
                        },
                        yaxis: {
                            ticks: 4
                        },
                        tooltip: {
                            show: true,
                            content:  function(label, xval, yval, flotItem){
                                return label+" | <b>"+chartData.axis[xval][1]+"</b> | <span>流量："+yval+"</span>"
                            }
                        }
                    }
            );
        });

    </script>
@endsection
@section('footer')
    <script>
        $(function(){
            $('.gallery-img').click(function(){
                var _this = $(this), url, index, $modal;
                $modal = $('#img_upload');
                url = _this.attr('style').split("url('")[1].split("')")[0];
                index = $modal.data('index');
                $("div#img" + index).css('background-image', 'url("'+url+'")');
                $("input#img" + index + "_input").val(url);
                $modal.modal('hide');
            });
            $('.file-box').on('click', function(){
                var $modal, url, name, index;
                $modal = $('#doc_upload');
                url = $(this).data('url');
                name = $(this).data('name');
                index = $modal.data('index');
                $('#doc'+index+'_name').val(name);
                $('#doc'+index+'_url').val(url);
                $('.doc_modal[data-index="'+index+'"]').hide();
                $('.doc_clean[data-index="'+index+'"]').show();
                $modal.modal('hide');
            });
            var imgstart = 0;
            $('.loadmoreimg').on('click', function(){
                var _this = $(this);
                $.ajax({
                    url:'{{ url('/auth/file/images') }}/'+imgstart,
                    success: function(data){
                        if(data.files.length == 0) _this.hide();
                        imgstart += data.files.length;
                        for(var i=0; i<data.files.length; i++){
                            console.log($('.gallery-img').last());
                            $('.in .gallery-img').last().after("<div class='gallery-img' style=\"background-image:url('"+ data.files[i].url + "')\"></div>");
                        }
                    }
                });
            });
            $('.doc_clean').on('click', function(){
                var _this = $(this), index;
                index = _this.data('index');
                $('#doc'+index+'_name').val('');
                $('#doc'+index+'_url').val('');
                $('.doc_modal[data-index="'+index+'"]').show();
                $('.doc_clean[data-index="'+index+'"]').hide();
            });
            var docstart = 0;
            $('.loadmoredoc').on('click', function(){
                var _this = $(this);
                $.ajax({
                    url:'{{ url('/auth/file/docs') }}/'+docstart,
                    success: function(data){
                        docstart += data.files.length;
                        for(var i=0; i<data.files.length; i++){
                            $('.in .gallery-file').last().after("<div class='gallery-file' style=\'background-image:url('"+ data.files[i].name + "')\"></div>");
                        }
                    }
                });
            });

            $('.save').on('click', function(){
                $('#fair-set').submit();
            });
        })
    </script>


@endsection
