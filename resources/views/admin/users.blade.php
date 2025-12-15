@extends('layouts.app')

@section('title', 'User Management - Festivo')

@push('styles')
    <style>
        .admin-users {
            padding: 120px 0 60px;
            background-color: #f8f9fa;
            min-height: 100vh;
        }
    </style>
@endpush

@section('content')
    <div class="admin-users">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="fw-bold" style="color: #360185;">User Management</h1>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back to Dashboard
                </a>
            </div>

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Email Verified</th>
                                <th>Registered</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->role === 'admin')
                                    <span class="badge bg-danger">Admin</span>
                                    @elseif($user->role === 'eventManager')
                                    <span class="badge bg-success">Event Manager</span>
                                    @else
                                    <span class="badge bg-primary">User</span>
                                    @endif
                                </td>
                                <td>
                                    @if($user->email_verified_at)
                                    <span class="badge bg-success"><i class="bi bi-check-circle"></i> Verified</span>
                                    @else
                                    <span class="badge bg-warning"><i class="bi bi-exclamation-circle"></i> Not Verified</span>
                                    @endif
                                </td>
                                <td>{{ $user->created_at->format('M d, Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="d-flex justify-content-center mt-4">
                    {{ $users->links() }}
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5><i class="bi bi-people-fill"></i> Regular Users</h5>
                        <h2>{{ $users->where('role', 'user')->count() }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5><i class="bi bi-person-badge"></i> Event Managers</h5>
                        <h2>{{ $users->where('role', 'eventManager')->count() }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-danger">
                    <div class="card-body">
                        <h5><i class="bi bi-shield-fill"></i> Admins</h5>
                        <h2>{{ $users->where('role', 'admin')->count() }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
