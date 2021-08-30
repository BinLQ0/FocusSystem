@extends('_layouts.base')

@section('title', 'Data Stocktaking')

@section('css')

<link rel="stylesheet" href="{{ URL::asset('plugins/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('plugins/daterangepicker/daterangepicker.css') }}">

@endsection

@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-4">

        <h2 class="mb-3"> Stocktaking </h2>

        <form action='{{ route("export.stock") }}' method='POST'>
            @method('POST')

            <x-card theme-mode='outline' theme='primary'>

                <div class="row">
                    <div class="col-12">
                        <x-input daterangepicker name='date' label="Cut off Date" />
                    </div>
                </div>

            </x-card>

            <div class="text-right">
                <button type="submit" class="btn btn-primary">Download</button>
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