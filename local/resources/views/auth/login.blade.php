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
    <title>就業博覽會 | 登入</title>
</head>
<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">Career Fair</h1>

            </div>
            <h3>歡迎來到就業博覽會管理系統</h3>
            <p>管理每年國立臺北大學職涯發展中心所舉辦的就業博覽會
            </p>
            <p>登入</p>

            <form class="m-t" method="POST" action="/career/auth/login">
                {!! csrf_field() !!}
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="帳號" required="" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" id="password" placeholder="密碼" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
                <div>
                  <input type="checkbox" name="remember"> 記住我的帳號密碼</input>
                </div>
                {{--<a href="#"><small>忘記密碼？</small></a>--}}
                <p class="text-muted text-center"><small>沒有帳號嗎?請洽</small></p>
                <?php //<!-- <a class="btn btn-sm btn-white btn-block" href="/career/auth/register">創建一個帳號</a>--> ?>
            </form>
            <p class="m-t"> <small>版權所有 國立臺北大學職涯發展中心 &copy; Abel | 2015 就業博覽會管理系統</small> </p>
        </div>
    </div>
</body>
</html>