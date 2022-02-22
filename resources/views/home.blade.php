@extends('layouts.app')
@section('title', 'Trang chủ')
@section('breadcrumb', Breadcrumbs::render('home'))
@section('content')
<div class="row">
    <div class="col-sm-12">
        @livewire('report')
    </div>
    <div class="col-sm-12">
        @livewire('declaration-list')
    </div>
    <div class="col-sm-12">
        @livewire('location-stat')
    </div>
</div>
@endsection
