@extends('_layouts.base')

@section('title', 'Create Roles' )

@section('css')
<link rel="stylesheet" href="{{ URL::asset('plugins/select2/css/select2.min.css') }}">
@endsection

@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-4">

        @if(isset($role))

            {{-- Update Role --}}
            <h2 class="mb-3"> Update Role </h2>

            <form action='{{ route("role.update", ['role' => $role->id]) }}' method='POST' class="form-horizontal">
            @method('PUT')

                {{-- ./Update Role --}}
            @else

            {{-- Create Role --}}
            <h2 class="mb-3"> Create Role </h2>

            <form action='{{ route("role.store") }}' method='POST' class="form-horizontal">
            @method('POST')

            @php
                $role = null;
            @endphp

            {{-- ./Create Role --}}
        @endif

        {{-- Token --}}
        @csrf
        
            <x-card>
                <x-input name='name' label='Name' :bind="$role" />

                @foreach ($permissions as $permission)
                    <x-checkbox name='permissions[{{$loop->index}}]' :label='ucwords($permission->name)' :value='$permission->name' :checked="$role->hasPermissionTo($permission->name)" />
                @endforeach

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