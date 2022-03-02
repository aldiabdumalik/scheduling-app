@extends('layouts.admin')
@section('title', 'Master Users')
@section('content')
<div class="row">
    <div class="col-12">
        <form id="users-form">
            <div class="card-box">
                <div class="row">
                    <div class="col-sm-12 col-xl-4">
                        <input type="hidden" name="users-id" id="users-id" class="form-control">
                        <div class="form-group">
                            <label for="users-name">Name</label>
                            <input type="text" name="users-name" id="users-name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="users-email">Email</label>
                            <input type="email" name="users-email" id="users-email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="users-level">Level</label>
                            <select name="users-level" id="users-level" class="form-control" required>
                                <option value="">Change level</option>
                                @foreach ($user_role as $role)
                                <option value="{{$role->id}}">{{$role->name_level}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-8">
                        <div class="form-group">
                            <label for="users-photo">Upload photo</label>
                            <input type="file" name="users-photo" id="users-photo" class="dropify" data-height="200" />
                        </div>
                        <div class="form-group clearfix">
                            <button type="submit" id="users-submit" class="btn btn-custom float-right">Create users</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('page-js')
    <script type="module" src="{{asset('assets/js/users.js')}}"></script>
@endpush