<a href="{{ $url }}" {{ $attributes->class('btn') }}>

    {{-- Check Icon Exist --}}
    @isset($icon)
        <i class=" mr-1 {{ $icon }}"></i>
    @endisset
    {{-- ./Check Icon Exist --}}

    {{-- Check Label Exist --}}
    @isset($label)
        {{ $label }}
    @endisset
    {{-- ./Check Label Exist --}}
</a>