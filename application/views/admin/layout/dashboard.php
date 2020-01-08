<!doctype html>
<html lang="en">
<head>
    <title><?= isset($meta_title) ? $meta_title : '' ?></title>

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

    <link rel="icon" href="./favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon"/>

    <link href="<?= base_url('assets/admin/css/tabler.min.css') ?>" rel="stylesheet"/>
   
    <link href="<?= base_url('assets/admin/css/app.css') ?>" rel="stylesheet" />

    
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="<?= base_url('assets/admin/js/app.js') ?>"></script>
</head>
<body class="antialiased">
    <div class="wrapper">
        <aside class="sidebar sidebar-dark">

            <a href="<?= route('admin.dashboard') ?>" class="sidebar-brand">
                <img src="<?= base_url('assets/admin/img/logo.png') ?>" alt="Tabler" class="sidebar-brand-logo sidebar-brand-logo-lg">
                <img src="<?= base_url('assets/admin') ?>/static/logo-small.svg" alt="Tabler" class="sidebar-brand-logo sidebar-brand-logo-sm">
            </a>
            <div class="sidebar-content">
                <div>
                    <ul class="sidebar-nav">
                        <li class="sidebar-nav-title">Navigation</li>
                        <li class="sidebar-nav-item">
                            <a href="<?= route('admin.dashboard') ?>" class="sidebar-nav-link" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon nav-icon"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                <span class="nav-text">Dashboard</span>
                                <span class="badge bg-blue"></span>
                            </a>
                        </li>


                        <li class="sidebar-nav-item">
                            <a  class="sidebar-nav-link" data-toggle="collapse" data-target="#sidebar-menu-user">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon nav-icon"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                <span class="nav-text">Users</span>
                                <span class="sidebar-nav-arrow"></span>
                            </a>
                            <ul class="sidebar-subnav collapse" id="sidebar-menu-user">
                                <li class="sidebar-nav-item">
                                    <a  class="sidebar-nav-link" href="<?= route('admin.user.list') ?>">
                                        <span>List</span>
                                    </a>
                                </li>
                                <li class="sidebar-nav-item">
                                    <a  class="sidebar-nav-link" href="<?= route('admin.user.edit_form') ?>">
                                        <span>Create New</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="mt-auto">
                    <a href="<?= route('admin.logout') ?>" class="btn btn-primary btn-block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                        Logout
                    </a>
                </div>
            </div>
        </aside>
        <div class="content">
            <header class="topnav topbar">
                <div class="container-">
                    <div class="navbar navbar-expand-lg navbar-light">
                        <div class="navbar-search d-none d-xl-block">
                            <form action="." method="get">
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Search&hellip;">
                                </div>
                            </form>
                        </div>
                        <ul class="nav navbar-menu align-items-center ml-auto">
                            <li class="nav-item d-none d-lg-flex mr-3">
                                <a href="https://github.com/jaydeepakbari/Codeigniter-Admin-Panel" class="btn btn-sm btn-success" target="_blank">Source code</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="#" data-toggle="dropdown"
                                class="nav-link d-flex align-items-center py-0 px-lg-0 px-2 text-reset ml-2">
                                <span class="avatar avatar-sm" style="background-image: url(<?= base_url('assets/admin') ?>/static/avatars/004f.jpg)"></span>
                                <span class="ml-2 d-none d-lg-block lh-1">
                                    <?= Auth::user()->name ?>
                                    <span class="text-muted d-block mt-1 text-h6">Administrator</span>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon dropdown-icon"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon dropdown-icon"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon dropdown-icon"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                    Inbox
                                    <span class="badge bg-primary ml-auto">6</span>
                                </a>
                                <a class="dropdown-item" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon dropdown-icon"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                                    Message
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon dropdown-icon"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12" y2="17"></line></svg>
                                    Need help?
                                </a>
                                <a class="dropdown-item" href="<?= route('admin.logout') ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon dropdown-icon"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                    Sign out
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
        <div class="content-page">
            <main class="container my-4 flex-fill">

                <?php echo $content; ?>
            </main>
        </div>
    </div>
</div>


<script src="<?= base_url('assets/admin/js/tabler.min.js') ?>"></script>
</body>
</html>