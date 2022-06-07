<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Ridhi Sidhi</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="<?= ADMIN_ASSETS ?>css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?= ADMIN_ASSETS ?>css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?= ADMIN_ASSETS ?>css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?= ADMIN_ASSETS ?>css/AdminLTE.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?= ADMIN_ASSETS ?>css/blue.css">

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition register-page">
        <div class="register-box">
            <div class="register-logo">
                <a><b>Ridhi</b> Sidhi</a>
            </div>

            <div class="register-box-body">
                <p class="login-box-msg">Want to Master</p>

                <form action="<?=ADMIN_PANEL_URL."login/register"?>" method="post">
                    <div class="form-group has-feedback">
                        <input type="text" name="name" class="form-control" placeholder="Full name" required="">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" name="mobile" class="form-control number" placeholder="Enter Mobile" required="">
                        <span class="glyphicon glyphicon-retweet form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="email" name="email" class="form-control" placeholder="Enter Email" required="">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" name="description" class="form-control" placeholder="Enter Description" required="">
                        <span class="glyphicon glyphicon-comment form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label>
                                    <a href="<?=ADMIN_PANEL_URL."login"?>" class="text-center">Login</a>
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.form-box -->
        </div>
        <!-- /.register-box -->

        <!-- jQuery 3 -->
        <script src="<?= ADMIN_ASSETS ?>js/jquery.min.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="<?= ADMIN_ASSETS ?>js/bootstrap.min.js"></script>
        <!-- iCheck -->
        <script src="<?= ADMIN_ASSETS ?>js/icheck.min.js"></script>
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' /* optional */
                });
            });
        </script>
    </body>
</html>
