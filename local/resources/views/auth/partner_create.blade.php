@extends('auth.auth')

@section('header')
    <title>建立職缺｜就業博覽會</title>

@endsection
<?php
    use Carbon\Carbon;
?>

@section('content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>建立職缺<small>&nbsp;&nbsp;&nbsp;於{{session('year')}}年度就業博覽會</small></h5>
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
                            <form id="partner_form" method="post" class="form-horizontal" action="/career/auth/partner/create">
                                {!! csrf_field() !!}
                                <div class="form-group"><label class="col-md-2 control-label">名稱</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="company" value="" placeholder="公司名稱" required>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-md-2 control-label">檔案</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="link" placeholder="職缺檔案" required>
                                    </div>
                                </div>
                                <div class="form-group" id="data_1"><label class="col-md-2 control-label">圖片</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="img" value="" placeholder="公司Logo" required>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-sm btn-primary m-t-n-xs save" type="button"><strong>儲存</strong></button>
                                    </div>
                                </div>
                                <input type="hidden" name="fair_id" value="{{\App\Fair::nowid() }}">
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
                                <h3>上傳職缺檔案</h3>
                                <form id="uploadfile" class="dropzone col-md-12 m-b-md" action="/career/auth/upload" style="min-height: 200px;">
                                    {!! csrf_field() !!}
                                    <div class="dropzone-previews"></div>
                                    <button type="submit" class="btn btn-primary pull-right">上傳檔案</button>
                                </form>
                                <h3>上傳公司Logo</h3>
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
                $count =0
                $('input[required]').each(function(){
                    if($(this).val() == '') {
                        toastr.error($(this).attr('placeholder')+' 尚未填寫');
                        $count++;
                    }
                })
                if($count==0){
                    $('#partner_form').submit();
                }
            });
            $("#uploadimg").dropzone({

                autoProcessQueue: false,
                uploadMultiple: false,
                maxFiles: 1,
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
                        $("input[name=img]").val(data['url']);
                    })
                }

            });
            $("#uploadfile").dropzone({
                autoProcessQueue: false,
                uploadMultiple: false,
                maxFiles: 1,
                maxFilesize: 5,
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
                        $("input[name=link]").val(data['url']);
                    })
                }
            });
        });
    </script>

@endsection