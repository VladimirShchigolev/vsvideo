

<?php $__env->startSection('content'); ?>
<div class="col-8 my-3">
    <?php if(auth()->guard()->check()): ?>
    <form action="<?php echo e(action('CommentController@update', $comment->id)); ?>" method="post">
    <?php echo e(method_field('PATCH')); ?>

    <?php echo csrf_field(); ?>
        <div class="card">
            <h4 class="list-group-item m-0"><?php echo e(__('messages.Edit_the_comment')); ?></h4>

            <?php if($errors->any()): ?>
                <div class="alert alert-danger mb-0">

                    <?php if($errors->has('text')): ?>
                        <strong><?php echo e($errors->first('text')); ?></strong><br>
                    <?php endif; ?>

                </div>
            <?php endif; ?>

            <div class="card-body">
                <div class="m-2">
                    <textarea class="form-control" id="text" name="text" rows="6" placeholder="<?php echo e(__('messages.Write_your_comment_here')); ?>!" required><?php echo e($comment->text); ?></textarea>
                </div>
            </div>
        </div>
    <input class="btn btn-primary col-sm my-1" type="submit" value="<?php echo e(__('messages.Save_changes')); ?>" name="submit">
    </form>
    <form style="display: inline" action="<?php echo e(action('VideoController@show', $comment->video_id)); ?>" method="get">
        <button class="btn btn-secondary col-sm my-1"><?php echo e(__('messages.Cancel')); ?></button>
    </form>
    
    <?php else: ?>
    <h5><?php echo e(__('messages.Log_in_to_leave_a_comment')); ?></h5>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\vsvideo\resources\views/comment/edit.blade.php ENDPATH**/ ?>