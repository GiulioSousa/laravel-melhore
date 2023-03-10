@if (session('message.success'))
    <div class="card message message--success">
        {{ session('message.success') }}
    </div>
@elseif (session('message.error'))
    <div class="card message message--error">
        {{ session('message.error') }}
    </div>
@endif
