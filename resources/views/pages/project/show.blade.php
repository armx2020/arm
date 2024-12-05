@extends('layouts.app')
@section('title', '- ПРОЕКТЫ')
@section('content')

    <x-pages.breadcrumbs secondPositionUrl="{{ route('projects.index') }}" secondPositionName='Проекты'
        fourthPositionUrl="{{ route('projects.show', ['id' => $entity->id]) }}" fourthPositionName="{{ $entity->name }}" />

    <x-pages.entity-card :$entity />
@endsection
