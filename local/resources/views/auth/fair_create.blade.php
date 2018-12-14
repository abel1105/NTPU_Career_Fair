@extends('auth.auth')

@section('header')
    <title>就業博覽會 | 新增活動</title>
@endsection

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>新增活動 <small>快速新增就業博覽會年度</small></h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">

                            <div class="col-sm-5 b-r"><h3 class="m-t-none m-b">欲新增的就業博覽會</h3>
                                <form role="form" method="post" action="/career/auth/fair/create" >
                                    {!! csrf_field() !!}
                                    <div class="form-group"><label>年度</label> <input type="number" name="year" placeholder="輸入西元年" class="form-control" min="2010" step="1" required></div>
                                    <div class="form-group"><label>名稱</label> <input type="text" name="name" placeholder="數入活動名稱" class="form-control" required></div>
                                    <div class="form-group"><label>Logo照片</label> <input type="text" name="logo" placeholder="請從右邊上傳圖片" class="form-control" edit-logo readonly></div>
                                    <div>
                                        <button class="btn btn-sm btn-primary pull-left m-t-n-xs reset-edit" type="button"><strong>清除照片連結</strong></button>
                                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>新增</strong></button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-7"><h4>上傳logo</h4>
                                <div class="ibox float-e-margins">
                                    <div class="ibox-content">
                                        <form id="createlogo" class="dropzone" action="/career/auth/upload">
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
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>編輯活動 <small>修改現有的就業博覽會年度</small></h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">

                            <div class="col-sm-5 b-r"><h3 class="m-t-none m-b">欲修改的就業博覽會</h3>
                                <form role="form" method="post" action="/career/auth/fair/update" >
                                    {!! csrf_field() !!}
                                    <div class="form-group"><label>年度</label>
                                        <select name="year" class="form-control m-b">
                                            {{--<option value=""></option>--}}
                                            @foreach ($fairs as $data)
                                                <option value="{{$data['year']}}" data-name="{{$data['name']}}" data-logo="{{$data['logo']}}">{{$data['year']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group"><label>名稱</label> <input type="text" name="name" placeholder="數入活動名稱" class="form-control" update-name required></div>
                                    <div class="form-group"><label>Logo照片</label> <input type="text" name="logo" placeholder="請從右邊上傳圖片" class="form-control" update-logo readonly></div>
                                    <div>
                                        <button class="btn btn-sm btn-primary pull-left m-t-n-xs reset-update" type="button"><strong>清除照片連結</strong></button>
                                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>修改</strong></button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-7"><h4>上傳logo</h4>
                                <div class="ibox float-e-margins">
                                    <div class="ibox-content">
                                        <form id="updatelogo" class="dropzone" action="/career/auth/upload">
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
        </div>
    </div>

@endsection

@section('footer')

    <script>
        $(document).ready(function(){

            Dropzone.options.createlogo = {

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
                        $("input[edit-logo]").val(data['url']);
                    })
                }

            };
            Dropzone.options.updatelogo = {

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
                        $("input[update-logo]").val(data['url']);
                    })
                }

            };
            $('select[name=year]').on('change', function(){
                $nowUpdateYear = $('select[name=year]').val();
                $nowUpdateName = $('option[value='+$nowUpdateYear+']').attr('data-name');
                $nowUpdateLogo = $('option[value='+$nowUpdateYear+']').attr('data-logo');

                $('input[update-name]').val($nowUpdateName);
                $('input[update-logo]').val($nowUpdateLogo);
            });
            $('select[name=year]').trigger('change');
            $('.reset-update').click(function(){
                $('input[update-logo]').val('');
            });
            $('.reset-edit').click(function(){
                $('input[edit-logo]').val('');
            })


        });
    </script>

@endsection