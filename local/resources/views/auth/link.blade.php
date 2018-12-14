@extends('auth.auth')

@section('header')
    <title>相關連結｜就業博覽會</title>
@endsection
<?php
    use Jenssegers\Date\Date;
    use Carbon\Carbon;
    Date::setLocale('zh_TW');
?>
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content animated fadeInUp">

                <div class="ibox">
                    <div class="ibox-title">
                        <h5>相關連結 <small>每年度皆適用下列資料，不用針對每個年度去修正</small></h5>
                        <div class="ibox-tools">
                            <a data-pjax href="/career/auth/link/create" class="btn btn-primary btn-xs">建立新連結</a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="project-list">
                            <table class="table table-hover">
                                <tbody>
                                @if ($links->total() != 0)
                                <tr>
                                    <th>圖片</th>
                                    <th>連結名稱</th>
                                    <th>連結</th>
                                    <th>最後修改日期</th>
                                    <th>功能</th>
                                </tr>
                                @endif
                                @foreach($links as $value)
                                    <tr class="link_{{$value->id}}">
                                        <td class="post-date col-md-2 text-center"><img src="{{$value->img}}" style="max-width:100%;max-height: 100px;" /></td>
                                        <td class="post-start col-md-2">{{$value->name}}</td>
                                        <td class="post-place col-md-3"><a target="_blank" href="{{$value->link}}">{{$value->link}}</a></td>
                                        <td class="post-title col-md-2">
                                            <small data-toggle="tooltip" data-placement="bottom" title="{{$value->updated_at->timezone('Asia/Taipei')->format('Y/m/d H:s')}}">{{ Date::make($value->updated_at)->diffForHumans() }}</small>
                                        </td>
                                        <td class="post-actions col-md-2">
                                            <form class="delete-link inline" action="{{ route('link-delete', $value->id) }}">
                                                {!! csrf_field() !!}
                                                <input type="hidden" name="name" value="{{$value->name}}">
                                                <input type="hidden" name="id" value="{{$value->id}}">
                                                <button class="btn btn-danger btn-sm"><i class="fa fa-ban"></i> 刪除 </button>
                                            </form>
                                            <a data-pjax href="{{ route('link-edit', $value->id)}}" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> 修改 </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                            {!! $links->setPath('')->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        $(function(){
            $('.delete-link').submit(function(e){
                e.preventDefault();
                var token = $( this ).find( 'input[name=_token]' ).val();
                var id = $( this ).find( 'input[name=id]' ).val();
                var name = $( this ).find( 'input[name=name]' ).val();
                var url = $(this).prop('action');
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
                                    type: 'POST',
                                    url: url,
                                    data: {
                                        '_token':  token,
                                        'id':  id
                                    },
                                    success: function(data){
                                        var status = data['status'];
                                        var msg = data['msg'];
                                        if(status == 'success')
                                        {
                                            swal("刪除", "連結："+name+" 已刪除", "success");
                                            $('.link_'+id).remove();
                                        }
                                        else
                                        {
                                            swal.close();
                                            toastr.error(msg);
                                        }
                                    }
                                },'json');
                            } else {
                                swal("取消刪除", "您的連結尚未被刪除：)", "error");
                            }
                        });
            });
        })
    </script>
@endsection