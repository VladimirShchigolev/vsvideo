<?php $__env->startSection('content'); ?>
<div class="container">
    
    
    <div class="ml-5 mb-3">
        <h2><?php echo e(__('messages.Users')); ?></h2>
    </div>

    <div>
        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="my-2 container" style="height: 80px">
            <a href="<?php echo e(action('UserController@show', $user->id)); ?>">
                    <img class="rounded-circle float-left mr-3" src="<?php echo e($user->avatarPath); ?>" alt="<?php echo e(__('messages.Avatar_unavailable')); ?>" width="64" height="64">
            </a>
            <div class="pt-2">
                <a href="<?php echo e(action('UserController@show', $user->id)); ?>">
                    <h2 class="text-truncate"><?php echo e($user->name); ?> </h2>
                </a>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\vsvideo\resources\views/user/index.blade.php ENDPATH**/ ?>