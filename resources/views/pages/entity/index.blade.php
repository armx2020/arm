@extends('layouts.app')
@section('title', '- ' . $secondPositionName)
@section('content')
    <x-pages.breadcrumbs :$secondPositionUrl :$secondPositionName />
    <section>
        @livewire('base-page', ['region' => $region, 'type' => $type, 'routeShow' => $routeShow])
    </section>
@endsection
