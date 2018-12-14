<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Mainly css -->
    <link href="{{ asset('assets/auth/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/auth/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/auth/css/style.css') }}" rel="stylesheet">
    <title>就業博覽會 | 註冊</title>
</head>
<body class="gray-bg">


    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">Career Fair</h1>

            </div>
            <h3>註冊帳號</h3>
            <p>立即註冊來操作管理系統
            </p>
            <form method="POST" action="/career/auth/register">
                {!! csrf_field() !!}
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="姓名（暱稱）" required="" name="name" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Email" required="" name="email" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="密碼" required="" name="password">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="確認密碼" required="" name="password_confirmation">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">註冊</button>
            </form>
            <p class="m-t"> <small>版權所有 國立臺北大學職涯發展中心 &copy; Abel | 2015 就業博覽會管理系統</small> </p>
        </div>
    </div>
</body>
</html>