@extends('auth/auth')

@section('header')
    <title>修改連結 ｜ 就業博覽會</title>

@endsection

@section('content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>編輯連結</h5>
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
                        <div class="row">
                            <form id="link_form" method="post" class="form-horizontal" action="/career/auth/link/update/{{$link->id}}">
                                {!! csrf_field() !!}
                                <div class="form-group"><label class="col-md-2 control-label">名稱</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="name" value="{{$link->name}}" placeholder="連結名稱" required>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-md-2 control-label">連結</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="link" placeholder="連結" value="{{$link->link}}" required>
                                    </div>
                                </div>
                                <div class="form-group" id="data_1"><label class="col-md-2 control-label">圖片</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="img" value="{{$link->img}}" placeholder="圖片連結" required>
                                        <img class="img m-t-md" src="{{$link->img}}" style="width: 100%; max-height: 200px;"/>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-sm btn-primary m-t-n-xs save" type="button"><strong>儲存</strong></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>上傳檔案方塊</h5>
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
                        <div class="row">
                            <div class="col-md-12">
                                <h3>上傳連結照片</h3>
                                <form id="uploadimg" class="dropzone col-md-12" action="/career/auth/upload" style="min-height: 200px;">
                                    {!! csrf_field() !!}
                                    <div class="dropzone-previews"></div>
                                    <button type="submit" class="btn btn-primary pull-right">上傳照片</button>
                                </form>
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

            $('.save').on('click', function(){
                $count =0;
                $('input[required]').each(function(){
                    if($(this).val() == '') {
                        toastr.error($(this).attr('placeholder')+' 尚未填寫');
                        $count++;
                    }
                });
                if($count==0){
                    console.log('shit');
                    $('#link_form').submit();
                }
            });
            $("#uploadimg").dropzone({

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
                        $("input[name=img]").val(data['url']);
                        $("img.img").attr('src',data['url']);
                    })
                }

            });
        });
    </script>

@endsection