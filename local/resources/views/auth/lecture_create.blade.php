@extends('auth.auth')

@section('header')
    <title>建立活動｜就業博覽會</title>

@endsection
<?php
    use Carbon\Carbon;
?>

@section('content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>建立新活動<small>&nbsp;&nbsp;&nbsp;於{{session('year')}}年度就業博覽會</small></h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form id="lecture_form" method="post" class="form-horizontal" action="/career/auth/{{session('year')}}/lecture/create">
                            {!! csrf_field() !!}
                            <input type="hidden" name="year" value="{{session('year')}}">
                            <div class="form-group"><label class="col-md-2 control-label">標題</label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-md-8"><input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="標題名稱" required></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" id="data_1"><label class="col-md-2 control-label">日期/時間</label>
                                <div class="row">
                                    <div class="input-group date col-sm-2 pull-left" style="padding-left: 15px;">
                                        <input type="text" class="form-control" name="date" value="{{ Carbon::now()->format('Y-m-d')}}" required>
                                        <span class="input-group-addon"><i class="fa fa-calendar" ></i></span>
                                    </div>
                                    <div class="input-group col-sm-2 pull-left clockpicker" data-autoclose="true" style="padding-left: 15px;">
                                        <input type="text" class="form-control" name="start" placeholder="開始時間" value="{{ old('start') }}" required>
                                        <span class="input-group-addon">
                                            <span class="fa fa-clock-o"></span>
                                        </span>
                                    </div>
                                    <div class="input-group col-sm-2 pull-left clockpicker" data-autoclose="true" style="padding-left: 15px;">
                                        <input type="text" class="form-control" name="end" placeholder="結束時間" value="{{ old('end') }}" required>
                                        <span class="input-group-addon">
                                            <span class="fa fa-clock-o"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-md-2 control-label">地點</label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-md-4"><input type="text" class="form-control" name="place" placeholder="地點" required>{{ old('place') }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-md-2 control-label">分類</label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <select class="form-control" name="type" id="">
                                                @foreach($category as $value)
                                                    <option value="{{$value->id}}">{{ $value->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <a data-pjax href="/career/auth/category" class="btn btn-primary btn-sm">管理分類</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group"><label class="col-md-2 control-label">新增媒體</label>
                                <div class="col-sm-10">
                                    <label class="btn btn-sm btn-primary m-t-n-xs" data-toggle="modal" data-target="#img_upload">新增照片</label>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-md-2 control-label">內文</label>
                                <div class="col-sm-10">
                                    {{--<div class="summernote"></div>--}}
                                    <textarea id="editor" rows="10" cols="80" name="info" placeholder="內文" required></textarea>
                                    <script>
                                        CKEDITOR.replace( 'editor');
                                    </script>
                                </div>
                            </div>
                            <input type="hidden" name="fair_id" value="{{\App\Fair::nowid() }}">
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-sm btn-primary m-t-n-xs save" type="button"><strong>儲存</strong></button>
                                </div>
                            </div>
                        </form>
                        <div class="modal inmodal" id="img_upload" tabindex="-1" role="dialog"  aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content animated fadeIn">
                                    <div class="modal-body">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <div class="tabs-container">
                                            <ul class="nav nav-tabs">
                                                {{--<li class="active"><a data-toggle="tab" href="#img-tab-1" aria-expanded="false">圖庫</a></li>--}}
                                                <li class="active"><a data-toggle="tab" href="#img-tab-2" aria-expanded="true">自行上傳</a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div id="img-tab-1" class="tab-pane">
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
                                                <div id="img-tab-2" class="tab-pane active ">
                                                    <div class="panel-body">
                                                        <form id="uploadimageLC" class="dropzone" action="/career/auth/upload">
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
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer')
    <script>
        $(document).ready(function(){
            $("#uploadimageLC").dropzone({
                autoProcessQueue: false,
                uploadMultiple: false,
                maxFiles: 10,
                maxFilesize: 5,
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
                        CKEDITOR.instances.editor.insertHtml('<img src="'+data['url']+'" style="width:500px;"/>');
                    })
                }
            });
            $('.save').on('click', function(){
                $count =0;
                $('input[required]').each(function(){
                    if($(this).val() == '') {
                        toastr.error($(this).attr('placeholder')+' 尚未填寫');
                        $count++;
                    }
                });
                if($count==0){
                    $('#lecture_form').submit();
                }
            });
        });

        $('#data_1 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            todayHighlight: true,
            language: 'tw',
            format: 'yyyy-mm-dd',
            autoclose: true
        });
        $('.clockpicker').clockpicker();
    </script>

@endsection