<div class="{{ $makeFormGroupClass() }}">
    <div class="{{ $makeCheckClass() }}">
        <input id='{{ $name }}' name='{{ $name }}' {{ $attributes }} type="checkbox" {{ $isChecked }}>
        <label for='{{ $name }}'>{{ $label }}</label>
    </div>
</div>