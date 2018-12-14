@extends('auth/auth')
<?php
    use Jenssegers\Date\Date;
    Date::setLocale('zh_TW');
?>

@section('header')
    <title>就業博覽會 | 公告</title>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content animated fadeInUp">

                <div class="ibox">
                    <div class="ibox-title">
                        <h5>{{$fair->year}} 年公告列表</h5>
                        <div class="ibox-tools">
                            <a data-pjax href="/career/auth/{{$fair->year}}/post/create" class="btn btn-primary btn-xs">建立新公告</a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="project-list">
                            <table class="table table-hover">
                                <tbody>
                                @foreach($posts as $value)
                                <tr class="post_{{$value->id}}">
                                    <td class="post-status col-md-1">
                                        <form class="post-status inline" action="{{ route('post-status', $value->id) }}">
                                            {!! csrf_field() !!}
                                            <input type="hidden" name="id" value="{{$value->id}}">
                                            <button class="status_{{$value->id}} btn {{ $value->post_status == '0'? 'btn-warning': 'btn-primary' }} btn-sm">{{ $value->post_status == '0'? '隱藏': '顯示' }}</button>
                                        </form>
                                    </td>
                                    <td class="post-title col-md-4">
                                        <a data-pjax href="{{ route('post-edit', [$fair->year, $value->id])}}">{{ $value->title }}</adata-pjax>
                                        <br/><small>最後修改日期：</small>
                                        <small data-toggle="tooltip" data-placement="bottom" title="{{$value->updated_at->timezone('Asia/Taipei')->format('Y/m/d H:s')}}">{{ Date::make($value->updated_at)->diffForHumans() }}</small>
                                    </td>
                                    <td class="col-md-5">
                                        <small>{{str_limit(strip_tags($value->content), $limit = 200, $end = '...')}}</small>
                                    </td>
                                    <td class="post-actions col-md-2">
                                        <form class="delete-post inline" action="{{ route('post-delete', $value->id) }}">
                                            {!! csrf_field() !!}
                                            <input type="hidden" name="title" value="{{$value->title}}">
                                            <input type="hidden" name="id" value="{{$value->id}}">
                                            <button class="btn btn-danger btn-sm"><i class="fa fa-ban"></i> 刪除 </button>
                                        </form>
                                        <a data-pjax href="{{ route('post-edit', [$fair->year, $value->id])}}" class="btn btn-white btn-sm" data-pjax><i class="fa fa-pencil"></i> 修改 </a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                            {!! $posts->setPath('')->render() !!}
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
            $('.post-status').submit(function(e){
                e.preventDefault();
                var token = $( this ).find( 'input[name=_token]' ).val();
                var id = $( this ).find( 'input[name=id]' ).val();
                var url = $(this).prop('action');
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        '_token':  token,
                        'id':  id
                    },
                    success: function(data){
                        var status = data['status'];
                        if(status == 'active')
                        {
                            $('button.status_'+id).removeClass('btn-warning').addClass('btn-primary').text('顯示');
                        }
                        else if(status == 'inactive')
                        {
                            $('button.status_'+id).removeClass('btn-primary').addClass('btn-warning').text('隱藏');
                        }
                    }
                },'json');
                return false;

            });
            $('.delete-post').submit(function(e){
                e.preventDefault();
                var token = $( this ).find( 'input[name=_token]' ).val();
                var id = $( this ).find( 'input[name=id]' ).val();
                var title = $( this ).find( 'input[name=title]' ).val();
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
                                        swal("刪除", "公告："+title+"已刪除", "success");
                                        $('.post_'+id).remove();
                                    }
                                    else
                                    {
                                        swal.close();
                                        toastr.error(msg);
                                    }
                                }
                            },'json');
                        } else {
                            swal("取消刪除", "您的公告尚未被刪除：)", "error");
                        }
                });
            });

        });


    </script>

@endsection