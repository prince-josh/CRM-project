@extends('layout.app')
@section('content')
    @include('layout.topnav')
    <div id="layoutSidenav">
        @include('layout.sidenav')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Edit Contact</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('contacts.index') }}">Contacts</a></li>
                        <li class="breadcrumb-item active">Edit {{ $contact->full_name }}</li>
                    </ol>
                    
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-user-edit me-1"></i>
                                    Contact Information
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('contacts.update', $contact) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="first_name" class="form-label">First Name *</label>
                                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" 
                                                       id="first_name" name="first_name" value="{{ old('first_name', $contact->first_name) }}" required>
                                                @error('first_name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="last_name" class="form-label">Last Name *</label>
                                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" 
                                                       id="last_name" name="last_name" value="{{ old('last_name', $contact->last_name) }}" required>
                                                @error('last_name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="email" class="form-label">Email *</label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                                       id="email" name="email" value="{{ old('email', $contact->email) }}" required>
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="phone" class="form-label">Phone</label>
                                                <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                                       id="phone" name="phone" value="{{ old('phone', $contact->phone) }}">
                                                @error('phone')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="job_title" class="form-label">Job Title</label>
                                                <input type="text" class="form-control @error('job_title') is-invalid @enderror" 
                                                       id="job_title" name="job_title" value="{{ old('job_title', $contact->job_title) }}">
                                                @error('job_title')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="status" class="form-label">Status *</label>
                                                <select class="form-select @error('status') is-invalid @enderror" 
                                                        id="status" name="status" required>
                                                    <option value="">Select Status</option>
                                                    <option value="lead" {{ old('status', $contact->status) == 'lead' ? 'selected' : '' }}>Lead</option>
                                                    <option value="prospect" {{ old('status', $contact->status) == 'prospect' ? 'selected' : '' }}>Prospect</option>
                                                    <option value="customer" {{ old('status', $contact->status) == 'customer' ? 'selected' : '' }}>Customer</option>
                                                    <option value="partner" {{ old('status', $contact->status) == 'partner' ? 'selected' : '' }}>Partner</option>
                                                </select>
                                                @error('status')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="company_id" class="form-label">Company</label>
                                                <select class="form-select @error('company_id') is-invalid @enderror" 
                                                        id="company_id" name="company_id">
                                                    <option value="">Select Company</option>
                                                    @foreach($companies as $company)
                                                        <option value="{{ $company->id }}" {{ old('company_id', $contact->company_id) == $company->id ? 'selected' : '' }}>
                                                            {{ $company->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('company_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="assigned_to" class="form-label">Assigned To</label>
                                                <select class="form-select @error('assigned_to') is-invalid @enderror" 
                                                        id="assigned_to" name="assigned_to">
                                                    <option value="">Select User</option>
                                                    @foreach($users as $user)
                                                        <option value="{{ $user->id }}" {{ old('assigned_to', $contact->assigned_to) == $user->id ? 'selected' : '' }}>
                                                            {{ $user->first_name }} {{ $user->last_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('assigned_to')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="lead_score" class="form-label">Lead Score (0-100)</label>
                                                <input type="number" class="form-control @error('lead_score') is-invalid @enderror" 
                                                       id="lead_score" name="lead_score" value="{{ old('lead_score', $contact->lead_score) }}" 
                                                       min="0" max="100">
                                                @error('lead_score')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="source" class="form-label">Source</label>
                                                <input type="text" class="form-control @error('source') is-invalid @enderror" 
                                                       id="source" name="source" value="{{ old('source', $contact->source) }}" 
                                                       placeholder="e.g., Website, Referral, Cold Call">
                                                @error('source')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="notes" class="form-label">Notes</label>
                                            <textarea class="form-control @error('notes') is-invalid @enderror" 
                                                      id="notes" name="notes" rows="4" 
                                                      placeholder="Additional notes about this contact...">{{ old('notes', $contact->notes) }}</textarea>
                                            @error('notes')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="d-flex justify-content-end">
                                            <a href="{{ route('contacts.index') }}" class="btn btn-secondary me-2">Cancel</a>
                                            <button type="submit" class="btn btn-primary">Update Contact</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Contact Details
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <strong>Created:</strong><br>
                                        <small class="text-muted">{{ $contact->created_at->format('M d, Y H:i') }}</small>
                                    </div>
                                    <div class="mb-3">
                                        <strong>Last Updated:</strong><br>
                                        <small class="text-muted">{{ $contact->updated_at->format('M d, Y H:i') }}</small>
                                    </div>
                                    @if($contact->creator)
                                        <div class="mb-3">
                                            <strong>Created By:</strong><br>
                                            <small class="text-muted">{{ $contact->creator->first_name }} {{ $contact->creator->last_name }}</small>
                                        </div>
                                    @endif
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
