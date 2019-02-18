@if(session('message'))
<article class="message is-{{ session('message_state') }}">
    <div class="message-body">
        {{ session('message') }}
    </div>
</article>
@endif