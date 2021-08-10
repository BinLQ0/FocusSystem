@extends('_layouts.base')

@section('title', 'Receive Item')

@section('css')

<link rel="stylesheet" href="{{ URL::asset('plugins/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('plugins/daterangepicker/daterangepicker.css') }}">

@endsection

@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-6">

        @if(isset($receiveItem))

            {{-- Update Receive --}}
            <h2 class="mb-3"> Update Receive </h2>

            <form action='{{ route("receive-item.update", ['receive_item' => $receiveItem->id]) }}' method='POST'
                class="form-horizontal">
                @method('PUT')

            {{-- ./Update Receive --}}
        @else

            {{-- Create Receive --}}
            <h2 class="mb-3"> Create Receive </h2>

            <form action='{{ route("receive-item.store") }}' method='POST' class="form-horizontal">
                @method('POST')

            @php
                $receiveItem = null;
            @endphp

            {{-- ./Create Receive --}}
        @endif

        {{-- Token --}}
        @csrf
        
        <x-card>

            <div class="row">
                <div class="col-6">
                    <x-input daterangepicker name='date' label="Receive Date" :bind="$receiveItem"/>
                </div>
                <div class="col-6">
                    <x-input name='for' label='No. Receive Item' :bind="$receiveItem"/>
                </div>
                <div class="col-12">
                    <x-select name='company_id' label='Vendor' :option='$receiveItem ? [optional($receiveItem->company)->id => optional($receiveItem->company)->name] : []' :selected='optional($receiveItem)->id'/>
                </div>
            </div>

        </x-card>

        <x-card theme-mode='outline' theme='primary' body-class='p-0'>
            <x-input-product-list title='Product' :except='["stock"]' :products='optional($receiveItem)->products' />
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
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            var $numLot = $('select[name="company_id"]');

            $numLot.select2({
                placeholder : '.. Pick a Lot ..',
                ajax: {
                    delay: 250,
                    url: '{{ route("api.company") }}',
                    data: function(params) {
                        var queryParameters = {
                            isSupplier: true,
                        }

                        return queryParameters;
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(obj) {
                                return {
                                    id: obj.id,
                                    text: obj.name,
                                };
                            })
                        };
                    }
                }
            });
        });
    </script>
@endpush
