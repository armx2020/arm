@extends('layouts.app')
@section('title', '- МАРКЕТ')
@section('content')
    <x-pages.breadcrumbs :$secondPositionUrl :$secondPositionName />
    <section>
        @livewire('base-page', ['regionCode' => $regionCode, 'entity' => $entity])
    </section>
@endsection
