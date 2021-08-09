@extends('_layouts.base')

@section('title', 'Create Rack' )

@section('css')
<link rel="stylesheet" href="{{ URL::asset('plugins/select2/css/select2.min.css') }}">
@endsection

@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-4">

        @if(isset($rack))

            {{-- Update Rack --}}
            <h2 class="mb-3"> Update Rack </h2>

            <form action='{{ route("racks.update", ['rack' => $rack->id]) }}' method='POST'>
            @method('PUT')

                {{-- ./Update Rack --}}
            @else

            {{-- Create Rack --}}
            <h2 class="mb-3"> Create Rack </h2>

            <form action='{{ route("warehouse.racks.store", ["warehouse" => $warehouse->id]) }}' method='POST'>
            @method('POST')

            @php
                $rack = null;
            @endphp
            {{-- ./Create Rack --}}
        @endif

        {{-- Token --}}
        @csrf
        
        <input type="hidden" id="warehouse_id" name="warehouse_id" value="{{$warehouse->id}}">

        <x-card>

            <x-input name='code' type='text' label='Code*' :bind="$rack" />
            <x-input name='name' label='On Warehouse' :bind="$warehouse" disabled />
            <x-input name='note' type='text' label='Note' placeholder="Describe what is the use of this rack" :bind="$rack" />

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