@extends('layouts.app')

@section('title', 'User Management - Festivo')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin-users.css') }}">
@endpush

@section('content')
    <div class="admin-users">
        <div class="container">
            <h1 class="fw-bold mb-4" style="color: #360185;">User Management</h1>

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <!-- User Statistics -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card text-white bg-primary">
                        <div class="card-body">
                            <h5><i class="bi bi-people-fill"></i> Regular Users</h5>
                            <h2>{{ $stats['regular_users'] }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-success">
                        <div class="card-body">
                            <h5><i class="bi bi-person-badge"></i> Event Managers</h5>
                            <h2>{{ $stats['event_managers'] }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-danger">
                        <div class="card-body">
                            <h5><i class="bi bi-shield-fill"></i> Admins</h5>
                            <h2>{{ $stats['admins'] }}</h2>
                        </div>
                    </div>
                </div>
            </div>

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
                                <th>Actions</th>
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
                                    <span class="badge bg-success"><i class="bi bi-calendar-event me-1"></i>Event Manager</span>
                                    @elseif($user->role === 'vendorManager')
                                    <span class="badge bg-info"><i class="bi bi-shop me-1"></i>Vendor Manager</span>
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
                                <td>
                                    @if($user->role === 'eventManager' || $user->role === 'vendorManager')
                                    @php
                                        $roleLabel = $user->role === 'eventManager' ? 'Event Manager' : 'Vendor Manager';
                                    @endphp
                                    <form action="{{ route('admin.users.revoke-manager', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to revoke {{ $roleLabel }} role from {{ $user->name }}?');">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-warning" title="Revoke {{ $roleLabel }} Role">
                                            <i class="bi bi-x-circle"></i> Revoke Role
                                        </button>
                                    </form>
                                    @elseif($user->role === 'user')
                                    <span class="text-muted">-</span>
                                    @else
                                    <span class="text-muted">Admin</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                @if($users->hasPages())
                    <div class="d-flex justify-content-center align-items-center mt-4">
                        <nav aria-label="Users pagination">
                            <ul class="pagination mb-0" style="gap: 8px;">
                                {{-- Previous Page Link --}}
                                @if ($users->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link" style="border-radius: 8px; border: 1px solid #dee2e6; background: #f8f9fa;">
                                            <i class="bi bi-chevron-left"></i>
                                        </span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $users->previousPageUrl() }}" style="border-radius: 8px; border: 1px solid #360185; color: #360185;">
                                            <i class="bi bi-chevron-left"></i>
                                        </a>
                                    </li>
                                @endif

                                {{-- Page Numbers --}}
                                @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                                    @if ($page == $users->currentPage())
                                        <li class="page-item active">
                                            <span class="page-link" style="border-radius: 8px; background: #360185; border: 1px solid #360185; min-width: 38px; text-align: center;">{{ $page }}</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $users->url($page) }}" style="border-radius: 8px; border: 1px solid #dee2e6; color: #360185; min-width: 38px; text-align: center;">{{ $page }}</a>
                                        </li>
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                @if ($users->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $users->nextPageUrl() }}" style="border-radius: 8px; border: 1px solid #360185; color: #360185;">
                                            <i class="bi bi-chevron-right"></i>
                                        </a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <span class="page-link" style="border-radius: 8px; border: 1px solid #dee2e6; background: #f8f9fa;">
                                            <i class="bi bi-chevron-right"></i>
                                        </span>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                @endif
            </div>
        </div>
    </div>
    </div>
@endsection
