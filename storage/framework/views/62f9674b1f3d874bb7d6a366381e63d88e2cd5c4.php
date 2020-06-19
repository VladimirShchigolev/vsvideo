

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-10">
        <div class="my-3">  
            <div class="float-right mr-5 mt-5">
                <?php echo $__env->make('subscription.operate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div> 

            <div style="height: 150px">
                <img class="rounded-circle float-left mx-5" src="<?php echo e($user->avatarPath); ?>" alt="<?php echo e(__('messages.Avatar_unavailable')); ?>" width="128" height="128">
                <h1> <?php echo e($user->name); ?> </h1>
                <?php if(auth()->guard()->check()): ?>
                    <?php if(Auth::user()->id == $user->id || auth()->user()->isAdmin): ?>
                        <form style="display: inline" action="<?php echo e(action('UserController@edit', $user->id)); ?>" method="get">
                            <button class="btn btn-primary"><?php echo e(__('messages.Edit_Profile')); ?></button>
                        </form>
                        
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
        <hr>

        <div class="container-fluid">
            <div class="ml-5">
                <?php if(auth()->guard()->check()): ?>
                    <?php if(Auth::user()->id == $user->id): ?>
                        <form style="display: inline" action="<?php echo e(action('VideoController@create', $user->id)); ?>" method="get">
                            <button class="btn btn-primary float-right"><?php echo e(__('messages.Upload_a_video')); ?></button>
                        </form>
                        
                    <?php endif; ?>
                <?php endif; ?>
                <h2><?php echo e($user->name); ?> <?php echo e(__('messages.videos')); ?></h2>
            </div>
            <div class="d-flex flex-wrap">
                <?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(!$video->blocked && ($video->public || (Auth::check() && (auth()->user()->isAdmin || auth()->id() == $user->id)))): ?>
                        <div class="mr-2 px-5 my-2"  style="width:436px">
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
                    <?php endif; ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <hr>
        <div class="container-fluid">
            <div class="ml-5">
                <h2><?php echo e(__('messages.Liked_videos')); ?></h2>
            </div>
            <div class="d-flex flex-wrap">
                <?php $__currentLoopData = $liked_videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(!$video->blocked && ($video->public || (Auth::check() && (auth()->user()->isAdmin || auth()->id() == $user->id)))): ?>
                        <div class="mr-2 px-5 my-2"  style="width:436px">
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
                    <?php endif; ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    
    
    <div class="col-2">
        <div class="ml-5 mb-3">
            <h2><?php echo e(__('messages.Subscriptions')); ?></h2>
        </div>
        
        <div>
            <?php $__currentLoopData = $subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="my-2 container" style="height: 80px">
                    <a href="<?php echo e(action('UserController@show', $author->id)); ?>">
                            <img class="rounded-circle float-left mr-3" src="<?php echo e($author->avatarPath); ?>" alt="<?php echo e(__('messages.Avatar_unavailable')); ?>" width="64" height="64">
                    </a>
                    <div class="pt-2">
                        <a href="<?php echo e(action('UserController@show', $author->id)); ?>">
                            <h2 class="text-truncate"><?php echo e($author->name); ?> </h2>
                        </a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\vsvideo\resources\views/user/show.blade.php ENDPATH**/ ?>