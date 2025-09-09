@extends('layout.app')
@section('content')
    @include('layout.topnav')
    <div id="layoutSidenav">
        @include('layout.sidenav')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Contacts</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Contacts</li>
                    </ol>
                    
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Filters and Actions -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="mb-0">Filter Contacts</h6>
                                </div>
                                <div class="col-auto">
                                    <a href="{{ route('contacts.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Add Contact
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="{{ route('contacts.index') }}" class="row g-3">
                                <div class="col-md-4">
                                    <label for="search" class="form-label">Search</label>
                                    <input type="text" class="form-control" id="search" name="search" 
                                           value="{{ request('search') }}" placeholder="Search contacts...">
                                </div>
                                <div class="col-md-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" id="status" name="status">
                                        <option value="">All Statuses</option>
                                        <option value="lead" {{ request('status') == 'lead' ? 'selected' : '' }}>Lead</option>
                                        <option value="prospect" {{ request('status') == 'prospect' ? 'selected' : '' }}>Prospect</option>
                                        <option value="customer" {{ request('status') == 'customer' ? 'selected' : '' }}>Customer</option>
                                        <option value="partner" {{ request('status') == 'partner' ? 'selected' : '' }}>Partner</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="company_id" class="form-label">Company</label>
                                    <select class="form-select" id="company_id" name="company_id">
                                        <option value="">All Companies</option>
                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}" {{ request('company_id') == $company->id ? 'selected' : '' }}>
                                                {{ $company->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">&nbsp;</label>
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-outline-primary">Filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Contacts Table -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Contacts List
                        </div>
                        <div class="card-body">
                            @if($contacts->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Job Title</th>
                                                <th>Company</th>
                                                <th>Status</th>
                                                <th>Lead Score</th>
                                                <th>Assigned To</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($contacts as $contact)
                                                <tr>
                                                    <td>
                                                        <strong>{{ $contact->full_name }}</strong>
                                                    </td>
                                                    <td>
                                                        <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                                                    </td>
                                                    <td>{{ $contact->phone ?? 'N/A' }}</td>
                                                    <td>{{ $contact->job_title ?? 'N/A' }}</td>
                                                    <td>
                                                        @if($contact->company)
                                                            <a href="#" class="text-decoration-none">{{ $contact->company->name }}</a>
                                                        @else
                                                            <span class="text-muted">No Company</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <span class="badge 
                                                            @if($contact->status == 'lead') bg-warning
                                                            @elseif($contact->status == 'prospect') bg-info
                                                            @elseif($contact->status == 'customer') bg-success
                                                            @elseif($contact->status == 'partner') bg-primary
                                                            @endif">
                                                            {{ ucfirst($contact->status) }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="progress" style="height: 20px;">
                                                            <div class="progress-bar" role="progressbar" 
                                                                 style="width: {{ $contact->lead_score }}%"
                                                                 aria-valuenow="{{ $contact->lead_score }}" 
                                                                 aria-valuemin="0" aria-valuemax="100">
                                                                {{ $contact->lead_score }}%
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @if($contact->assignedTo)
                                                            {{ $contact->assignedTo->first_name }} {{ $contact->assignedTo->last_name }}
                                                        @else
                                                            <span class="text-muted">Unassigned</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a href="{{ route('contacts.show', $contact) }}" 
                                                               class="btn btn-sm btn-outline-info" title="View">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <a href="{{ route('contacts.edit', $contact) }}" 
                                                               class="btn btn-sm btn-outline-warning" title="Edit">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <form action="{{ route('contacts.destroy', $contact) }}" 
                                                                  method="POST" class="d-inline"
                                                                  onsubmit="return confirm('Are you sure you want to delete this contact?')">
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
                                <div class="d-flex justify-content-center">
                                    {{ $contacts->appends(request()->query())->links() }}
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">No contacts found</h5>
                                    <p class="text-muted">Start by adding your first contact or adjust your filters.</p>
                                    <a href="{{ route('contacts.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Add Contact
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
