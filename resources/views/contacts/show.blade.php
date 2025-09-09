@extends('layout.app')
@section('content')
    @include('layout.topnav')
    <div id="layoutSidenav">
        @include('layout.sidenav')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">{{ $contact->full_name }}</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('contacts.index') }}">Contacts</a></li>
                        <li class="breadcrumb-item active">{{ $contact->full_name }}</li>
                    </ol>
                    
                    <div class="row">
                        <div class="col-lg-8">
                            <!-- Contact Information -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class="fas fa-user me-1"></i>
                                            Contact Information
                                        </div>
                                        <div>
                                            <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-sm btn-outline-warning">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <strong>Email:</strong><br>
                                                <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                                            </div>
                                            <div class="mb-3">
                                                <strong>Phone:</strong><br>
                                                {{ $contact->phone ?? 'Not provided' }}
                                            </div>
                                            <div class="mb-3">
                                                <strong>Job Title:</strong><br>
                                                {{ $contact->job_title ?? 'Not specified' }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <strong>Status:</strong><br>
                                                <span class="badge 
                                                    @if($contact->status == 'lead') bg-warning
                                                    @elseif($contact->status == 'prospect') bg-info
                                                    @elseif($contact->status == 'customer') bg-success
                                                    @elseif($contact->status == 'partner') bg-primary
                                                    @endif">
                                                    {{ ucfirst($contact->status) }}
                                                </span>
                                            </div>
                                            <div class="mb-3">
                                                <strong>Lead Score:</strong><br>
                                                <div class="progress" style="height: 25px;">
                                                    <div class="progress-bar" role="progressbar" 
                                                         style="width: {{ $contact->lead_score }}%"
                                                         aria-valuenow="{{ $contact->lead_score }}" 
                                                         aria-valuemin="0" aria-valuemax="100">
                                                        {{ $contact->lead_score }}%
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <strong>Source:</strong><br>
                                                {{ $contact->source ?? 'Not specified' }}
                                            </div>
                                        </div>
                                    </div>
                                    
                                    @if($contact->notes)
                                        <div class="mt-3">
                                            <strong>Notes:</strong><br>
                                            <div class="border rounded p-3 bg-light">
                                                {{ $contact->notes }}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Company Information -->
                            @if($contact->company)
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-building me-1"></i>
                                        Company Information
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <strong>Company:</strong><br>
                                                {{ $contact->company->name }}
                                            </div>
                                            <div class="col-md-6">
                                                <strong>Industry:</strong><br>
                                                {{ $contact->company->industry ?? 'Not specified' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Deals -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-handshake me-1"></i>
                                    Related Deals
                                </div>
                                <div class="card-body">
                                    @if($contact->deals->count() > 0)
                                        <div class="table-responsive">
                                            <table class="table table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Deal Name</th>
                                                        <th>Value</th>
                                                        <th>Stage</th>
                                                        <th>Close Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($contact->deals as $deal)
                                                        <tr>
                                                            <td>{{ $deal->name }}</td>
                                                            <td>${{ number_format($deal->value, 2) }}</td>
                                                            <td>
                                                                <span class="badge bg-secondary">{{ $deal->stage }}</span>
                                                            </td>
                                                            <td>{{ $deal->close_date ? $deal->close_date->format('M d, Y') : 'Not set' }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <p class="text-muted">No deals associated with this contact.</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Activities -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-line me-1"></i>
                                    Recent Activities
                                </div>
                                <div class="card-body">
                                    @if($contact->activities->count() > 0)
                                        <div class="timeline">
                                            @foreach($contact->activities->take(10) as $activity)
                                                <div class="timeline-item mb-3">
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0">
                                                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                                <i class="fas fa-{{ $activity->type === 'call' ? 'phone' : ($activity->type === 'email' ? 'envelope' : 'calendar') }} text-white"></i>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="mb-1">{{ $activity->title }}</h6>
                                                            <p class="mb-1 text-muted">{{ $activity->description }}</p>
                                                            <small class="text-muted">{{ $activity->created_at->format('M d, Y H:i') }}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-muted">No activities recorded for this contact.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4">
                            <!-- Contact Actions -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-cogs me-1"></i>
                                    Actions
                                </div>
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-warning">
                                            <i class="fas fa-edit"></i> Edit Contact
                                        </a>
                                        <a href="mailto:{{ $contact->email }}" class="btn btn-info">
                                            <i class="fas fa-envelope"></i> Send Email
                                        </a>
                                        @if($contact->phone)
                                            <a href="tel:{{ $contact->phone }}" class="btn btn-success">
                                                <i class="fas fa-phone"></i> Call
                                            </a>
                                        @endif
                                        <form action="{{ route('contacts.destroy', $contact) }}" method="POST" 
                                              onsubmit="return confirm('Are you sure you want to delete this contact?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger w-100">
                                                <i class="fas fa-trash"></i> Delete Contact
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Details -->
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
                                    @if($contact->assignedTo)
                                        <div class="mb-3">
                                            <strong>Assigned To:</strong><br>
                                            <small class="text-muted">{{ $contact->assignedTo->first_name }} {{ $contact->assignedTo->last_name }}</small>
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
