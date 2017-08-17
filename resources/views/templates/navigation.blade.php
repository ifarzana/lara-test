<?php
$navigation = \App\Helpers\NavigationManagerHelper::getNavigation(true, true);
?>

<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                </div>
                <div class="logo-element">
                </div>
            </li>

            <?php $count = 0 ?>
            <?php foreach ($navigation as $navigation_menu): ?>

                <li <?php if($navigation_menu['active']) { echo 'class="active"'; } ?>>
                    <a href="<?php echo '/' . $navigation_menu['route']; ?>">
                        <i class="<?php echo $navigation_menu['icon']; ?>"></i>
                        <span class="nav-label"><?php echo $navigation_menu['title']; ?></span>
                    </a>
                </li>

            <?php $count++ ?>
            <?php endforeach ?>

        </ul>

    </div>
</nav>

<div id="page-wrapper" class="gray-bg">

    @include('templates.topbar')

    <div id="content">
        @include('templates.modal-message')
        @include('templates.message')
    </div>

    @yield('content')

    @include('templates.footer')

</div>

@include('templates.right-sidebar')
