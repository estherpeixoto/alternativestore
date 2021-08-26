@props(['disabled' => false])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'ckeditor']) !!}>{{ $slot }}</textarea>

@error($attributes['name'])
    <small class='text-red-500'>{{ $message }}</small>
@enderror