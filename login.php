<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Admin Log in</title>
        
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        
        <link rel="stylesheet" href="<?= ADMIN_ASSETS ?>css/bootstrap.min.css">
        
        <link rel="stylesheet" href="<?= ADMIN_ASSETS ?>css/font-awesome.min.css">
     
        <link rel="stylesheet" href="<?= ADMIN_ASSETS ?>css/ionicons.min.css">
        
        <link rel="stylesheet" href="<?= ADMIN_ASSETS ?>css/AdminLTE.min.css">
        
        <link rel="stylesheet" href="<?= ADMIN_ASSETS ?>css/blue.css">
        
        <style>
            
            .login-page{
                background-image: url('<?= base_url() ?>uploads/landing-users.png');
                
                -webkit-animation: 30s linear 0s normal none infinite animate;
                -moz-animation: 30s linear 0s normal none infinite animate;
                -ms-animation: 30s linear 0s normal none infinite animate;
                -o-animation: 30s linear 0s normal none infinite animate;
                animation: 30s linear 0s normal none infinite animate;

            } 

            @-webkit-keyframes animate {
                from {background-position:0 0;}
                to {background-position: 1000px 0;}
            }

            @-moz-keyframes animate {
                from {background-position:0 0;}
                to {background-position: 1000px 0;}
            }

            @-ms-keyframes animate {
                from {background-position:0 0;}
                to {background-position: 1000px 0;}
            }

            @-o-keyframes animate {
                from {background-position:0 0;}
                to {background-position: 1000px 0;}
            }

            @keyframes animate {
                from {background-position:0 0;}
                to {background-position: 1000px 0;}
            }
        </style>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a><?= PROJECT_NAME ?></a>
            </div>
           
            <div class="login-box-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form id="login" action="<?= ADMIN_PANEL_URL . "login/index" ?>" method="post">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" required="" name="email" placeholder="Enter Username">
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" required="" name="password" placeholder="Enter Password">
                    </div>
                    <div class="row">
                        <div class="col-xs-8 hide">
                            <div class="checkbox icheck">
                                <label>
                                    <a data-toggle="modal" href="#myModal"> Forgot Password?</a>
                                </label>
                            </div>
                        </div>
                        
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                        </div>
                        
                    </div>
                </form>
                
            </div>
            
        </div>
      

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                        <h4 class="modal-title">Forgot Password ?</h4>
                    </div>
                    <div class="modal-body">
                        <span id="validate_message"></span>
                        <p>Enter your e-mail address below to reset your password.</p>
                        <input type="text" class="form-control placeholder-no-fix" autocomplete="off" placeholder="Email" name="email" id="f_email">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success submit_form">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
   
    <script src="<?= ADMIN_ASSETS ?>js/jquery.min.js"></script>
 
    <script src="<?= ADMIN_ASSETS ?>js/bootstrap.min.js"></script>

    <script src="<?= ADMIN_ASSETS ?>js/icheck.min.js"></script>
    <script src="<?= ADMIN_ASSETS ?>js/sweetalert.min.js"></script>
    <script>
<?php
if ($prompt) {
    ?>
            swal("<?= ucfirst($prompt['type']) . "..!" ?>", "<?= $prompt['message'] ?>", "<?= $prompt['type'] ?>");
    <?php
}
?>

        $(".submit_form").click(function () {
            let email = $("#f_email").val();
            if (email == "") {
                swal("warning", "Enter Email", "warning");
                return false;
            }
            $.ajax({
                url: "<?= ADMIN_PANEL_URL . "login/request_reset_password" ?>",
                method: 'post',
                dataType: 'json',
                data: {
                    email: email
                },
                success: function (data) {
                    switch (data.data) {
                        case 1:
                            swal("warning", "Email Does Not Exist", "warning");
                            break;
                        case 2:
                            swal("warning", "Already submitted request..!", "warning");
                            break;
                        case 3:
                            swal("success", "Request Submitted ..!", "success");
                            window.location.reload();
                            break;
                        default:

                            break;
                    }
                }
            });

        });
    </script>
</html>
