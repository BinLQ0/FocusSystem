@extends('_layouts.base')

@section('title', 'Create Delivery')

@section('css')

<link rel="stylesheet" href="{{ URL::asset('plugins/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('plugins/daterangepicker/daterangepicker.css') }}">

@endsection

@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-6">

        @if(isset($deliveryOrder))

            {{-- Update Delivery Order --}}
            <h2 class="mb-3"> Update Delivery Order </h2>

            <form action='{{ route("delivery-order.update", ['delivery_order' => $deliveryOrder->id]) }}' method='POST'
                class="form-horizontal">
                @method('PUT')

                {{-- ./Update Delivery Order --}}
            @else

                {{-- Create Delivery Order --}}
                <h2 class="mb-3"> Create Delivery Order </h2>

                <form action='{{ route("delivery-order.store") }}' method='POST' class="form-horizontal">
                    @method('POST')

                    @php
                        $deliveryOrder = null;
                    @endphp

                    {{-- ./Create Delivery Order --}}
        @endif

        {{-- Token --}}
        @csrf

        <x-card>

            <div class="row">
                <div class="col-6">
                    <x-input daterangepicker name='date' label="Delivery Date" :bind='$deliveryOrder' />
                </div>
                <div class="col-6">
                    <x-input name='for' label='No. Delivery Order' :bind='$deliveryOrder' />
                </div>
                <div class="col-12">
                    <x-select name='company_id' label='Customer' :option='$deliveryOrder ? [optional($deliveryOrder->company)->id => optional($deliveryOrder->company)->name] : []'
                        :selected='$deliveryOrder ? optional($deliveryOrder->company)->id : []' />
                </div>
                <div class="col-12">
                    <x-select name='vehicle_id' label='Vehicle' :option='$deliveryOrder ? [optional($deliveryOrder->vehicle)->id => optional($deliveryOrder->vehicle)->fullName] : []'
                        :selected='$deliveryOrder ? optional($deliveryOrder->vehicle)->id : []' />
                </div>
                <div class="col-12">
                    <x-select name='driver_id' label='Driver' :option='$deliveryOrder ? [optional($deliveryOrder->driver)->id => optional($deliveryOrder->driver)->fullname] : []'
                        :selected='$deliveryOrder ? optional($deliveryOrder->driver)->id : []' />
                </div>
            </div>

        </x-card>

        <x-card theme-mode='outline' theme='primary' body-class='p-0'>
            <x-input-product-list title='Product' :products='optional($deliveryOrder)->products' />
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
            var $vehicle = $('select[name="vehicle_id"]');
            var $driver = $('select[name="driver_id"]');

            $numLot.select2({
                placeholder: '.. Select ..',
                ajax: {
                    delay: 250,
                    url: '{{ route("api.company") }}',
                    data: function(params) {
                        var queryParameters = {
                            isCustomer: true,
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

            $vehicle.select2({
                placeholder: '.. Select ..',
                ajax: {
                    delay: 250,
                    url: '{{ route("api.vehicle") }}',
                    processResults: function(data) {
                        return {
                            results: $.map(data.data, function(obj) {
                                return {
                                    id: obj.id,
                                    text: obj.full_name,
                                };
                            })
                        };
                    }
                }
            });

            $driver.select2({
                placeholder: '.. Select ..',
                ajax: {
                    delay: 250,
                    url: '{{ route("api.users") }}',
                    data: function(params) {
                        var queryParameters = {
                            roles: 'driver',
                        }

                        return queryParameters;
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data.data, function(obj) {
                                return {
                                    id: obj.id,
                                    text: obj.fullname,
                                };
                            })
                        };
                    }
                }
            });
        });
    </script>
@endpush