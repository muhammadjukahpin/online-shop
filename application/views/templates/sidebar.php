<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <i class="fas fa-store-alt"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Keyz Clothing</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider ">

    <?php foreach ($menu as $m) : ?>
        <!-- Heading -->
        <div class="sidebar-heading">
            <?= $m['menu']; ?>
        </div>

        <?php
            $menuID = $m['menu_id'];
            $querySubMenu = " SELECT *
                              FROM `user_sub_menu` JOIN `user_menu`
                                ON `user_sub_menu`.`menu_id` = `user_menu`.`menu_id`
                             WHERE `user_sub_menu`.`menu_id` = $menuID
                               AND `user_sub_menu`.`is_active` = 1
                          ";
            $sub_menu = $this->db->query($querySubMenu)->result_array();

            ?>

        <?php foreach ($sub_menu as $sm) : ?>
            <!-- Nav Item  -->
            <?php if ($sm['title'] == $title) : ?>
                <li class="nav-item active">
                <?php else : ?>
                <li class="nav-item ">
                <?php endif; ?>

                <a class="nav-link pb-0" href="<?= base_url() . $sm['url']; ?>">
                    <i class="<?= $sm['icon']; ?>"></i>
                    <span><?= $sm['title']; ?></span></a>
                </li>
            <?php endforeach; ?>

            <!-- Divider -->
            <hr class="sidebar-divider mt-2">

        <?php endforeach; ?>



        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('auth/logout'); ?>">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>Logout</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

</ul>
<!-- End of Sidebar -->