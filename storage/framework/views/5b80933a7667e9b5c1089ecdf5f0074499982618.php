<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo e(asset('/dist/css/app/app.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('fonts/stylesheet.css')); ?>">

    <title>Вход</title>
</head>
<body class="body_login">
    <main class="main_vhod">
        <div class="registration-cssave">
            <form class = "form_vhod" method="post" action="<?php echo e(route('login.store')); ?>">
                <?php echo csrf_field(); ?>
                <h3 class="text-center">ВХОД</h3>
                <div class="form-group">
                    <input type="text" class="auth__input_user" name="email"  value="<?php echo e(old('email')); ?>" required="required">
                    <span>Email</span>
                    <i></i>
                </div>
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="errorMes"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <div class="form-group">
                    <input type="password" class="auth__input_user" name="password" value="<?php echo e(old('password')); ?>" required="required">
                    <span>Password</span>
                    <i></i>
                </div>
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="errorMesTwo"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <div class="form-group">
                    <button class="button__vhod" type="submit">Вход в аккаунт</button> <br>
                        <div class="buttons_main_page">
                            <a class="button__main__page" href="<?php echo e(route('service.index')); ?>">На главную</a>
                            <a class="button__main__page" href="<?php echo e(route('forget.index')); ?>">Забыли пароль?</a>
                        </div>
                    </div>
                </form>
        </div>
    </main>
    <footer></footer>
    <script type="text/javascript" src="<?php echo e(asset('js/script.js')); ?>"></script>
</body>
</html>



<?php /**PATH D:\OSPANEL\OSPanel\domains\UploadFileMainProject\UploadFile\resources\views/pages/login.blade.php ENDPATH**/ ?>