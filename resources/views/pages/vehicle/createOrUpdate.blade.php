@extends('_layouts.base')

@section('title', 'Create Vehicle' )

@section('css')
<link rel="stylesheet" href="{{ URL::asset('plugins/select2/css/select2.min.css') }}">
@endsection

@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-4">

        @if(isset($vehicle))

            {{-- Update Vehicle --}}
            <h2 class="mb-3"> Update Vehicle </h2>

            <form action='{{ route("vehicle.update", ['vehicle' => $vehicle->id]) }}' method='POST'>
            @method('PUT')

                {{-- ./Update Vehicle --}}
            @else

            {{-- Create Vehicle --}}
            <h2 class="mb-3"> Create Vehicle </h2>

            <form action='{{ route("vehicle.store") }}' method='POST'>
            @method('POST')

            @php
                $vehicle = null;
            @endphp
            {{-- ./Create Vehicle --}}
        @endif

        {{-- Token --}}
        @csrf

        <x-card>

            <x-input name='name' type='text' label='Name' :bind="$vehicle" />
            <x-input name='plateNumber' label='Plate Number' :bind="$vehicle" />
            <x-input name='loadCapacity' type='number' label='Load Capacity' placeholder="Maximum Capacity" :bind="$vehicle" />

        </x-card>

        <div class="text-right">
            <button type="submit" class="btn btn-primary mt-3">Save</button>
        </div>

        </form>
    </div>
</div>
@endsection

@section('js')
<script src="{{ URL::asset('plugins/select2/js/select2.full.min.js') }}"></script>
@endsection