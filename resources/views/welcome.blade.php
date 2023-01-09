@extends('layouts.app')

@section('content')

<div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <h5>Login Detail</h5>
                <hr>
                <h5>Email: admin@gmail.com</h5>
                <h5>Password: Admin@123</h5>
                <a href="{{asset('assets/task_igtapps.sql')}}" download>Download Database File</a>
            </div>
        </div>
</div>

@endsection
