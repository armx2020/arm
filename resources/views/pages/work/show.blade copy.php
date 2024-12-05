@extends('layouts.app')
@section('title', '- НОВОСТИ')
@section('content')

    <x-pages.breadcrumbs secondPositionUrl="{{ route('news.index') }}" secondPositionName='Новости'
        fourthPositionUrl="{{ route('news.show', ['id' => $entity->id]) }}" fourthPositionName="{{ $entity->name }}" />

    <x-pages.entity-card :$entity />
@endsection
