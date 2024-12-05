@extends('layouts.app')
@section('title', '- РАБОТА')
@section('content')
    <x-pages.breadcrumbs secondPositionUrl="{{ route('works.index') }}" secondPositionName='Работа'
        fourthPositionUrl="{{ route('works.show', ['id' => $entity->id]) }}" fourthPositionName="{{ $entity->name }}" />
    <x-pages.entity-card :$entity />
@endsection
