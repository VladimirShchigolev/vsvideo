@auth
<script type="application/javascript">
$(document).ready(function () {
    $(".container").off('click', '#subscribe.btn-primary').on('click', '#subscribe.btn-primary', function (e) {
        var url = "{{ action('SubscriptionController@store') }}";
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: "POST",
            url: url,
            data: { subscriber_id: {{ auth()->id() }}, author_id: {{ $user->id }}, _token: CSRF_TOKEN },
            success: function (data) {
                if (data["success"] == 1) {
                    $("#subscribe.btn-primary").text("Unsubscribe");
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
        var url = "{{ action('SubscriptionController@destroy') }}";
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: "POST",
            url: url,
            data: { subscriber_id: {{ auth()->id() }}, author_id: {{ $user->id }}, _token: CSRF_TOKEN },
            success: function (data) {
                if (data["success"] == 1) {
                    $("#subscribe.btn-secondary").text("Subscribe");
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
@endauth

<div class="container">
    <div class="d-inline-block my-1 mr-2">
        <h4 class="d-inline-block align-top">Subscribers:</h4> 
        <h4 class="d-inline-block align-top" id="subscription_count">{{ $subscription_count }}</h4>
    </div>
    
    @auth
        @if (auth()->id() != $user->id)
            @if (App\Subscription::where('subscriber_id', auth()->id())->where('author_id', $user->id)->exists())
                <button id="subscribe" class='btn btn-secondary d-inline-block'>Unsubscribe</button>
            @else
                <button id="subscribe" class='btn btn-primary d-inline-block'>Subscribe</button>
            @endif
        @endif
    @endauth
</div>