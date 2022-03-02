@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
    <b>{{auth()->user()->name}}</b>
@endsection