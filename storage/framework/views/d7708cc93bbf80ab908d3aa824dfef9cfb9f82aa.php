

<?php $__env->startSection('content'); ?>
<div class="col-9 my-3">
    <h1><?php echo e(__('messages.Deleting')); ?> "<?php echo e($video->title); ?>"</h1>
    <form style="display: inline" action="<?php echo e(action('VideoController@destroy', $video->id)); ?>" method="get">
        <button class="btn btn-danger col-sm my-1"><?php echo e(__('messages.Confirm')); ?></button>
    </form>
    
    <form style="display: inline" action="<?php echo e(action('VideoController@show', $video->id)); ?>" method="get">
        <button class="btn btn-secondary col-sm my-1"><?php echo e(__('messages.Cancel')); ?></button>
    </form>
    
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\vsvideo\resources\views/video/delete.blade.php ENDPATH**/ ?>