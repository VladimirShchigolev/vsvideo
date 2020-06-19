<div class="col-8 my-3">
    <?php if(auth()->guard()->check()): ?>
    <div class="card">
        <h4 class="list-group-item m-0"> <?php echo e(__('messages.Write_a_comment')); ?></h4>
        
        <?php if($errors->any()): ?>
            <div class="alert alert-danger mb-0">
                
                <?php if($errors->has('text')): ?>
                    <strong><?php echo e($errors->first('text')); ?></strong><br>
                <?php endif; ?>
                
            </div>
        <?php endif; ?>
        
        <form action="<?php echo e(action('CommentController@store')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <div class="card-body">
                
                <div class="m-2">
                    <textarea class="form-control" id="text" name="text" rows="2" placeholder="<?php echo e(__('messages.Write_your_comment_here')); ?>!" required></textarea>
                </div>
                <input type="hidden" value="<?php echo e($video_id); ?>" name="video_id">
                
                <input class="btn btn-primary mx-2" type="submit" value="<?php echo e(__('messages.Leave_a_comment')); ?>" name="submit">
            </div>
        </form>
    </div>
    <?php else: ?>
    <h5><?php echo e(__('messages.Log_in_to_leave_a_comment')); ?></h5>
    <?php endif; ?>
</div><?php /**PATH C:\wamp64\www\vsvideo\resources\views/comment/create.blade.php ENDPATH**/ ?>