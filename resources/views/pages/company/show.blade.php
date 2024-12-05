@extends('layouts.app')
@section('title', '- МАРКЕТ')
@section('content')

    <x-pages.breadcrumbs secondPositionUrl="{{ route('companies.index') }}" secondPositionName='Компании'
        fourthPositionUrl="{{ route('companies.show', ['id' => $entity->id]) }}" fourthPositionName="{{ $entity->name }}" />

    <x-pages.entity-card :$entity />
@endsection
