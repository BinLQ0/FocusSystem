@extends('_layouts.base')

@section('title', 'History')

@section('css')
<!-- DataTables CSS -->
<link rel="stylesheet" href="{{ URL::asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="{{ URL::asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
<!-- Date Rangepicker CSS -->
<link rel="stylesheet" href="{{ URL::asset('plugins/daterangepicker/daterangepicker.css') }}">
@endsection

@section('content')

<div class="row">
    <div class="col-2">

        {{-- Filter --}}
        <x-card>
            <x-input daterangepicker id='srcDateStart' name='srcDateStart' label='Date From' class='dt-search form-control-sm' />
            <x-input daterangepicker id='srcDateEnd' name='srcDateEnd' label='Date To' class='dt-search form-control-sm' />
        </x-card>
        {{-- ./Filter --}}    

        {{-- Widget Location --}}
        <x-card title='LOCATION' theme-mode='outline' theme='primary'>

            @foreach($racks as $key => $value)
                <div class="row border-bottom align-center mt-1">
                    <div class="col-6">
                        <label>{{ $key }}</label>
                    </div>
                    <div class="col-6 text-right">
                        <label>{{ $value }} Kg</label>
                    </div>
                </div>
            @endforeach

        </x-card>
        {{-- ./Widget Location --}}
    </div>

    {{-- Header --}}
    <div class="col-10">
        
        <h2><b>{{ $product->name }}</b> <span>( {{ $product->description }} )</span></h2>

        <x-card theme-mode='outline' theme='primary' body-class='p-0'>
            <x-tables.history-table :params='$product' />
        </x-card>
    </div>
    {{-- ./Header --}}

</div>

@endsection

@section('js')
<!-- DataTables -->
<script src="{{ url::asset('plugins/datatables/jquery.dataTables.js') }}"></script>
<!-- Date Rangepicker -->
<script src="{{ url::asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ url::asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- SweetAlert2 -->
<script src="{{ url::asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
@endsection