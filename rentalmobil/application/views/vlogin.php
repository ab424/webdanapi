<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login Admin</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>public/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>public/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url(); ?>public/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo base_url(); ?>public/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <!-- <link href="<?php echo base_url(); ?>public/build/css/custom.min.css" rel="stylesheet"> -->
    <link href="<?php echo base_url(); ?>public/build/css/custom.css" rel="stylesheet">
</head>

<body class="login">
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>

        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form action="<?php echo base_url(); ?>clogin/auth" method="post">
                        <h1>Halaman Login Admin</h1>
                        <div>
                            <input class="form-control" placeholder="Username" name="username" type="text" required="">
                        </div>
                        <div>
                            <input class="form-control" placeholder="Password" name="password" type="password" required="">
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary submit">Sign in</button>
                            <!-- <a class="btn btn-default submit" href="index.html">Log in</a> -->
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                            <p class="change_link">Ke Halaman
                                <a href="#signup" class="to_register"> Login Staff </a>
                            </p>

                            <div class="clearfix"></div>
                            <br />

                            <div>
                                <h1><i class="far fa-tshirt"></i> Sewa Baju Adat</h1>
                                <p>©2023 All Rights Reserved. Mira Penyewaan. Privacy and Terms</p>
                            </div>
                        </div>
                    </form>
                </section>
            </div>

            <div id="register" class="animate form registration_form">
                <section class="login_content">
                    <form action="<?php echo base_url(); ?>clogin/authrental" method="post">
                        <h1>Halaman Login Staff</h1>
                        <div>
                            <input class="form-control" placeholder="Nomor Handphone" name="username" type="text" required="">
                        </div>
                        <div>
                            <input class="form-control" placeholder="Password" name="password" type="password" required="">
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary submit">Sign in</button>
                            <!-- <a class="btn btn-default submit" href="index.html">Log in</a> -->
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                            <p class="change_link">Ke Halaman
                                <a href="#signin" class="to_register"> Login Administrator </a>
                            </p>

                            <div class="clearfix"></div>
                            <br />

                            <div>
                                <h1><i class="far fa-tshirt"></i> Sewa Baju Adat</h1>
                                <p>©2023 All Rights Reserved. Mira Penyewaan. Privacy and Terms</p>
                            </div>
                        </div>
                    </form>
                </section>
            </div>

        </div>
    </div>
</body>

</html>