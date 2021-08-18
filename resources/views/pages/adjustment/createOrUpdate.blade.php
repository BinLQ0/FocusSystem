@extends('_layouts.base')

@section('title', 'Create Adjustment')

@section('css')

<link rel="stylesheet" href="{{ URL::asset('plugins/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('plugins/daterangepicker/daterangepicker.css') }}">

@endsection

@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-6">

        @if(isset($adjustment))

            {{-- Update Adjustment --}}
            <h2 class="mb-3"> Update Adjustment </h2>

            <form action='{{ route("adjustment.update", ['adjustment' => $adjustment->id]) }}' method='POST'
                class="form-horizontal">
                @method('PUT')

            {{-- ./Update Adjustment --}}
        @else

            {{-- Create Adjustment --}}
            <h2 class="mb-3"> Create Adjustment </h2>

            <form action='{{ route("adjustment.store") }}' method='POST' class="form-horizontal">
                @method('POST')

            @php
                $adjustment = null;
            @endphp

            {{-- ./Create Adjustment --}}
        @endif

        {{-- Token --}}
        @csrf

        <x-card>

            <div class="row">
                <div class="col-6">
                    <x-input daterangepicker name='date' label="Receive Date" :bind='$adjustment'/>
                </div>
                <div class="col-6">
                    <x-input name='for' label='No. Adjusment' :bind='$adjustment'/>
                </div>
                <div class="col-sm-12">
                    <x-input name='description' type='text' label='Note' placeholder='(Optional)' :bind='$adjustment'/>
                </div>
            </div>

        </x-card>

        <x-card theme-mode='outline' theme='primary' body-class='p-0'>
            <x-input-product-list title='Items' :products='optional($adjustment)->products' :except='["stock"]'/>
        </x-card>

        <div class="text-right">
            <button type="submit" class="btn btn-primary mt-3">Save</button>
        </div>

            </form>
    </div>
</div>
@endsection

@section('js')
<script src="{{ url::asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ url::asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ url::asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ url::asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ url::asset('plugins/datatables/jquery.dataTables.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#balance').keyup(function () {
            if ($(this).val() == '') {
                $(this).val(0);
            }
        });
    });
</script>
@endsection
