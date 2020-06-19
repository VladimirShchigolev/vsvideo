<?php $__env->startSection('content'); ?>
<div class="d-flex flex-wrap">
    <?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="ml-2 px-5 my-2" style="width:436px">
            <a href="<?php echo e(action('VideoController@show', $video->id)); ?>">
               <img class="my-1" src="<?php echo e($video->thumbnailPath); ?>" alt="<?php echo e(__('messages.Thumbnail unavailable')); ?>" width="426" height="240">   
            </a>
            <div class="my-2">
                <a href="<?php echo e(action('UserController@show', $video->owner_id)); ?>">
                        <img class="rounded-circle float-left mx-3" src="<?php echo e($video->owner->avatarPath); ?>" alt="<?php echo e(__('messages.Avatar_unavailable')); ?>" width="64" height="64">
                </a>
                <div style="width: 400px">
                    <a href="<?php echo e(action('VideoController@show', $video->id)); ?>">
                       <h3 class="text-truncate"> <?php echo e($video->title); ?> </h3> 
                    </a>
                    <a  href="<?php echo e(action('UserController@show', $video->owner_id)); ?>">
                        <h5 class="text-truncate"><?php echo e($video->owner->name); ?> </h5>
                    </a>
                </div>
            </div>
        </div>
        
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\vsvideo\resources\views/video/index.blade.php ENDPATH**/ ?>