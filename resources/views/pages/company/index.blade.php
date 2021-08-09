@extends('_layouts.base')

@section('title', 'Relation List')

@section('css')
<link rel="stylesheet" href="{{ URL::asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ URL::asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}	">

<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-10">

        <h2> RELATION COMPANY </h2>

        <div class="row d-flex justify-content-between">

            <div class="col-4">
                <x-button id='btn_create' :url='route("company.create")' class='bg-success btn-sm'
                    icon='far fa-plus-square' label='Create' />
            </div>

            <div class="col-4">
                <x-input name='search' placeholder='Search' class="form-control-sm search-input" />
            </div>

        </div>

        <x-card theme-mode='outline' theme='primary' component='tables.company-table' body-class='p-0' />
    </div>
</div>
@endsection

@section('js')
<script src="{{ url::asset('plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ url::asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ url::asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
@endsection
