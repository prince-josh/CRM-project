@extends('layout.app')
@section('content')
    @include('layout.topnav')
    <div id="layoutSidenav">
        @include('layout.sidenav')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Add New Invite</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('user-invitations.index') }}">Invites</a></li>
                        <li class="breadcrumb-item active">Add Invite</li>
                    </ol>
                    
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-user-plus me-1"></i>
                                    Invite Information
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('user-invitations.store') }}" method="POST">
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="email" class="form-label">Email *</label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                                       id="email" name="email" value="{{ old('email') }}" required>
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="role" class="form-label">Role *</label>
                                                <select class="form-select @error('role') is-invalid @enderror" 
                                                        id="role" name="role" required>
                                                    <option value="">Select role</option>
                                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                                    <option value="manager" {{ old('role') == 'manager' ? 'selected' : '' }}>Manager</option>
                                                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                                                </select>
                                                @error('status')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-end">
                                            <a href="{{ route('user-invitations.index') }}" class="btn btn-secondary me-2">Cancel</a>
                                            <button type="submit" class="btn btn-primary">Create Invite</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                            <div class="col-lg-4">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Invite Status Guide
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <span class="badge bg-warning me-2">Lead</span>
                                        <small class="text-muted">Initial Invite, potential customer</small>
                                    </div>
                                    <div class="mb-3">
                                        <span class="badge bg-info me-2">Prospect</span>
                                        <small class="text-muted">Qualified lead showing interest</small>
                                    </div>
                                    <div class="mb-3">
                                        <span class="badge bg-success me-2">Customer</span>
                                        <small class="text-muted">Active paying customer</small>
                                    </div>
                                    <div class="mb-3">
                                        <span class="badge bg-primary me-2">Inactive</span>
                                        <small class="text-muted">Inactive Invite</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            @include('layout.footer')
        </div>
    </div>
@endsection
