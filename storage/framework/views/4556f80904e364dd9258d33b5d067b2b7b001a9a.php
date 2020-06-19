<?php $__env->startSection('content'); ?>
<div class="my-3">  
    <div style="height: 150px">
        <img class="rounded-circle float-left mx-5" src="<?php echo e($user->avatarPath); ?>" alt="<?php echo e(__('messages.Avatar_unavailable')); ?>" width="128" height="128">
        <h1> <?php echo e($user->name); ?> </h1>
        
    </div>
</div>
<hr>

<div class="col-sm-8 my-3">
    <div class="card">
        <h4 class="list-group-item mb-0"><?php echo e(__('messages.Change_Profile_Info')); ?></h4>
        
        <?php if($errors->any()): ?>
            <div class="alert alert-danger mb-0">
                <?php if($errors->has('name')): ?>
                    <strong><?php echo e($errors->first('name')); ?></strong><br>
                <?php endif; ?> 
                <?php if($errors->has('avatar')): ?>
                    <strong><?php echo e($errors->first('avatar')); ?></strong><br>
                <?php endif; ?> 
            </div>
        <?php endif; ?>
        
        <form action="<?php echo e(action('UserController@update', $user->id)); ?>" method="post" enctype="multipart/form-data">
            <?php echo e(method_field('PATCH')); ?>

            <?php echo csrf_field(); ?>
            <div class="card-body">
                <div class="m-2">
                    <label for="name"><?php echo e(__('messages.Name')); ?>:</label>
                    <input class="form-control" type="text" id="name" name="name" value="<?php echo e($user->name); ?>" required>
                </div>
                <div class="m-2">
                    <label for="avatar"><?php echo e(__('messages.Select_the_avatar_to_upload')); ?>:</label>
                    <input class="form-control-file" type="file" name="avatar" id="avatar">
                </div>
                <div class="form-check my-2">
                    <p><?php echo e(__('messages.Personalisation_(what_to_show_on_the_main_page)')); ?>:</p>
                    <label><input name="personalisation" type="radio" value="0" <?php if($user->personalisation == 0): ?> checked <?php endif; ?>> <?php echo e(__('messages.Newest')); ?></label>
                    <label class="mx-2"><input name="personalisation" type="radio" value="1" <?php if($user->personalisation == 1): ?> checked <?php endif; ?>> <?php echo e(__('messages.Recommended')); ?></label>
                </div>
                <?php if(auth()->user()->isAdmin): ?>
                <div class="form-check m-2">
                    <input type='hidden' value='0' name='blocked'>
                    <input class="form-check-input" type='checkbox' value='1' id="blocked" name="blocked" <?php if($user->isBlocked): ?> checked <?php endif; ?>>
                    <label class="form-check-label" for="blocked"><?php echo e(__('messages.Blocked')); ?></label>
                </div>
                <?php endif; ?>
                <input class="btn btn-primary col-sm" type="submit" value="<?php echo e(__('messages.Save')); ?>" name="submit">
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\vsvideo\resources\views/user/edit.blade.php ENDPATH**/ ?>