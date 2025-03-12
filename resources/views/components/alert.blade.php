<!-- resources/views/components/alert.blade.php -->

<div class="alert-box {{ $type }}-alert pl-100">
    <div class="left">
        <h5 class="text-bold">{{ $title }}</h5>
    </div>
    <div class="alert">
        <h4 class="alert-heading">{{ $heading }}</h4>
        <p class="text-medium">
            {{ $message }}
        </p>
    </div>
</div>
