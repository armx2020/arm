@extends('layouts.app')

@php
    $sitemap = App\Models\SiteMap::where('url', url()->current())->First();

    $title = 'Все армяне';
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

@section('content')
    <x-pages.breadcrumbs :$secondPositionUrl secondPositionName='{{ $entity->type->name }}' fourthPositionUrl=""
        fourthPositionName="{{ $entity->name }}" />

    @if (session('success'))
        <div class="mt-5 w-full rounded-lg bg-green-100 px-6 py-5 text-base text-green-700" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <x-pages.entity-card :$entity />

    <x-inform-us.index/>
@endsection
