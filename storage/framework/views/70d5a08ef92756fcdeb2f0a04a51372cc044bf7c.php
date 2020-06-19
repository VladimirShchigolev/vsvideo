<?php if(auth()->guard()->check()): ?>
<script type="application/javascript">
$(document).ready(function () {
    $(".container").off('click', '#like.btn-primary').on('click', '#like.btn-primary', function (e) {
        var url = "<?php echo e(action('LikeController@store')); ?>";
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: "POST",
            url: url,
            data: { owner_id: <?php echo e(auth()->id()); ?>, video_id: <?php echo e($video_id); ?>, _token: CSRF_TOKEN },
            success: function (data) {
                $("#like.btn-primary").text("<?php echo e(__('messages.Dislike')); ?>");
                $("#like.btn-primary").toggleClass("btn-primary btn-secondary"); 
                like_count = Number($("#like_count").text());
                $("#like_count").text((like_count+1).toString(10));
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    })
    $(".container").off('click', '#like.btn-secondary').on('click', '#like.btn-secondary', function (e) {
        var url = "<?php echo e(action('LikeController@destroy')); ?>";
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: "POST",
            url: url,
            data: { owner_id: <?php echo e(auth()->id()); ?>, video_id: <?php echo e($video_id); ?>, _token: CSRF_TOKEN },
            success: function (data) {
                $("#like.btn-secondary").text("<?php echo e(__('messages.Like')); ?>");
                $("#like.btn-secondary").toggleClass("btn-primary btn-secondary"); 
                like_count = Number($("#like_count").text());
                $("#like_count").text((like_count-1).toString(10));
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    })
});
</script>
<?php endif; ?>

<div class="container">
    <div class="d-inline-block my-1 mr-2">
        <h4 class="d-inline-block align-top"><?php echo e(__('messages.Likes')); ?>:</h4> 
        <h4 class="d-inline-block align-top" id="like_count"><?php echo e($like_count); ?></h4>
    </div>
    
    <?php if(auth()->guard()->check()): ?>
        <?php if(App\Like::where('owner_id', auth()->id())->where('video_id', $video_id)->exists()): ?>
            <button id="like" class='btn btn-secondary d-inline-block'><?php echo e(__('messages.Dislike')); ?></button>
        <?php else: ?>
            <button id="like" class='btn btn-primary d-inline-block'><?php echo e(__('messages.Like')); ?></button>
        <?php endif; ?>
    <?php endif; ?>
</div><?php /**PATH C:\wamp64\www\vsvideo\resources\views/like/operate.blade.php ENDPATH**/ ?>