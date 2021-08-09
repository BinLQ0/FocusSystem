@extends('_layouts.base')

@section('title', 'Company')

@section('css')
<link rel="stylesheet" href="{{ URL::asset('plugins/select2/css/select2.min.css') }}">
@endsection

@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-4">

        @if(isset($company))

            {{-- Update Company --}}
            <h2 class="mb-3"> Update Company </h2>

            <form action='{{ route("company.update", ['company' => $company->id]) }}' method='POST'
                class="form-horizontal">
                @method('PUT')

            {{-- ./Update Company --}}
        @else

            {{-- Create Company --}}
            <h2 class="mb-3"> Create Company </h2>

            <form action='{{ route("company.store") }}' method='POST' class="form-horizontal">
                @method('POST')

            @php
                $company = null;
            @endphp

            {{-- ./Create Company --}}
        @endif

        {{-- Token --}}
        @csrf

        <x-card>

            <x-input name='name' type='text' label='Company Name' :bind='$company' />
            <x-textarea name='address' type='textarea' label='Address' :bind='$company' />

            <label for="" class="mb-1">Company As :</label>
            <div class="row">
                <div class="col-6">
                    <x-checkbox name='is_supplier' label='Supplier' margin='mb-2' :checked='optional($company)->is_supplier' />
                </div>
                <div class="col-6">
                    <x-checkbox name='is_customer' label='Customer' margin='mb-2' :checked='optional($company)->is_customer' />
                </div>
            </div>

        </x-card>

        <div class="text-right">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>

            </form>
    </div>
</div>
@endsection

@section('js')
<script src="{{ URL::asset('plugins/select2/js/select2.full.min.js') }}"></script>
@endsection