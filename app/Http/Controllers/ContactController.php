<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Auth::user()->organization->contacts()->with(['company', 'assignedTo']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('job_title', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by company
        if ($request->filled('company_id')) {
            $query->where('company_id', $request->company_id);
        }

        $contacts = $query->paginate(15);
        $companies = Auth::user()->organization->companies()->orderBy('name')->get();
        $users = Auth::user()->organization->users()->orderBy('first_name')->get();

        return view('contacts.contacts', compact('contacts', 'companies', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Auth::user()->organization->companies()->orderBy('name')->get();
        $users = Auth::user()->organization->users()->orderBy('first_name')->get();
        
        return view('contacts.create', compact('companies', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'job_title' => 'nullable|string|max:255',
            'status' => 'required|in:lead,prospect,customer,Inactive',
            'lead_score' => 'nullable|integer|min:0|max:100',
            'source' => 'nullable|string|max:255',
            'company_id' => 'nullable|exists:companies,id',
            'assigned_to' => 'nullable|exists:users,id',
            'notes' => 'nullable|string',
        ]);

        $contact = Auth::user()->organization->contacts()->create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'job_title' => $request->job_title,
            'status' => $request->status,
            'lead_score' => $request->lead_score ?? 0,
            'source' => $request->source,
            'company_id' => $request->company_id,
            'assigned_to' => $request->assigned_to,
            'notes' => $request->notes,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('contacts.index')->with('success', 'Contact created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        // Ensure the contact belongs to the user's organization
        if ($contact->organization_id !== Auth::user()->organization_id) {
            abort(403);
        }

        $contact->load(['company', 'assignedTo', 'creator', 'deals', 'activities']);
        
        return view('contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        // Ensure the contact belongs to the user's organization
        if ($contact->organization_id !== Auth::user()->organization_id) {
            abort(403);
        }

        $companies = Auth::user()->organization->companies()->orderBy('name')->get();
        $users = Auth::user()->organization->users()->orderBy('first_name')->get();
        
        return view('contacts.edit', compact('contact', 'companies', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        // Ensure the contact belongs to the user's organization
        if ($contact->organization_id !== Auth::user()->organization_id) {
            abort(403);
        }

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'job_title' => 'nullable|string|max:255',
            'status' => 'required|in:lead,prospect,customer,Inactive',
            'lead_score' => 'nullable|integer|min:0|max:100',
            'source' => 'nullable|string|max:255',
            'company_id' => 'nullable|exists:companies,id',
            'assigned_to' => 'nullable|exists:users,id',
            'notes' => 'nullable|string',
        ]);

        $contact->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'job_title' => $request->job_title,
            'status' => $request->status,
            'lead_score' => $request->lead_score ?? 0,
            'source' => $request->source,
            'company_id' => $request->company_id,
            'assigned_to' => $request->assigned_to,
            'notes' => $request->notes,
        ]);

        return redirect()->route('contacts.index')->with('success', 'Contact updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        // Ensure the contact belongs to the user's organization
        if ($contact->organization_id !== Auth::user()->organization_id) {
            abort(403);
        }

        $contact->delete();

        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully!');
    }
}
