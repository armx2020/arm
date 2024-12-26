@extends('layouts.app')
@section('title', '- МАРКЕТ')
@section('content')
    <x-pages.breadcrumbs secondPositionUrl="" secondPositionName='{{ $entity->type->name}}' fourthPositionUrl=""
        fourthPositionName="{{ $entity->name }}" />

    <x-pages.entity-card :$entity />
@endsection
