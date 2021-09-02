@extends('_layouts.base')

@section('title', 'User Management')

@section('css')

{{-- Select 2 --}}
<link rel="stylesheet" href="{{ URL::asset('plugins/select2/css/select2.min.css') }}">
@endsection

@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-3">

        @if(isset($user))

            {{-- Update User --}}
            <h2 class="mb-3"> Update Profile User </h2>

            <form action='{{ route("user.update", ['user' => $user->id]) }}' method='POST'>
                @method('PUT')
                {{-- ./Update User --}}

            @else

                {{-- Create User --}}
                <h2 class="mb-3"> Create User </h2>

                <form action='{{ route("user.store") }}' method='POST'>
                    @method('POST')
                    {{-- ./Create User --}}

                    @php
                        $user = null
                    @endphp

        @endif

        {{-- Token --}}
        @csrf

        <x-card theme='primary' theme-mode='outline'>

            <x-input name='username' label='Username' :bind='$user' />
            <x-input name='fullname' label='Full Name' :bind='$user' />
            <x-select name='role_id' label='Role' :option='$user ? [optional($user->roles->first())->id => optional($user->roles->first())->name] : []'
                :selected='optional($user->roles->first())->id'/>

        </x-card>

        <div class="text-right">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>

        </form>
    </div>

    @if(isset($user))
        <div class="col-3">
            <h2 class="mb-3"> Change Password </h2>

            <form action='{{ route("user.change.password", ['user' => $user->id]) }}' method='POST' class='mt-3'>
                @method('PUT')

                {{-- Token --}}
                @csrf

                <x-card theme='primary' theme-mode='outline'>
                    <x-input name='password' type='password' label='Password' placeholder='******' />
                    <x-input name='password_confirmation' type='password' label='Password Confirmation' placeholder='******' />
                </x-card>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Change</button>
                </div>

            </form>
        </div>
    @endif
</div>
@endsection

@section('js')
{{-- Select 2 --}}
<script src="{{ URL::asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    $(document).ready(function() {
            var $numLot = $('select[name="role_id"]');

            $numLot.select2({
                placeholder: '.. Select Role ..',
                ajax: {
                    delay: 250,
                    url: '{{ route("api.role") }}',
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
@endsection