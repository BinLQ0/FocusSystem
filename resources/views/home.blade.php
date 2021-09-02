@extends('_layouts.base')

@section('title', 'Home')

@section('css')
<!-- Sweet Alert 2 -->
<link rel="stylesheet" href="{{ URL::asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}	">
@endsection

@section('content')
<div class="title m-b-md">
    Hello, {{ Auth::user()->fullname }}
</div>
@endsection

@section('js')
<!-- SweetAlert 2 -->
<script src="{{ url::asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
@endsection
