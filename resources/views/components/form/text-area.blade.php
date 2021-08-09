@extends('components.form.base-input-component')
@section('input-item')

<!-- Input Field -->
<textarea name='{{ $name }}'
    {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }}>{{ $getValue() }}</textarea>

<!-- Icon -->
@isset($icon)

    <!-- Input Group Append -->
    <div class="input-group-append">

        <!-- Input Group Icon -->
        <div class="input-group-text">
            <span class="{{ $icon }}"></span>
        </div>
        <!-- ./Input Group Icon -->

    </div>
    <!-- ./Input Group Append -->
@endisset

@overwrite

    @isset($daterangepicker)
        @prepend('js')
            <script>
                $('input[name="{{ $name }}"]').daterangepicker({
                    locale: {
                        format: 'DD/MM/YYYY'
                    },
                    singleDatePicker: true,
                    showDropdowns: true,
                    minYear: 2011,
                    maxYear: parseInt(moment().format('YYYY'), 10),
                });
            </script>
        @endprepend
    @endisset