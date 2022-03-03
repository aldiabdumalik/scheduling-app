@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
    <b>{{auth()->user()->load('employee')->employee->name}}</b>
@endsection