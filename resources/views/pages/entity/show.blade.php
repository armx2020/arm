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

@section('content')
    <x-pages.breadcrumbs :$secondPositionUrl secondPositionName='{{ $entity->type->name }}' fourthPositionUrl=""
        fourthPositionName="{{ $entity->name }}" />

    <x-pages.entity-card :$entity />
@endsection
