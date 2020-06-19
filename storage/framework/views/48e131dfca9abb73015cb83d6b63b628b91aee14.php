

<?php $__env->startSection('content'); ?>
<div class="col-sm-8 my-3">
    <div class="card">
        <h4 class="list-group-item mb-0"><?php echo e(__('messages.Upload_a_video')); ?></h4>
        
        <?php if($errors->any()): ?>
            <div class="alert alert-danger mb-0">
                <?php if($errors->has('title')): ?>
                    <strong><?php echo e($errors->first('title')); ?></strong><br>
                <?php endif; ?> 
                <?php if($errors->has('video')): ?>
                    <strong><?php echo e($errors->first('video')); ?></strong><br>
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
            </div>
        <?php endif; ?>
        
        <form action="<?php echo e(action('VideoController@store')); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="card-body">
                <div class="m-2">
                    <label for="title"><?php echo e(__('messages.Video_title')); ?>:</label>
                    <input class="form-control" type="text" id="title" name="title" required>
                </div>
                <div class="m-2">
                    <label for="video"><?php echo e(__('messages.Select_the_video_to_upload')); ?>:</label>
                    <input class="form-control-file" type="file" name="video" id="video" required>
                </div>
                <div class="m-2">
                    <label for="thumbnail"><?php echo e(__('messages.Select_the_thumbnail_to_upload')); ?>:</label>
                    <input class="form-control-file" type="file" name="thumbnail" id="thumbnail">
                </div>
                <div class="m-2">
                    <label for="description"><?php echo e(__('messages.Video_description')); ?>:</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>
                <div class="form-check m-2">
                    <input type='hidden' value='0' name='public'>
                    <input class="form-check-input" type='checkbox' value='1' id="public" name='public'>
                    <label class="form-check-label" for="public"><?php echo e(__('messages.Open_for_public')); ?></label>
                </div>
                
                <input class="btn btn-primary col-sm" type="submit" value="<?php echo e(__('messages.Upload')); ?>" name="submit">
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\vsvideo\resources\views/video/create.blade.php ENDPATH**/ ?>