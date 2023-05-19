<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo e(asset('/dist/css/app/app.css')); ?>">
    <title>Profile</title>
</head>
<body>
    <main class="main">
        <div class="wrapper-profile">
            <section class="section__profile">
                <h1 class="profile_title">Добро пожаловать <?php echo e(\Illuminate\Support\Facades\Auth::user()->name ?? null); ?></h1>
                <div class="profile__block_image">
                    <?php if(\Illuminate\Support\Facades\Auth::user()->avatar): ?>
                        <img class="profile_avatar" src="<?php echo e(asset('storage/avatar/' .
                                \Illuminate\Support\Facades\Auth::id() . '/' . auth()->user()->avatar)); ?>" alt="Avatar">
                    <?php else: ?>
                        <span>Загрузите изображение</span>
                    <?php endif; ?>
                </div>
                <form class="profile_form" action="<?php echo e(route('profile.update', \Illuminate\Support\Facades\Auth::id())); ?>" method="POST"
                    enctype="multipart/form-data">
                    <?php echo method_field('PATCH'); ?>
                    <?php echo csrf_field(); ?>
                    <div class="profile__wrapper">
                        <div class="profile__group">
                            <label class="profile__text" for="name">Имя:</label>
                            <input class="profile__input" type="text" name="name" placeholder="Введите имя" value="<?php echo e(\Illuminate\Support\Facades\Auth::user()->name); ?>">
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="error"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="profile__group">
                            <label class="profile__text" for="email">Email:</label>
                            <input class="profile__input" type="text" name="email" placeholder="Введите email"
                                value="<?php echo e(\Illuminate\Support\Facades\Auth::user()->email); ?>">
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="error"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="profile__group">
                            <label class="profile__text" for="password">Пароль:</label>
                            <input class="profile__input" type="password" name="password" placeholder="Введите пароль">
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="error"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="profile__group">
                            <label class="profile__text" for="password">Подтвердите пароль:</label>
                            <input class="profile__input" type="password" name="password_confirmation" placeholder="Пароль">
                            <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="error"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="profile__group">
                            <label class="profile__text" for="avatar">Аватар:</label>
                            <input class="profile__input" type="file" name="avatar" value="<?php echo e(\Illuminate\Support\Facades\Auth::user()->avatar); ?>">
                            <?php $__errorArgs = ['avatar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="error"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="profile__group">
                            <button class="profile__button" type="submit">Отредактировать</button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </main>
</body>
</html>
<?php /**PATH D:\OSPANEL\OSPanel\domains\UploadFileMainProject\UploadFile\resources\views/pages/userProfile.blade.php ENDPATH**/ ?>