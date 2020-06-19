<?php $__env->startSection('content'); ?>
<div class="col-sm-8 my-3">
    <form action="<?php echo e(action('VideoController@update', $video->id)); ?>" method="post" enctype="multipart/form-data">
        <?php echo e(method_field('PATCH')); ?>

        <?php echo csrf_field(); ?>
        <div class="card">
            <h4 class="list-group-item mb-0"><?php echo e(__('messages.Edit_video_details')); ?></h4>

            <?php if($errors->any()): ?>
                <div class="alert alert-danger mb-0">
                    <?php if($errors->has('title')): ?>
                        <strong><?php echo e($errors->first('title')); ?></strong><br>
                    <?php endif; ?> 
                    <?php if($errors->has('thumbnail')): ?>
                        <strong><?php echo e($errors->first('thumbnail')); ?></strong><br>
                    <?php endif; ?> 
                    <?php if($errors->has('description')): ?>
                        <strong><?php echo e($errors->first('description')); ?></strong><br>
                    <?php endif; ?>
                    <?php if($errors->has('public')): ?>
                        <strong><?php echo e($errors->first('public')); ?></strong><br>
                    <?php endif; ?> 
                    <?php if($errors->has('blocked')): ?>
                        <strong><?php echo e($errors->first('blocked')); ?></strong><br>
                    <?php endif; ?> 
                </div>
            <?php endif; ?>


            <div class="card-body">
                <div class="m-2">
                    <label for="title"><?php echo e(__('messages.Edit_video_title')); ?>:</label>
                    <input class="form-control" type="text" id="title" name="title" value="<?php echo e($video->title); ?>" required>
                </div>
                <div class="m-2">
                    <label for="thumbnail"><?php echo e(__('messages.Select_the_new_thumbnail_to_upload')); ?>:</label>
                    <input class="form-control-file" type="file" name="thumbnail" id="thumbnail">
                </div>
                <div class="m-2">
                    <label for="description"><?php echo e(__('messages.Edit_video_description')); ?>:</label>
                    <textarea class="form-control" id="description" name="description" rows="3"><?php echo e($video->description); ?></textarea>
                </div>
                <div class="form-check m-2">
                    <input type='hidden' value='0' name='public'>
                    <input class="form-check-input" type='checkbox' value='1' id="public" name="public" <?php if($video->public): ?> checked <?php endif; ?>>
                    <label class="form-check-label" for="public"><?php echo e(__('messages.Open_for_public')); ?></label>
                </div>
                
                <?php if(auth()->user()->isAdmin): ?>
                <div class="form-check m-2">
                    <input type='hidden' value='0' name='blocked'>
                    <input class="form-check-input" type='checkbox' value='1' id="blocked" name="blocked" <?php if($video->blocked): ?> checked <?php endif; ?>>
                    <label class="form-check-label" for="blocked"><?php echo e(__('messages.Blocked')); ?></label>
                </div>
                <?php endif; ?>
            </div>   
        </div>
        <input class="btn btn-primary col-sm my-2" type="submit" value="<?php echo e(__('messages.Save_changes')); ?>" name="submit">
    </form>
    <form style="display: inline" action="<?php echo e(action('VideoController@show', $video->id)); ?>" method="get">
        <button class="btn btn-secondary col-sm my-1"><?php echo e(__('messages.Cancel')); ?></button>
    </form>
    
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\vsvideo\resources\views/video/edit.blade.php ENDPATH**/ ?>