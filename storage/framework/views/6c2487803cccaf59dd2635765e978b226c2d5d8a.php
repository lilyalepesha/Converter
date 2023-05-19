<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Authentication Links -->

        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                <?php echo e(Auth::user()->name); ?>

            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    Выйти
                </a>

                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="GET" style="display: none;">
                    <?php echo csrf_field(); ?>
                </form>
            </div>
        </li>
        <?php if(auth()->guard()->check()): ?>
            <?php if(\Illuminate\Support\Facades\Auth::user()->avatar): ?>
                <img class="avatar" width="40px" height="40px" src="<?php echo e(asset('storage/avatar/' .
            \Illuminate\Support\Facades\Auth::id() . '/' . auth()->user()->avatar)); ?>" alt="Avatar">
            <?php else: ?>
                <span>Загрузите изображение</span>
            <?php endif; ?>
        <?php endif; ?>
    </ul>
</nav>
<!-- /.navbar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="sidebar">
        <ul class="nav nav-pills nav-sidebar flex-column pt-3">
            <li class="nav-item">
                <a href="<?php echo e(route('users.user.index')); ?>" class="nav-link">
                    <i class="nav-icon fa-light fa-user"></i>
                    <p>
                        Пользователи
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo e(route('images.index')); ?>" class="nav-link">
                    <i class="nav-icon fa-regular fa-user"></i>
                    <p>
                        Изображения
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo e(route("zips.index")); ?>" class="nav-link">
                    <i class="nav-icon fa-regular fa-user"></i>
                    <p>
                        Zip архивы
                    </p>
                </a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar -->
</aside>
<?php /**PATH D:\OSPANEL\OSPanel\domains\UploadFileMainProject\UploadFile\resources\views/admin/includes/sidebar.blade.php ENDPATH**/ ?>