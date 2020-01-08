<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta http-equiv="Content-Language" content="en"/>
    <meta name="msapplication-TileColor" content="#206bc4"/>
    <meta name="theme-color" content="#206bc4"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="mobile-web-app-capable" content="yes"/>
    <meta name="HandheldFriendly" content="True"/>
    <meta name="MobileOptimized" content="320"/>
    <meta name="robots" content="noindex,nofollow,noarchive"/>
    <link rel="icon" href="./favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon"/>
    <title>Login</title>

    <link href="<?= base_url('assets/admin/libs/jqvmap/dist/jqvmap.min.css') ?>" rel="stylesheet"/>
    <link href="<?= base_url('assets/admin/libs/selectize/dist/css/selectize.css') ?>" rel="stylesheet"/>
    <link href="<?= base_url('assets/admin/libs/fullcalendar/core/main.min.css') ?>" rel="stylesheet"/>
    <link href="<?= base_url('assets/admin/libs/fullcalendar/daygrid/main.min.css') ?>" rel="stylesheet"/>
    <link href="<?= base_url('assets/admin/libs/fullcalendar/timegrid/main.min.css') ?>" rel="stylesheet"/>
    <link href="<?= base_url('assets/admin/libs/fullcalendar/list/main.min.css') ?>" rel="stylesheet"/>
    <link href="<?= base_url('assets/admin/css/tabler.min.css') ?>" rel="stylesheet"/>
    <link href="<?= base_url('assets/admin/css/tabler-flags.min.css') ?>" rel="stylesheet"/>
    <link href="<?= base_url('assets/admin/css/tabler-payments.min.css') ?>" rel="stylesheet" />

    <link href="<?= base_url('assets/admin/css/app.css') ?>" rel="stylesheet" />
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" crossorigin="anonymous"></script>
    
    <script type="text/javascript" src="<?= base_url('assets/admin/js/app.js') ?>"></script>
</head>
<body class="antialiased border-top-wide border-primary">
    <div class="d-flex h-auto min-h-full justify-content-center">
        <div class="d-flex align-items-center justify-content-center flex-fill">
            <div class="container">
                <div class="row">
                    <div class="col col-login mx-auto">
                        <div class="text-center mb-4 mt-4">
                            <img src="<?= base_url('assets/admin/img/logo-black.png') ?>" class="" alt="">
                        </div>
                        <form class="card" action="<?= route('admin.check_login') ?>" id="login_form" method="post">
                            <div class="card-body p-6">
                                <div class="card-title">Login to your account</div>
                                <div class="mb-2 form-group">
                                    <label class="form-label">Email address</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                    placeholder="Enter email" autocomplete="off">
                                </div>
                                <div class="mb-2 form-group">
                                    <a href="./forgot-password.html" class="float-right small">I forgot password</a>
                                    <label class="form-label">
                                        Password
                                    </label>
                                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" autocomplete="off">
                                </div>
                                <!-- <div class="mb-2">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" ./>
                                        <span class="custom-control-label">Remember me</span>
                                    </label>
                                </div> -->
                                <div class="form-footer">
                                    <button type="submit" class="btn btn-submit btn-primary btn-block">Sign in</button>
                                </div>
                            </div>
                        </form>
                        <div class="text-center text-muted">
                            Don't have account yet? <a href="./register.html">Sign up</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/admin/js/tabler.min.js') ?>"></script>
</body>
<script type="text/javascript">
    $("#login_form").submit(function(){
        $this = $(this);
        $.ajax({
            url:$this.attr("action"),
            type:'POST',
            dataType:'json',
            data:$this.serialize(),
            beforeSend:function(){ $this.find('.btn-submit').btn("loading"); },
            complete:function(){ $this.find('.btn-submit').btn("reset"); },
            success:function(json){
                json_callback(json,$this);
            },
        })
        return false;
    })
</script>
</html>