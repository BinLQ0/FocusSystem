@extends('_layouts.base')

@section('title', 'Job Cost')

@section('css')

<link rel="stylesheet" href="{{ URL::asset('plugins/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('plugins/daterangepicker/daterangepicker.css') }}">

@endsection

@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-6">

        @if(isset($jobCost))

            {{-- Update Jobcost --}}
            <h2 class="mb-3"> Update Jobcost </h2>

            <form action='{{ route("job-cost.update", ['job_cost' => $jobCost->id]) }}' method='POST' class="form-horizontal">
                @method('PUT')

            {{-- ./Update Jobcost --}}
        @else

            {{-- Create Jobcost --}}
            <h2 class="mb-3"> Create Jobcost </h2>

            <form action='{{ route("job-cost.store") }}' method='POST' class="form-horizontal">
                @method('POST')

                @php
                    $jobCost = null;
                @endphp
        @endif

        {{-- Token --}}
        @csrf

        <x-card>

            <div class="row">
                <div class="col-sm-6">
                    <x-input daterangepicker name='date' label="Date" :bind='$jobCost' />
                </div>
                <div class="col-sm-6">
                    <x-select name='for' type='text' label='Used For...' :option='$jobCost ? [optional($jobCost->references)->id => optional($jobCost->references)->name] : []' :selected='$jobCost ? [optional($jobCost->references)->id] : []' />
                </div>
                <div class="col-sm-12">
                    <x-input name='description' label='Note' placeholder='(Optional)' :bind='$jobCost' />
                </div>
            </div>
        </x-card>

        <x-card theme-mode='outline' theme='primary' body-class='p-0'>
            <x-input-product-list title='Items' :products='optional($jobCost)->products' />
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
            var $numLot = $('select[name="for"]');

            $numLot.select2({
                placeholder : '.. Select ..',
                ajax: {
                    delay: 250,
                    url: '{{ route("api.job-cost-referance") }}',
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

            $numLot.on('select2:select', function(evt) {
                var product = evt.params.data.product;
                var used = Number.parseFloat(evt.params.data.used);

                $('input[name="eproduct"]').val(product);
                $('input[name="materialUsed"]').val(used);
            });
        });
    </script>
@endpush