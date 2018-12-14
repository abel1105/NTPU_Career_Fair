@extends('auth.auth')
@section('header')
    <title>檔案管理員｜就業博覽會</title>
@endsection
<?php
use Jenssegers\Date\Date;
use Carbon\Carbon;
Date::setLocale('zh_TW');
?>

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2>檔案管理員<?php
            switch (Request::path()){
                case 'auth/file/image':
                    echo ' | 相片';
                    break;
                case 'auth/file/doc':
                    echo ' | 文件';
                    break;
                case 'auth/file/other':
                    echo ' | 其他';
                    break;
            }
            ?></h2>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12 animated fadeInRight">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="file-manager row">
                        <div id="category" class="pull-left col-md-4 m-t-sm">
                            <h4 style="display: inline;">分類：</h4>
                            <a href="/career/auth/file" class="file-control {{Request::path() == 'auth/file' ? 'active' : ''}}"><h4 style="display: inline;">全部</h4></a>
                            <a href="/career/auth/file/image" class="file-control {{Request::path() == 'auth/file/image' ? 'active' : ''}}"><h4 style="display: inline;">相片</h4></a>
                            <a href="/career/auth/file/doc" class="file-control {{Request::path() == 'auth/file/doc' ? 'active' : ''}}"><h4 style="display: inline;">文件</h4></a>
                            <a href="/career/auth/file/other" class="file-control {{Request::path() == 'auth/file/other' ? 'active' : ''}}"><h4 style="display: inline;">其他</h4></a>

                        </div>
                        <form id="form-search" role="search" method="get" action="/career/auth/file/search" class="col-md-3">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="搜尋檔案" name="search" value="{{Request::only('search')['search']}}">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search" style="font-size: 17.5px;"></i></button>
                                </span>
                            </div>
                        </form>
                        <div id="btn-toggle-delete" class="pull-right col-md-2" data-mode="none">
                            <button type="button" class="btn btn-warning btn-block">
                                批次刪除
                            </button>
                        </div>
                        <div id="btn-delete" class="col-md-2" style="display: none;">
                            <button type="button" class="btn btn-danger btn-block" data-ready="false" disabled="disabled">
                                確認刪除
                            </button>
                        </div>
                        <div id="btn-upload" class="pull-right col-md-2">
                            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#myModal4">
                                上傳檔案
                            </button>
                        </div>
                        <div class="modal inmodal" id="myModal4" tabindex="-1" role="dialog"  aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content animated fadeIn">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title">上傳檔案</h4>
                                        <small>支援多檔上傳，同時上傳20個檔案，每個檔案不超過2MB</small>
                                    </div>
                                    <div class="modal-body">
                                        <form id="uploadfile" class="dropzone" action="/career/auth/uploadMultiple">
                                            {!! csrf_field() !!}
                                            <div class="dropzone-previews"></div>
                                            <button type="submit" class="btn btn-primary pull-right">上傳檔案</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-white" data-dismiss="modal">關閉</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <ul id="list" class="col-lg-12">
                    @foreach($files as $value)
                        <li id="file-{{$value->id}}" class="col-xs-4 col-sm-3 col-md-2 file-box" data-id="{{$value->id}}" data-author="{{$value->author}}" data-toggle="modal" data-target="#file-modal-{{$value->id}}"><!--file-box no-padding -->
                            <div class="file no-padding">
                                <div>
                                    @if(substr($value->type,0,11) =='application')
                                        <div class="icon">
                                            <i class="fa fa-file"></i>
                                        </div>
                                    @elseif(substr($value->type,0,5) == 'image')
                                        <div class="image">
                                            <div class="centered">
                                                <img alt="image" class="img-responsive" src="{{$value->url}}">
                                            </div>
                                        </div>
                                    @endif
                                    @if(substr($value->type,0,11) =='application')
                                    <div class="file-name">
                                        {{ $value -> name }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                @foreach($files as $value)
                    <div class="modal inmodal" id="file-modal-{{$value->id}}" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content animated fadeIn">
                                <div class="modal-body">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="font-size: 30px;">&times;</span><span class="sr-only">Close</span></button>
                                    <div class="row">
                                        <div class="col-md-8 text-center">
                                            @if(substr($value->type,0,11) =='application')
                                                <a href="{{$value->url}}">
                                                    <div class="icon" style=" border: 3px solid #676a6c;padding: 60px;">
                                                        <i class="fa fa-file" style="font-size: 100px;"></i>
                                                    </div>
                                                </a>
                                            @elseif(substr($value->type,0,5) == 'image')
                                                <img src="{{$value->url}}" style="max-width:100%; max-height: 500px;"/>
                                            @endif
                                        </div>
                                        <div class="col-md-4">
                                            <h4>檔案名稱：{{$value->name}}</h4>
                                            <h4>上傳時間：{{Carbon::parse($value->updated_at)->format('Y/m/d H:i') .'（'. Date::make($value->updated_at, 'Asia/Taipei')->diffForHumans()}} ）</h4>
                                            <h4>上傳人：{{$value->author}}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div id="loadmoreajaxloader" class="text-center m-t-md m-b-lg">
                    <i class="fa fa-refresh fa-spin" style="font-size: 30px;display: none;"></i>
                    {{--{!! $files->setPath('')->appends(Request::only('search'))->render() !!}--}}
                </div>
            </div>
        </div>
    </div>
</div>
    {{--{{dd(Request::all()['search'])}}--}}
@endsection

@section('footer')
    <script>
        $(function(){
            $('#uploadfile').dropzone({

                autoProcessQueue: false,
                uploadMultiple: true,
                maxFiles: 20,
                maxFilesize: 5,
                parallelUploads: 20,

                // Dropzone settings
                init: function() {
                    var myDropzone = this;

                    this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        myDropzone.processQueue();
                    });
                    this.on('successmultiple', function(file,data){
                        console.log(file, data);
                        var $html = '';
                        for(var i=0;i < data.file.length; i++){
                            $html += '<li id="file-'+data.file[i].id+'" class="col-xs-4 col-sm-3 col-md-2 file-box" data-id="'+data.file[i].id+'" data-author="'+data.file[i].author+'">'+
                                        '<div class="file no-padding">'+
                                            '<div>';
                            if(data.file[i].isImage == false){
                                $html += '<div class="icon">'+
                                            '<i class="fa fa-file"></i>'+
                                         '</div>'
                            }else{
                                $html += '<div class="image">'+
                                            '<div class="centered">'+
                                                '<img alt="image" class="img-responsive" src="'+data.file[i].url+'">'+
                                            '</div>'+
                                        '</div>';
                            }
                            if(data.file[i].isImage == false){
                                $html += '<div class="file-name">'+ data.file[i].name + '</div>';

                            }
                            $html +='</div></div></li>';
                        }
                        $('#list').prepend($html);
                    })
                }
            });
        });
        var input = '{{ isset(Request::all()['search']) ? Request::all()['search'] : 'false'}}';
        var page = 2, url = '/career/{{Request::path()}}';
        $(window).scroll(function() {
            if ($(window).data('ajaxready') == false) return;
            if ($(window).scrollTop()+500 >= $(document).height() - $(window).height()) {
                $('div#loadmoreajaxloader i').show();
                $(window).data('ajaxready', false);
                var send = input != 'false' ? url+'?page=' + page+'&search='+input : url+'?page=' + page;
                $.getJSON(send, function (data) {
                    if(data.data.length != 0) {
                        var html = '';
                        for(var i=0;i <data.data.length; i++){
                            html += '<li id="file-'+data.data[i].id+'" class="col-xs-4 col-sm-3 col-md-2 file-box" data-id="'+data.data[i].id+'">' +
                                        '<div class="file no-padding">' +
                                            '<div>';
                            if(data.data[i].type.substring(0,11) == 'application'){
                                html += '<div class="icon">'+
                                            '<i class="fa fa-file"></i>' +
                                         '</div>';
                            }else if(data.data[i].type.substring(0,5) == 'image'){
                                html += '<div class="image">'+
                                            '<div class="centered">' +
                                                '<img alt="image" class="img-responsive" src="'+data.data[i].url+'">' +
                                            '</div>' +
                                         '</div>';
                            }
                            if(data.data[i].type.substring(0,11) == 'application'){
                                html += '<div class="file-name">'+data.data[i].name+'</div>';
                            }
                            html +='</div>'+
                                '</div>' +
                            '</li>'
                        }
                        $('#list').append(html);
                        page++;
                    }
                    if(data.current_page == data.last_page || data.next_page_url == null){
                        $('div#loadmoreajaxloader i').hide();
                        $('div#loadmoreajaxloader').append('<span class="label label-inverse p-xs" style="font-size: 15px;">已無資料</span>')
                    }else{
                        $(window).data('ajaxready', true);
                    }
                });

            }
        });
        $('#btn-toggle-delete').click(function(){
            var mode = $(this).attr('data-mode');
            $('#btn-upload, #form-search, #category, #btn-delete').toggle();
            $('#list').toggleClass('active-delete');
            if(mode == 'none'){
                $(this).find('button').text('取消刪除');
                $('.modal').on('show.bs.modal', function (e) {
                    e.preventDefault();
                });
                $('#list').on('click','li',function(){
                    $(this).toggleClass('select');
                    if($('#list li.select').length != 0){
                        $('#btn-delete button').removeAttr('disabled').attr('data-ready', 'true');
                    }else{
                        $('#btn-delete button').attr('disabled','disabled').attr('data-ready', 'false');
                    }
                });
                $(this).removeClass('pull-right').attr('data-mode', 'on');
            }else if(mode == 'on'){
                $('#list li').unbind( "click" );
                $('#list li.select').removeClass('select');
                $(this).find('button').text('批次刪除');
                $('.modal').off('show.bs.modal');
                $('#list').off('click','li');
                $(this).addClass('pull-right').attr('data-mode', 'none');
            }
        });
        $('#btn-delete').on('click','button[data-ready="true"]', function(){
            $('#btn-delete button').attr('disabled','disabled').attr('data-ready', 'false');
            var id = [];
            var token = $('meta[name="csrf-token"]').attr('content');
            $('#list.active-delete li.select').each(function(){
                id.push($(this).data('id'));
            });
            swal({
                        title: "您確定要刪除？",
                        text: "您將無法回復刪除",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#ed5565",
                        confirmButtonText: "是，請刪除!",
                        cancelButtonText: "否，取消！",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                type: "POST",
                                url: '/career/auth/file/delete',
                                data: {
                                    _token: token,
                                    id: id
                                },
                                success: function(data){
                                    var status = data['status'];
                                    if(status == 'success')
                                    {
                                        swal("刪除", "檔案已刪除", "success");
                                        for(var i=0;i<id.length;i++){
                                            $('#file-'+id[i]).remove();
                                        }
                                    }
                                    else
                                    {
                                        swal("刪除失敗", "檔案刪除失敗，請重新操作", "error");
                                    }
                                }
                            },'json');
                        } else {
                            swal("取消刪除", "您的檔案尚未被刪除：)", "error");
                            $('#list li.select').removeClass('select');
                        }
                    });
        })
    </script>

@endsection