@extends('layouts.app')

@section('title')
    <title>ВСЕ АРМЯНЕ
        @if (isset($secondPositionName))
            {{ ' - ' . $secondPositionName }}
        @endif
        @if (isset($regionName))
            {{ ' - ' . $regionName }}
        @endif
    </title>
@endsection

@section('meta')
@endsection

@section('scripts')
    @livewireStyles
@endsection

@section('content')
    <x-pages.breadcrumbs :$secondPositionUrl :$secondPositionName />
    <section>
        @livewire('base-page', ['region' => $region, 'type' => $type])
    </section>
@endsection

@section('body')
    @livewireScripts
@endsection
