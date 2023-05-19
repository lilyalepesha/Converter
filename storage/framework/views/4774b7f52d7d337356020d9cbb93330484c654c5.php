<?php if(auth()->guard()->check()): ?>
    <span><?php echo e(\Illuminate\Support\Facades\Auth::user()->name ?? null); ?></span>
    <?php if(\Illuminate\Support\Facades\Auth::user()->avatar): ?>
        <img class="avatar" width="40px" height="40px" src="<?php echo e(asset('storage/avatar/' .
            \Illuminate\Support\Facades\Auth::id() . '/' . auth()->user()->avatar)); ?>" alt="Avatar">
    <?php else: ?>
        <span>Загрузите изображение</span>
    <?php endif; ?>
<?php endif; ?>

<?php /**PATH D:\OSPANEL\OSPanel\domains\UploadFileMainProject\UploadFile\resources\views/layouts/avatar.blade.php ENDPATH**/ ?>