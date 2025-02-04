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

@section('content')
    <x-pages.breadcrumbs :$secondPositionUrl secondPositionName='{{ $entity->type->name }}' fourthPositionUrl=""
        fourthPositionName="{{ $entity->name }}" />

    <x-pages.entity-card :$entity />
@endsection
