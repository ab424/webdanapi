<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <?php if ($_SESSION['role'] == "rental") { ?>
        <div class="menu_section">
            <ul class="nav side-menu">
                <h3>Transaksi</h3>
                <li class="<?php echo ($this->uri->segment(1) == 'transaksi') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>transaksi"><i class="fa fa-upload"></i> Transaksi &nbsp;&nbsp;
                        <small class='badge badge-danger counts'></small></a></li>
                <li class="<?php echo ($this->uri->segment(1) == 'transaksiproses') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>transaksiproses"><i class="fa fa-history"></i> Proses Peminjaman &nbsp;&nbsp;
                        <small class='badge badge-danger countsother'></small></a></li>
                <li class="<?php echo ($this->uri->segment(1) == 'transaksibatal') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>transaksibatal"><i class="fa fa-reply"></i> Transaksi Dibatalkan </a></li>
                <!-- <li class="<?php echo ($this->uri->segment(1) == 'transaksiselesai') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>transaksiselesai"><i class="fa fa-check"></i> Transaksi Selesai </a></li> -->
                <li class="<?php echo ($this->uri->segment(1) == 'transaksiselesairental') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>transaksiselesairental"><i class="fa fa-check"></i> Transaksi Selesai </a></li>
            </ul>
        </div>
        <div class="menu_section">
            <ul class="nav side-menu">
                <h3>Menu</h3>
                <li class="<?php echo ($this->uri->segment(1) == 'mobilrental') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>mobilrental"><i class="fa fa-automobile"></i> Baju Adat </a></li>
            </ul>
        </div>
    <?php } else { ?>
        <div class="menu_section">
            <ul class="nav side-menu">
                <h3>Umum</h3>
                <li class="<?php echo ($this->uri->segment(1) == 'chome') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>chome"><i class="fa fa-home"></i> Home </a></li>
                <li class="<?php echo ($this->uri->segment(1) == 'rental') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>rental"><i class="fa fa-bank"></i> Staff </a></li>
                <li class="<?php echo ($this->uri->segment(1) == 'mobil') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>mobil"><i class="fa fa-folder" aria-hidden="true"></i> Baju Adat </a></li>
            </ul>
        </div>



        <div class="menu_section">
            <ul class="nav side-menu">
                <h3>User</h3>
                <li class="<?php echo ($this->uri->segment(1) == 'user') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>user"><i class="fa fa-user"></i> User </a></li>
                <li class="<?php echo ($this->uri->segment(1) == 'mendaftar') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>mendaftar"><i class="fa fa-user-md"></i> User Mendaftar &nbsp;&nbsp;
                        <small class='badge badge-danger count_user'></small></a></li>
            </ul>
        </div>
    <?php } ?>
</div>

</div>
<!-- /sidebar menu -->

<!-- sidebar menu -->


<!-- /menu footer buttons -->
<div class="sidebar-footer hidden-small" style="visibility: hidden;">
    <a data-toggle="tooltip" data-placement="top" title="Settings">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Lock">
        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
    </a>
</div>
<!-- /menu footer buttons -->
</div>
</div>

<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
            <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo base_url(); ?>public/images/user.png" alt="">
                        <?php
                        if ($_SESSION['role'] == "rental") {
                            echo "Staff";
                        } else {
                            echo "Administrator";
                        }
                        ?>

                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?php echo base_url(); ?>clogin/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                    </div>
                </li>

                <!-- <li role="presentation" class="nav-item dropdown open">
                    <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-envelope-o"></i>
                        <span class="badge bg-green">6</span>
                    </a>
                    <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                        <li class="nav-item">
                            <a class="dropdown-item">
                                <span class="image"><img src="<?php echo base_url(); ?>public/images/user.png" alt="Profile Image" /></span>
                                <span>
                                    <span>John Smith</span>
                                    <span class="time">3 mins ago</span>
                                </span>
                                <span class="message">
                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="dropdown-item">
                                <span class="image"><img src="<?php echo base_url(); ?>public/images/img.jpg" alt="Profile Image" /></span>
                                <span>
                                    <span>John Smith</span>
                                    <span class="time">3 mins ago</span>
                                </span>
                                <span class="message">
                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="dropdown-item">
                                <span class="image"><img src="<?php echo base_url(); ?>public/images/img.jpg" alt="Profile Image" /></span>
                                <span>
                                    <span>John Smith</span>
                                    <span class="time">3 mins ago</span>
                                </span>
                                <span class="message">
                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="dropdown-item">
                                <span class="image"><img src="<?php echo base_url(); ?>public/images/img.jpg" alt="Profile Image" /></span>
                                <span>
                                    <span>John Smith</span>
                                    <span class="time">3 mins ago</span>
                                </span>
                                <span class="message">
                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <div class="text-center">
                                <a class="dropdown-item">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li> -->
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->