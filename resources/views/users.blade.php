@extends('layouts.admin')
@section('title', 'Master Users')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box table-responsive">
                <div class="pt-3 pb-3 pr-3 clearfix">
                    <a href="{{route('users.post_view')}}" class="btn btn-custom float-right">Create User</a>
                </div>
                <table id="users_table" class="table table-bordered table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('page-js')
    <script type="module" src="{{asset('assets/js/users.js')}}"></script>
@endpush