@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

@include('landing.hero')

@include('landing.about')

@include('landing.services')

@include('landing.statistics')

@include('landing.products')

@include('landing.cta')

@endsection