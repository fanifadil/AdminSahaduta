<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <?php if($user['foto'] == "") : ?>
                            <img src="<?= base_url('build/foto/thumb/icon.jpg'); ?>" alt=""><?= $user['nama_pegawai']; ?>
                            <span class=" fa fa-angle-down"></span>
                        <?php else : ?>
                        <img src="<?= base_url('build/foto/thumb/'.$user['foto']); ?>" alt=""><?= $user['nama_pegawai']; ?>    
                        <span class=" fa fa-angle-down"></span>
                    <?php endif; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="<?= base_url('password'); ?>">Ganti Password</a></li>
                        <li><a href="<?= base_url('login/logout'); ?>"><i class=" fa fa-sign-out pull-right"></i> Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>