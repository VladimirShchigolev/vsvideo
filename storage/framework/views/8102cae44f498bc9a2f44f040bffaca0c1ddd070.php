<div class="my-3">
    <h1 class="ml-auto"><?php echo e(__('messages.Comments')); ?></h1>
    <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="mr-auto">
            <div>
                
                <table>
                    <tr>
                        <td>
                            <a href="<?php echo e(action('UserController@show', $comment->owner_id)); ?>">
                                    <img class="rounded-circle float-left mx-3" src="<?php echo e($comment->owner->avatarPath); ?>" alt="<?php echo e(__('messages.Avatar_unavailable')); ?>" width="64" height="64">
                            </a>
                        </td>
                        <td class="container pt-3">
                            <div class="float-right d-inline-block">
                            <?php if(auth()->guard()->check()): ?>
                            <?php if(Auth::user()->id == $comment->owner_id || Auth::user()->id == $video->owner_id || auth()->user()->isAdmin): ?>
                                <?php if(Auth::user()->id == $comment->owner_id || auth()->user()->isAdmin): ?>
                                <form style="display: inline" action="<?php echo e(action('CommentController@edit', $comment->id)); ?>" method="get">
                                    <button class="btn btn-primary mb-1 float-right"><?php echo e(__('messages.Edit_the_comment')); ?></button>
                                </form>
                                
                                <?php endif; ?>
                            <br>
                                <form style="display: inline" action="<?php echo e(action('CommentController@delete', $comment->id)); ?>" method="get">
                                    <button class="btn btn-primary mt-1 float-right"><?php echo e(__('messages.Delete_the_comment')); ?></button>
                                </form>
                                
                            <?php endif; ?>
                            <?php endif; ?>
                            </div>
                            <div class="wrapper">
                                <a href="<?php echo e(action('UserController@show', $comment->owner_id)); ?>">
                                   <h5 class="d-inline"> <?php echo e($comment->owner->name); ?> </h5>
                                </a>

                                <p class="text-break"> <?php echo e($comment->text); ?> </p>

                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            
            
        </div>
    <hr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH C:\wamp64\www\vsvideo\resources\views/comment/index.blade.php ENDPATH**/ ?>