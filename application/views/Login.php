<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login</title>
    <link rel="icon" href="<?php echo base_url() ?>build/images/Logo2.png" type="image/x-icon" />

    <link href="<?= base_url(); ?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= base_url(); ?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?= base_url(); ?>vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?= base_url(); ?>vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="<?= base_url(); ?>build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
    <div>
        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form action="<?= base_url('Login'); ?>" method="post">
                        <h1>Login Form</h1>
                        <div>
                            <?= $this->session->flashdata('message'); ?>
                            <input required="" type="text" name="username" class="form-control" placeholder="Username" value="<?= set_value('username'); ?>" autofocus>
                            <?= form_error('username', '<small class = "text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div>
                            <input type="password" class="form-control" placeholder="Password" required="" name="password" />
                            <?= form_error('password', '<small class = "text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div>
                            <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                            <div class="clearfix"></div>
                            <br />

                            <div>
                                <h1><i><img width="50px" src="<?= base_url("build/images/"); ?>Logo2.png" alt=""></i> Sahaduta Klinik</h1>
                                <p>©2019 All Rights Reserved</p>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</body>

</html>