@extends('layouts.app')

@section('title')
    <title>{{ App\Models\SiteMap::select('url')->where('url', url()->current())->first()?->title }}
    </title>
@endsection

@section('meta')
    <meta name="robots" content="index, follow" />
    <meta name="description"
        content="{{ App\Models\SiteMap::select('url')->where('url', url()->current())->first()?->description }}">
@endsection

@section('scripts')
    @livewireStyles
@endsection

@section('content')
    <x-pages.breadcrumbs :$secondPositionUrl :$secondPositionName />
    <section>
        @livewire('base-page', ['region' => $region, 'type' => $type, 'categoryUri' => $categoryUri])
    </section>
@endsection

@section('body')
    @livewireScripts
@endsection
