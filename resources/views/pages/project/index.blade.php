@extends('layouts.app')
@section('title', '- ПРОЕКТЫ')
@section('content')
    <x-pages.breadcrumbs :$secondPositionUrl :$secondPositionName />
    <section>
        @livewire('base-page', ['regionCode' => $regionCode, 'entity' => $entity])
    </section>
@endsection
