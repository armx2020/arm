@extends('layouts.app')
@section('title', '- СООБЩИТЕ НАМ')
@section('content')
    <x-pages.breadcrumbs :$secondPositionUrl :$secondPositionName/>
    <section>
        @livewire('inform-us-form', [])
    </section>
@endsection
