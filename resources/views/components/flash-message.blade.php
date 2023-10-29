<?php
    $color = "var(--notification-color)";
    $message = "";
    if((session()->has('error')))
    {
        $color = "var( --error-color )";
        $message = session('error');
    }
    else if(session()->has('success'))
    {
        $color = "var( --success-color )";
        $message = session('success');
    }
?>
@if ($message != "")
    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show" style="background: {{$color}};" class="notification-container">
        <div>{{$message}}</div>
    </div>
@endif
