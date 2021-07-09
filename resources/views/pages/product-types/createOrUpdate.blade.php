@extends('_layouts.base')

@section('title', 'Create Product Type' )

@section('css')
<link rel="stylesheet" href="{{ URL::asset('plugins/select2/css/select2.min.css') }}">
@endsection

@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-4">

        @if(isset($productType))

            {{-- Update Product Type --}}
            <h2 class="mb-3"> Update Product Type </h2>

            <form action='{{ route("product-type.update", ['product_type' => $productType->id]) }}' method='POST' class="form-horizontal">
                @method('PUT')

                {{-- ./Update Product Type --}}
            @else

                {{-- Create Product Type --}}
                <h2 class="mb-3"> Create Product Type </h2>

                <form action='{{ route("product-type.store") }}' method='POST' class="form-horizontal">
                    @method('POST')

                    @php
                        $productType = null;
                    @endphp

                    {{-- ./Create Product Type --}}
        @endif

        {{-- Token --}}
        @csrf

        <x-card>
            <x-input name='name' label='Name' :bind="$productType" />
            <x-input name='description' type='text' label='Description' :bind="$productType" />

            <label for="" class="mb-2">Category</label>
            <div class="row">
                <div class="col-6">
                    <x-checkbox name='is_material' label='Raw Material' margin='mb-2' :checked='optional($productType)->is_material' />
                </div>
                <div class="col-6">
                    <x-checkbox name='is_goods' label='Finish Goods' margin='mb-2' :checked='optional($productType)->is_goods' />
                </div>
            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-primary mt-3">Save</button>
            </div>
        </x-card>

        </form>
    </div>
</div>
@endsection

@section('js')
<script src="{{ URL::asset('plugins/select2/js/select2.full.min.js') }}"></script>
@endsection