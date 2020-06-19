<?php if(auth()->guard()->check()): ?>
<script type="application/javascript">
$(document).ready(function () {
    $(".container").off('click', '#subscribe.btn-primary').on('click', '#subscribe.btn-primary', function (e) {
        var url = "<?php echo e(action('SubscriptionController@store')); ?>";
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: "POST",
            url: url,
            data: { subscriber_id: <?php echo e(auth()->id()); ?>, author_id: <?php echo e($user->id); ?>, _token: CSRF_TOKEN },
            success: function (data) {
                if (data["success"] == 1) {
                    $("#subscribe.btn-primary").text("<?php echo e(__('messages.Unsubscribe')); ?>");
                    $("#subscribe.btn-primary").toggleClass("btn-primary btn-secondary"); 
                    subscription_count = Number($("#subscription_count").text());
                    $("#subscription_count").text((subscription_count+1).toString(10));
                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    })
    $(".container").off('click', '#subscribe.btn-secondary').on('click', '#subscribe.btn-secondary', function (e) {
        var url = "<?php echo e(action('SubscriptionController@destroy')); ?>";
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: "POST",
            url: url,
            data: { subscriber_id: <?php echo e(auth()->id()); ?>, author_id: <?php echo e($user->id); ?>, _token: CSRF_TOKEN },
            success: function (data) {
                if (data["success"] == 1) {
                    $("#subscribe.btn-secondary").text("<?php echo e(__('messages.Subscribe')); ?>");
                    $("#subscribe.btn-secondary").toggleClass("btn-primary btn-secondary"); 
                    subscription_count = Number($("#subscription_count").text());
                    $("#subscription_count").text((subscription_count-1).toString(10));
                }
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
        <h4 class="d-inline-block align-top"><?php echo e(__('messages.Subscribers')); ?>:</h4> 
        <h4 class="d-inline-block align-top" id="subscription_count"><?php echo e($subscription_count); ?></h4>
    </div>
    
    <?php if(auth()->guard()->check()): ?>
        <?php if(auth()->id() != $user->id): ?>
            <?php if(App\Subscription::where('subscriber_id', auth()->id())->where('author_id', $user->id)->exists()): ?>
                <button id="subscribe" class='btn btn-secondary d-inline-block'><?php echo e(__('messages.Unsubscribe')); ?></button>
            <?php else: ?>
                <button id="subscribe" class='btn btn-primary d-inline-block'><?php echo e(__('messages.Subscribe')); ?></button>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>
</div><?php /**PATH C:\wamp64\www\vsvideo\resources\views/subscription/operate.blade.php ENDPATH**/ ?>