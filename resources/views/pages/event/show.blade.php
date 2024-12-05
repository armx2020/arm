@extends('layouts.app')
@section('title', '- АФИША')
@section('content')

    <x-pages.breadcrumbs secondPositionUrl="{{ route('events.index') }}" secondPositionName='События'
        fourthPositionUrl="{{ route('events.show', ['id' => $entity->id]) }}" fourthPositionName="{{ $entity->name }}" />

    <x-pages.entity-card :$entity />
@endsection
