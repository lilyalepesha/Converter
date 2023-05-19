<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo e(asset('/dist/css/app/app.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('fonts/stylesheet.css')); ?>">
    <script src="<?php echo e(asset('/dist/js/libs/appLibs.js')); ?>" defer></script>
    <script src="<?php echo e(asset('/dist/js/app/app.js')); ?>" defer></script>
</head>
<body class="body__index noscroll">
    <div class="preloader" id="preloader">
        <div class="custom-loader"></div>
    </div>
    <div class="wrapper">
        <header>
            <div class="container container_header">
                <div class="header_logo">
                    <img src="<?php echo e(asset('/images/logo-uploadfile.png')); ?>" alt="logo" height="70px">
                </div>
                <nav class="buttons__account">
                    <?php if(auth()->guard()->guest()): ?>
                    <ul class="buttons__guest">
                        <li>
                            <button class="button__login" type="button">
                                <a href="<?php echo e(route('login.index')); ?>">Войти</a>
                            </button>
                        </li>
                        <li>
                            <button class="button__register-profile" type="button">
                                <a href="<?php echo e(route('register.index')); ?>">Регистрация</a>
                            </button>
                        </li>
                    </ul>
                    <?php endif; ?>
                    <?php if(auth()->guard()->check()): ?>
                    <ul class="user__list">
                        <li class="user__List_item">
                            <?php echo $__env->make('layouts.avatar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </li>
                        <ul class="user__List_dropdown-item">
                            <li>
                                <a href="<?php echo e(route('profile.index')); ?>">Профиль</a>
                            </li>
                            <li>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('isAdmin')): ?>
                                    <a href="<?php echo e(route('admin.index')); ?>">Админка</a>
                                <?php endif; ?>
                            </li>
                            <li>
                                <form action="<?php echo e(route('logout')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button class="button__register-profile" type="submit">Выйти</button>
                                </form>
                            </li>
                        </ul>
                    </ul>
                    <?php endif; ?>
                </nav>
                <div class="hamb__field" id="hamb">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </div>
            <div class="popup" id="popup"></div>
        </header>
        <div class="content">
            <div class="main-header">
                <div class="layers">
                    <div class="layer__header">
                        <div class="layers__caption"><p>Самый быстрый конвертер</p></div>
                        <div class="layers__title">uploadfile</div>
                    </div>
                    <div class="layer layers__base"
                        style="background-image: url(<?php echo e(asset('images/layer-base.png')); ?>)"></div>
                    <div class="layer layers__middle"
                        style="background-image: url(<?php echo e(asset('images/layer-middle.png')); ?>)"></div>
                    <div class="layer layers__front"
                        style="background-image: url(<?php echo e(asset('images/layer-front.png')); ?>)"></div>
                </div>
            </div>
            <div class="main-article" style="background-image: url(<?php echo e(asset('images/dungeon.jpg')); ?>)">
                <div class="main_block_article">
                    <div class="main-article__content">
                        <?php if(auth()->guard()->guest()): ?>
                            <h2 class="main-article__header">Пройдите регистрацию</h2>
                            <p class="main-article__paragraph">
                                <a href="<?php echo e(route('register.index')); ?>">Зарегистрируйтесь</a> или <a
                                    href="<?php echo e(route('login.index')); ?>">войдите</a> в личный кабинет, таким образом Вы сможете
                                использовать конвертер
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if(auth()->guard()->check()): ?>
                    <form class="hero__form" method="POST" enctype="multipart/form-data"
                        action="<?php echo e(route('service.store')); ?>">
                        <h2 class="main-article__header_show">Онлайн конвертер</h2>
                        <div class="hero_block">
                            <div class="one_block_hero">
                                <?php echo csrf_field(); ?>
                                <label class="hero__label" for="image">
                                    <span class="hero__text">Добавьте изображение</span>
                                    <input class="image_input none" type='file' multiple name="image[]" id="image">
                                    <div class="choose hero__input add_hero">
                                        <p class="title_choose">Выберите файл</p>
                                    </div>
                                    <?php $__errorArgs = ['image.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="error"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="error"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </label>
                                <label class="hero__label" for="width">
                                    <span class="hero__text">Введите ширину изображения</span>
                                    <input class="hero__input" value="<?php echo e(old('width')); ?>" type="text" name="width"
                                        placeholder="Ширина">
                                    <?php $__errorArgs = ['width'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="error"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </label>
                            </div>
                            <div class="two_block_hero">
                                <label class="hero__label">
                                    <span class="hero__text">Введите формат изображения</span>
                                    <div class="select__input">
                                        <div class="input_block_select" id="input_block_select">
                                            <input class="value_select" type="hidden" name="extension">
                                            <div class="info_block_select" id="info_block_line">Выберете формат</div>
                                            <svg class="line" id="select_line_low" width="14" height="8" viewBox="0 0 14 8"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1 1L6.97308 7L12.9462 1" stroke="white"/>
                                            </svg>
                                        </div>
                                        <div class="body__select">
                                            <div class="select__item" data-value="jpg">jpg</div>
                                            <div class="select__item" data-value="png">png</div>
                                            <div class="select__item" data-value="jpeg">jpeg</div>
                                        </div>
                                    </div>
                                </label>
                                <label class="hero__label" for="width">
                                    <span class="hero__text">Введите высоту изображения</span>
                                    <input class="hero__input" value=" <?php echo e(old('height')); ?>" type="text" name="height"
                                        placeholder="Высота">
                                    <?php $__errorArgs = ['height'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="error"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </label>
                            </div>
                        </div>
                        <button class="hero__button" type="submit">Отправить</button>
                    </form>
                <?php endif; ?>
                <div class="copy">© UploadFile</div>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH D:\OSPANEL\OSPanel\domains\UploadFileMainProject\UploadFile\resources\views/pages/index.blade.php ENDPATH**/ ?>