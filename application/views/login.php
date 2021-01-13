<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN ADMIN</title>
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/custom/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/custom/font.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/custom/style.css">
</head>
<body>
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="<?= base_url(); ?>images/user.png"  alt="User Icon" width="100" height="100" style="margin-top : 20px;" />
    </div>
<p><?php echo $this->session->flashdata('msg_login'); ?></p>
    <!-- Login Form -->
    <form style="margin-top : 20px;" action="<?php echo base_url('auth/process'); ?>" method="POST">
      <input type="text" id="login" class="fadeIn second" name="username" placeholder="USERNAME" autocomplete="off">
      <input type="password" id="password" class="fadeIn third" name="password" placeholder="PASSWORD">
      <input type="submit" name="login"  class="fadeIn fourth" value="Log In">
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="#">@Copyright 2020 Ilham Muhammad Prasetyo</a>
    </div>

  </div>
</div>
  
</body>
 <!-- jQuery -->
  <script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>assets/dist/js/adminlte.min.js"></script>
</html>