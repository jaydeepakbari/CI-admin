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
</head>
<body class="antialiased border-top-wide border-primary">
    <div class="d-flex h-auto min-h-full justify-content-center">
        <div class="d-flex align-items-center justify-content-center flex-fill">
            <div class="container">
                <div class="row">
                    <div class="col col-login mx-auto">
                        <div class="text-center mb-4">
                            <img src="<?= base_url('assets/admin') ?>/static/logo.svg" class="h-8" alt="">
                        </div>
                        <form class="card" action="" method="get">
                            <div class="card-body p-6">
                                <div class="card-title">Login to your account</div>
                                <div class="mb-2">
                                    <label class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                    placeholder="Enter email" autocomplete="off">
                                </div>
                                <div class="mb-2">
                                    <a href="./forgot-password.html" class="float-right small">I forgot password</a>
                                    <label class="form-label">
                                        Password
                                    </label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" autocomplete="off">
                                </div>
                                <div class="mb-2">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" ./>
                                        <span class="custom-control-label">Remember me</span>
                                    </label>
                                </div>
                                <div class="form-footer">
                                    <button type="submit" class="btn btn-primary btn-block">Sign in</button>
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

    <script src="<?= base_url('assets/admin/libs/jquery/dist/jquery.slim.min.js') ?>"></script>
    <script src="<?= base_url('assets/admin/libs/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/admin/js/tabler.min.js') ?>"></script>
</body>
</html>