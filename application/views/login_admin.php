<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in - Voler Admin Dashboard</title>
    <link rel="stylesheet" href="<?= base_url() ?>assets/custom/css/bootstrap.css">
    
    <link rel="shortcut icon" href="<?= base_url() ?>assets/custom/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="<?= base_url() ?>assets/custom/css/app.css">
</head>

<body>
    <div id="auth">
        
<div class="container">
    <div class="row">
        <div class="col-md-5 col-sm-12 mx-auto">
            <div class="card pt-4">
                <div class="card-body">
                    <div class="text-center mb-5">
                        <img src="<?= base_url() ?>assets/custom/images/favicon.svg" height="48" class='mb-4'>
                        <h3>Sign In</h3>
                        <p>Please sign in to continue <b>Dashboard</b>.</p>
                        <p><?php echo $this->session->flashdata('msg_login'); ?></p>
                    </div>
                    <form  action="<?php echo base_url('auth/process'); ?>" method="POST">
                        <div class="form-group position-relative has-icon-left">
                            <label for="username">Username</label>
                            <div class="position-relative">
                                <input type="text" class="form-control" name="username" id="username" autocomplete="off" placeholder="Fill Up With Your Username">
                                <div class="form-control-icon">
                                    <i data-feather="user"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left">
                            <div class="clearfix">
                                <label for="password">Password</label>
                            </div>
                            <div class="position-relative">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Fill Up With Your Password">
                                <div class="form-control-icon">
                                    <i data-feather="lock"></i>
                                </div>
                            </div>
                        </div>

                        <div class='form-check clearfix my-4'>
                            
                            <div class="float-right">
                                <a href="auth-register.html">Don't have an account?</a>
                            </div>
                        </div>
                        <div class="clearfix">
                            <input type="submit" name="login" class="btn btn-primary float-right" value="Masuk">
                        </div>
                    </form>
                   <!--  <div class="divider">
                        <div class="divider-text">OR</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <button class="btn btn-block mb-2 btn-primary"><i data-feather="facebook"></i> Facebook</button>
                        </div>
                        <div class="col-sm-6">
                            <button class="btn btn-block mb-2 btn-secondary"><i data-feather="github"></i> Github</button>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>

    </div>
    <script src="<?= base_url() ?>assets/custom/js/feather-icons/feather.min.js"></script>
    <script src="<?= base_url() ?>assets/custom/js/app.js"></script>
    
    <script src="<?= base_url() ?>assets/custom/js/main.js"></script>
</body>

</html>
