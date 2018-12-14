@extends('auth.auth')

@section('header')
    <title>職涯活動｜就業博覽會</title>
@endsection
<?php
    use Jenssegers\Date\Date;
    use Carbon\Carbon;
    Date::setLocale('zh_TW');
    $type = isset($type) ? $type : null;
?>
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content animated fadeInUp">

                <div class="ibox">
                    <div class="ibox-title">
                        <h5>{{session('year')}} 年職涯活動</h5>
                        <div class="ibox-tools">
                            <a data-pjax href="/career/auth/category" class="btn btn-primary btn-xs">管理分類</a>
                            <a data-pjax href="/career/auth/{{session('year')}}/lecture/create" class="btn btn-primary btn-xs">建立新活動</a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="project-list">
                            <table class="table table-hover">
                                <tbody>
                                @if ($lectures->total() != 0)
                                <tr>
                                    <th><a href="/career/auth/{{session('year')}}/lecture/order/{{$type== 'dateDESC'  ? 'dateASC' : 'dateDESC'}}">日期 {!!  $type== 'dateDESC' ? '<i class="fa fa-caret-down"></i>' : ($type == 'dateASC' ? '<i class="fa fa-caret-up"></i>': '')!!}</a></th>
                                    <th>時間</th>
                                    <th>地點</th>
                                    <th>活動分類</th>
                                    <th><a href="/career/auth/{{session('year')}}/lecture/order/{{$type== 'updateDESC' ? 'updateASC' : 'updateDESC'}}">活動名稱(最後更新時間 {!!  $type== 'updateDESC' ? '<i class="fa fa-caret-up"></i>' : ($type == 'updateASC' ? '<i class="fa fa-caret-down"></i>': '')!!})</a></th>
                                    <th>功能</th>
                                </tr>
                                @endif
                                @foreach($lectures as $value)
                                    <tr class="lecture_{{$value->id}}">
                                        <td class="post-date col-md-1">{{ Carbon::createFromFormat('Y-m-d', $value->date)->format('m-d Y')}}</td>
                                        <td class="post-start col-md-1">{{$value->start.'-'.$value->end}}</td>
                                        <td class="post-place col-md-1">{{$value->place}}</td>
                                        <td class="col-md-1">
                                            <small>{{ $value->Category->title }}</small>
                                        </td>
                                        <td class="post-title col-md-4">
                                            <a data-pjax href="{{ route('lecture-edit', [session('year'), $value->id])}}">{{ $value->title }}</a>
                                            <br/><small>最後修改日期：</small>
                                            <small data-toggle="tooltip" data-placement="bottom" title="{{$value->updated_at->timezone('Asia/Taipei')->format('Y/m/d H:s')}}">{{ Date::make($value->updated_at)->diffForHumans() }}</small>
                                        </td>
                                        <td class="post-actions col-md-2">
                                            <form class="delete-lecture inline" action="{{ route('lecture-delete', $value->id) }}">
                                                {!! csrf_field() !!}
                                                <input type="hidden" name="title" value="{{$value->title}}">
                                                <input type="hidden" name="id" value="{{$value->id}}">
                                                <button class="btn btn-danger btn-sm"><i class="fa fa-ban"></i> 刪除 </button>
                                            </form>
                                            <a data-pjax href="{{ route('lecture-edit', [session('year'), $value->id])}}" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> 修改 </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                            {!! $lectures->setPath('')->render() !!}
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
            $('.delete-lecture').submit(function(e){
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
                                            swal("刪除", "活動："+title+" 已刪除", "success");
                                            $('.lecture_'+id).remove();
                                        }
                                        else
                                        {
                                            swal.close();
                                            toastr.error(msg);
                                        }
                                    }
                                },'json');
                            } else {
                                swal("取消刪除", "您的活動尚未被刪除：)", "error");
                            }
                        });
            });
        })


    </script>
@endsection