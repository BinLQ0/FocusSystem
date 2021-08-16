@extends('_layouts.base')

@section('title', 'Home')

@section('content')
<div class="title m-b-md">
    Hello, {{ Auth::user()->fullname }}
</div>
@endsection
