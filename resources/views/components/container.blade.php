@props([ 'fullHeight' => 'flex flex-col flex-1' ])

<div {{ $attributes->merge([ 'class' => "px-8 $fullHeight" ]) }}>
    {{ $slot }}
</div>
