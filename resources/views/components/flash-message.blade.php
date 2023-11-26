<?php
    $message = session("message");
?>

@if ($message != "")
    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show" class="notification-container">
        <div>{{$message}}</div>
    </div>
@endif
