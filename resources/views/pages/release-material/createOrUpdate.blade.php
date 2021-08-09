@extends('_layouts.base')

@section('title', 'Create Release Material')

@section('css')
<!-- Select2  -->
<link rel="stylesheet" href="{{ URL::asset('plugins/select2/css/select2.min.css') }}">
<!-- Date Range Picker  -->
<link rel="stylesheet" href="{{ URL::asset('plugins/daterangepicker/daterangepicker.css') }}">
@endsection

@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-6">

        @if(isset($releaseMaterial))

            {{-- Update Release Material --}}
            <h2 class="mb-3"> Update Release Material </h2>

            <form action='{{ route("release-material.update", ['release_material' => $releaseMaterial->id]) }}' method='POST' class="form-horizontal">
            @method('PUT')

            {{-- ./Update Release Material --}}
        @else

            {{-- Create Release Material --}}
            <h2 class="mb-3"> Create Release Material </h2>

            <form action='{{ route("release-material.store") }}' method='POST' class="form-horizontal">
            @method('POST')

            @php
                $releaseMaterial = null;
                $product = null
            @endphp

        @endif

        {{-- Token --}}
        @csrf

            <x-card theme-mode='outline' theme='primary'>

                <div class="row">
                    <div class="col-6">
                        <x-input name='date' label="Release Date" :bind='$releaseMaterial' daterangepicker />
                    </div>
                    <div class="col-6">
                        <x-input name='lot' label='No. Lot' :bind='$releaseMaterial' />
                    </div>
                    <div class="col-12">
                        <x-select name='product_id' :option='$product ? [$product->id => $product->name] : []' label='Product'/>
                    </div>
                </div>

            </x-card>

            <x-card theme-mode='outline' theme='primary' body-class='p-0'>
                <x-input-product-list title='Material' product-type='Raw Material' :products='optional($releaseMaterial)->products' />
            </x-card>

            <div class="row">
                <div class="col-6 align-items-center" style="font-size: 24px;">
                    <label for="total">Material Weight :</label><b><span id='total'> 0 Kg</span></b>
                </div>
                <div class="col-6 text-right">
                    <span class="text-danger">
                        
                        @error('location') {{ $message }} @enderror
                        @error('product.*') {{ $message }} @enderror
                    </span>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection

@section('js')
<!-- Select2  -->
<script src="{{ URL::asset('plugins/select2/js/select2.full.min.js') }}"></script>
<!-- MomentJS  -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<!-- Date Range Picker  -->
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Datatable Script -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        $('select[name="product_id"]').select2({
            placeholder: 'Choose a product that will produced',
            ajax: {
                delay: 1000,
                url: '{{ route("api.products") }}',
                data: function(params) {
                    return {
                        search: params.term,
                        option: true,
                        type: "Finish Good"
                    }
                },
                processResults: function(data) {
                    return {
                        results: $.map(data.data, function(obj) {
                            return {
                                id: obj.id,
                                text: obj.name
                            };
                        })
                    };
                }
            }
        });
    });
</script>
@endpush