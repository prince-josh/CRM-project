@extends('layout.app')
@section('content')
    @include('layout.topnav')
    <div id="layoutSidenav">
        @include('layout.sidenav')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">User Invitations</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">User Invitations</li>
                    </ol>
                    
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif


                    <!-- invites Table -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            User Invitations List
                        </div>
                        <div class="card-body">
                            @if($userInvitations->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Invited By</th>
                                                <th>Expires At</th>
                                                <th>Status</th>
                                                <th>Accepted At</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($userInvitations as $userInvitation)
                                                <tr>
                                                    <td>
                                                        <strong>{{ $userInvitation->full_name }}</strong>
                                                    </td>
                                                    <td>
                                                        <a href="mailto:{{ $userInvitation->email }}">{{ $userInvitation->email }}</a>
                                                    </td>
                                                    <td>{{ $userInvitation->phone ?? 'N/A' }}</td>
                                                    <td>{{ $userInvitation->job_title ?? 'N/A' }}</td>
                                                    <td>
                                                        @if($userInvitation->company)
                                                            <a href="#" class="text-decoration-none">{{ $userInvitation->company->name }}</a>
                                                        @else
                                                            <span class="text-muted">No Company</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <span class="badge 
                                                            @if($userInvitation->status == 'lead') bg-warning
                                                            @elseif($userInvitation->status == 'prospect') bg-info
                                                            @elseif($userInvitation->status == 'customer') bg-success
                                                            @elseif($userInvitation->status == 'partner') bg-primary
                                                            @endif">
                                                            {{ ucfirst($userInvitation->status) }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="progress" style="height: 20px;">
                                                            <div class="progress-bar" role="progressbar" 
                                                                 style="width: {{ $userInvitation->lead_score }}%"
                                                                 aria-valuenow="{{ $userInvitation->lead_score }}" 
                                                                 aria-valuemin="0" aria-valuemax="100">
                                                                {{ $userInvitation->lead_score }}%
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @if($userInvitation->assignedTo)
                                                            {{ $userInvitation->assignedTo->first_name }} {{ $userInvitation->assignedTo->last_name }}
                                                        @else
                                                            <span class="text-muted">Unassigned</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a href="{{ route('user-invitations.show', $userInvitation) }}" 
                                                               class="btn btn-sm btn-outline-info" title="View">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <a href="{{ route('user-invitations.edit', $userInvitation) }}" 
                                                               class="btn btn-sm btn-outline-warning" title="Edit">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <form action="{{ route('user-invitations.destroy', $userInvitation) }}" 
                                                                  method="POST" class="d-inline"
                                                                  onsubmit="return confirm('Are you sure you want to delete this Invite?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                
                                <!-- Pagination -->
                                {{-- <div class="d-flex justify-content-center">
                                    {{ $userInvitations->appends(request()->query())->links() }}
                                </div> --}}
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">No invites found</h5>
                                    <p class="text-muted">Start by adding your first Invite or adjust your filters.</p>
                                    <a href="{{ route('user-invitations.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Add Invite
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </main>
            @include('layout.footer')
        </div>
    </div>
@endsection
