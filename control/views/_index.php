<?php $this->printPageBlock('header', CNTRL_DIR_TPL_BLOCKS); ?>
<header class="header">
    <a href="/control/" class="logo">
        Advokat <small>v1.0</small>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                        <span><?= $userData['user_surname'] . ' ' . $userData['user_name'] ?> <i class="caret"></i></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header bg-light-blue">
                            <img src="<?= CNTRL_IMG_AVATAR . $userData['user_avatar'] ?>" class="img-circle" alt="User Image" />
                            <p>
                                <?= $userData['user_surname'] . ' ' . $userData['user_name'] ?> - <?= $userData['type_role'] ?>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="/control/profile/" class="btn btn-default btn-flat"><?=$this->getLang(CTRL_PROFILE)?></a>
                            </div>
                            <div class="pull-right">
                                <a href="/control/auth/logout" class="btn btn-default btn-flat"><?=$this->getLang(CTRL_EXIT)?></a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <aside class="left-side sidebar-offcanvas">
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?= CNTRL_IMG_AVATAR . $userData['user_avatar'] ?>" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p><?= $this->getLang(CTRL_HELLO) ?>, <?= $userData['user_name'] ?></p>

                    <a href="#"><i class="fa fa-circle text-success"></i><?=$this->getLang(CTRL_ONLINE)?></a>
                </div>
            </div>
            <ul class="sidebar-menu">
                <?php
                if (!empty($menuControl)) {
                    foreach ($menuControl as $valueMenu) {
                        if ($valueMenu['t_controller'] != '') {
                            $uriMenu = '/control/' . $valueMenu['t_controller'] . '/' . $valueMenu['t_action'];
                        } else {
                            $uriMenu = '/control/datatable/?tbl=' . $valueMenu['t_name'];
                        }

                        if ($valueMenu['t_table_link'] == '') {
                            echo '<li><a href="' . $uriMenu . '"><i class="fa ' . $valueMenu['t_icon'] . '"></i>' . $valueMenu['t_title'] . '</a></li>';
                        } else {

                            $linlTbl = '';
                            foreach ($linkTableArr as $valueLinkTable) {

                                if ($valueLinkTable['t_controller'] != '') {
                                    $subUriMenu = '/control/' . $valueLinkTable ['t_controller'] . '/' . $valueLinkTable ['t_action'];
                                } else {
                                    $subUriMenu = '/control/datatable/?tbl=' . $valueLinkTable['t_name'];
                                }
                                $linlTbl .= '<li><a href="' . $subUriMenu . '"><i class="fa ' . $valueLinkTable['t_icon'] . '"></i>' . $valueLinkTable['t_title'] . '</a></li>';
                            }

                            echo'   
                            <li class=" treeview">
                                <a href="#">
                                  <i class="fa ' . $valueMenu ['t_icon'] . '"></i> <span>' . $valueMenu['t_title'] . '</span> <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                  <li class=""><a href="' . $uriMenu . '"><i class="fa ' . $valueMenu['t_icon'] . '"></i>' . $valueMenu['t_title'] . '</a></li>
                                 ' . $linlTbl . '
                                </ul>
                            </li>
                            ';
                        }
                    }
                }
                ?>

            </ul>
        </section>
    </aside>
    <aside class="right-side">
        <section class="content-header">
            <h1>
                <?=$this->getLang(CTRL_PANEL)?>
            </h1>
        </section>

        <section class="content">

            <? $this->getPageContent(); ?>

        </section>
    </aside>
</div>
<div id='alertBlock'></div>
<? $this->printPageBlock('footer', CNTRL_DIR_TPL_BLOCKS) ?>
