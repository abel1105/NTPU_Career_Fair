@extends('auth.auth')

@section('header')
<title>公司職缺</title>
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
                        <h5>{{session('year')}} 年公司職缺 <small></small></h5>
                        <div class="ibox-tools">
                            <a data-pjax href="/career/auth/partner/create" class="btn btn-primary btn-xs">建立新職缺</a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="project-list">
                            <table class="table table-hover">
                                <tbody>
                                @if ($partner->total() != 0)
                                    <tr>
                                        <th></th>
                                        <th>公司名稱</th>
                                        <th>Logo</th>
                                        <th>下載連結</th>
                                        <th>最後修改日期</th>
                                        <th>功能</th>
                                    </tr>
                                @endif
                                @foreach($partner as $value)
                                    <tr class="partner_{{$value->id}}">
                                        <td class="partner-status col-md-1">
                                            <form class="partner-status inline" action="{{ route('partner-status', $value->id) }}">
                                                {!! csrf_field() !!}
                                                <input type="hidden" name="id" value="{{$value->id}}">
                                                <button class="status_{{$value->id}} btn {{ $value->active == '0'? 'btn-warning': 'btn-primary' }} btn-sm">{{ $value->active == '0'? '隱藏': '顯示' }}</button>
                                            </form>
                                        </td>
                                        <td class="col-md-3">{{$value->company}}</td>
                                        <td class="col-md-2"><img src="{{$value->img}}" style="max-width:100%;max-height: 100px;" /></td>
                                        <td class="col-md-2"><a target="_blank" href="{{$value->link}}"><i class="fa fa-cloud-download" style="font-size: 30px"></i></a></td>
                                        <td class="col-md-2">
                                            <small data-toggle="tooltip" data-placement="bottom" title="{{$value->updated_at->timezone('Asia/Taipei')->format('Y/m/d H:s')}}">{{ Date::make($value->updated_at)->diffForHumans() }}</small>
                                        </td>
                                        <td class="col-md-2">
                                            <form class="delete-partner inline" action="{{ route('partner-delete', $value->id) }}">
                                                {!! csrf_field() !!}
                                                <input type="hidden" name="company" value="{{$value->company}}">
                                                <input type="hidden" name="id" value="{{$value->id}}">
                                                <button class="btn btn-danger btn-sm"><i class="fa fa-ban"></i> 刪除 </button>
                                            </form>
                                            <a data-pjax href="{{ route('partner-edit', $value->id)}}" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> 修改 </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                            {!! $partner->setPath('')->render() !!}
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
            $('.partner-status').submit(function(e){
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
            $('.delete-partner').submit(function(e){
                e.preventDefault();
                var token = $( this ).find( 'input[name=_token]' ).val();
                var id = $( this ).find( 'input[name=id]' ).val();
                var company = $( this ).find( 'input[name=company]' ).val();
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
                                        'id':  id,
                                        'company': company
                                    },
                                    success: function(data){
                                        var status = data['status'];
                                        var msg = data['msg'];
                                        if(status == 'success')
                                        {
                                            swal("刪除", "公司："+company+" 已刪除", "success");
                                            $('.partner_'+id).remove();
                                        }
                                        else
                                        {
                                            swal.close();
                                            toastr.error(msg);
                                        }
                                    }
                                },'json');
                            } else {
                                swal("取消刪除", "您的職缺尚未被刪除：)", "error");
                            }
                        });
            });
        })
    </script>
@endsection