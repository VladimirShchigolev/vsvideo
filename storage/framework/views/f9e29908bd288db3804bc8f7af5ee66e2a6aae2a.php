

<?php $__env->startSection('content'); ?>
<div class="col-9 my-3">
    <div>
        <div>
            <?php if(auth()->guard()->check()): ?>
                <?php if(Auth::user()->id == $video->owner_id || auth()->user()->isAdmin): ?>
                    <form style="display: inline" action="<?php echo e(action('VideoController@edit', $video_id)); ?>" method="get">
                        <button class="btn btn-primary float-right mr-4"><?php echo e(__('messages.Edit_video_details')); ?></button>
                    </form>
                    <form style="display: inline" action="<?php echo e(action('VideoController@delete', $video_id)); ?>" method="get">
                        <button class="btn btn-primary float-right mx-4"><?php echo e(__('messages.Delete_the_video')); ?></button>
                    </form>
                    
                <?php endif; ?>
            <?php endif; ?>
            <h1> <?php echo e($video->title); ?> </h1>
        </div>
        
        <?php if(!$video->blocked): ?>
        <video width="1280" height="720" controls class="my-3">
            <source src="<?php echo e($video->path); ?>" type="video/mp4">
             <?php echo e(__('messages.Your_browser_does_not_support_the_video_tag')); ?>

         </video>
        <?php else: ?>
        <h1 class="text-danger"><?php echo e(__('messages.This_video_is_blocked')); ?></h1>
        <?php endif; ?>
        
        
        <div class="float-right mr-2">
            <?php echo $__env->make('like.operate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>     
        
        <div class="float-right mr-5">
            <?php echo $__env->make('subscription.operate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div> 
        
        <div style="height: 64px">
            <a href="<?php echo e(action('UserController@show', $video->owner_id)); ?>">
                <img class="rounded-circle float-left mx-3" src="<?php echo e($video->owner->avatarPath); ?>" alt="<?php echo e(__('messages.Avatar_unavailable')); ?>" width="64" height="64">
            </a>
            <a href="<?php echo e(action('UserController@show', $video->owner_id)); ?>">
                <h1 class="mt-1 d-inline"><?php echo e($video->owner->name); ?> </h1>
            </a>
        </div>
        
        <hr>
        
        <h3><?php echo e(__('messages.Description')); ?></h3>
        <p> <?php echo e($video->description); ?> </p>
    </div>
    <hr>

    <?php echo $__env->make('comment.create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('comment.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\vsvideo\resources\views/video/show.blade.php ENDPATH**/ ?>