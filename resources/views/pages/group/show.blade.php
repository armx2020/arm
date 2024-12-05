@extends('layouts.app')
@section('title', '- ГРУППЫ')
@section('content')

    <x-pages.breadcrumbs secondPositionUrl="{{ route('groups.index') }}" secondPositionName='Группы'
        fourthPositionUrl="{{ route('groups.show', ['id' => $entity->id]) }}" fourthPositionName="{{ $entity->name }}" />

    <x-pages.entity-card :$entity />
@endsection
