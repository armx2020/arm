@extends('layouts.app')

@section('title')
    <title>ВСЕ АРМЯНЕ
        @if (isset($entity->type->name))
            {{ ' - ' . $entity->type->name }}
        @endif
        @if (isset($entity->name))
            {{ ' - ' . $entity->name }}
        @endif
    </title>
@endsection

@section('meta')
@endsection

@section('content')
    <x-pages.breadcrumbs :$secondPositionUrl secondPositionName='{{ $entity->type->name}}' fourthPositionUrl=""
        fourthPositionName="{{ $entity->name }}" />

    <x-pages.entity-card :$entity />
@endsection
