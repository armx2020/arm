@extends('layouts.app')
@section('title', '- МАРКЕТ')
@section('content')
    <x-pages.breadcrumbs secondPositionUrl="{{ route('companies.index') }}" secondPositionName='Компании' />
        <section>
            @livewire('select-companies', ['regionCode' => $regionCode])
        </section>
@endsection
