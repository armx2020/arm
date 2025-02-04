@extends('layouts.app')

@php
    $sitemap = App\Models\SiteMap::where('url', url()->current())->First();

    $title = 'ВСЕ АРМЯНЕ';
    $description = 'Сообщество армян в России';

    if ($sitemap) {
        $title = $sitemap->title;
        $description = $sitemap->description;
    }

@endphp

@section('title')
    <title>{{ $title }}
    </title>
@endsection

@section('meta')
    <meta name="robots" content="index, follow" />
    <meta name="description" content="{{ $description }}">
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
