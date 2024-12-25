@extends('layouts.app')
@section('title', '-' . $secondPositionName)
@section('content')
    <x-pages.breadcrumbs :$secondPositionUrl :$secondPositionName />
    <section>
        @livewire('base-page', ['regionCode' => $regionCode, 'type' => $type])
    </section>
@endsection
