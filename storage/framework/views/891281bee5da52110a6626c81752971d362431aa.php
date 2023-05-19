<?php $__env->startSection('content'); ?>
    <form action="<?php echo e(route('users.user.index')); ?>" method="GET">
        <div class="input-group p-2">
            <input name="search" type="text" class="form-control" placeholder="Введите пользователя" aria-label="Пользователи" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Button</button>
            </div>
        </div>
    </form>
    <form action="<?php echo e(route('users.user.index')); ?>" method="GET">
        <div class="form-group">
            <label for="exampleInputPassword1">Роль</label>
            <select name="filter" class="form-select" aria-label="Default select example">
                <option selected disabled>Выберите роль</option>
                <option value="1">Пользователь</option>
                <option value="2">Администратор</option>
            </select>
            <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="red"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <button type="submit">Фильтр</button>
    </form>
    <table class="table pt-5">
        <thead>
        <tr>
            <th scope="col">Имя</th>
            <th scope="col">Email</th>
            <th scope="col">Информация о пользователе</th>
            <th scope="col">Редактировать</th>
            <th scope="col">Добавить</th>
            <th scope="col">Удалить</th>
            <th scope="col">Тип пользователя</th>
        </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($user->name); ?></td>
                    <td><?php echo e($user->email); ?></td>
                    <td>
                        <form action="<?php echo e(route('users.user.show', $user->id)); ?>" method="GET">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-block btn btn-info btn-sm">Показать информацию</button>
                        </form>
                    </td>
                    <td>
                        <form action="<?php echo e(route('users.user.edit', $user->id)); ?>" method="GET">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-block btn-primary btn-sm">Редактировать</button>
                        </form>
                    </td>
                    <td>
                        <form action="<?php echo e(route('users.user.create')); ?>" method="GET">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-block btn-success btn-sm">Добавить</button>
                        </form>
                    </td>
                    <td>
                        <form action="<?php echo e(route('users.user.destroy', $user->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-block btn-danger btn-sm">Удалить</button>
                        </form>
                    </td>
                    <td>
                        <li><?php echo e(\App\Enums\RoleEnum::from($user->role)->label()); ?></li>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <?php if($users): ?>
        <div class="d-flex justify-content-center">
            <?php echo e($users->links()); ?>

        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OSPANEL\OSPanel\domains\UploadFileMainProject\UploadFile\resources\views/admin/users/index.blade.php ENDPATH**/ ?>