<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Organization;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Show the registration form
     */
    public function showRegistrationForm()
    {
        return view('register');
    }

    /**
     * Handle organization registration
     * Creates both organization and first user account simultaneously
     */
    public function register(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            // Organization fields
            'organization_name' => 'required|string|max:255|min:2',
            'organization_domain' => 'nullable|string|max:255|unique:organizations,domain',
            'organization_phone' => 'nullable|string|max:50',
            
            // User fields
            'first_name' => 'required|string|max:255|min:2',
            'last_name' => 'required|string|max:255|min:2',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'organization_name.required' => 'Organization name is required.',
            'organization_name.min' => 'Organization name must be at least 2 characters.',
            'organization_domain.unique' => 'This domain is already registered.',
            'first_name.required' => 'First name is required.',
            'last_name.required' => 'Last name is required.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already registered.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.confirmed' => 'Password confirmation does not match.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            // Generate a unique slug for the organization
            $baseSlug = Str::slug($request->organization_name);
            $slug = $baseSlug;
            $counter = 1;
            
            while (Organization::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            // Create the organization
            $organization = Organization::create([
                'name' => $request->organization_name,
                'slug' => $slug,
                'domain' => $request->organization_domain,
                'phone' => $request->organization_phone,
                'subscription_plan' => 'free',
                'timezone' => 'UTC',
                'is_active' => true,
            ]);

            // Create the first user (owner)
            $user = User::create([
                'organization_id' => $organization->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'owner',
                'is_active' => true,
                'email_verified_at' => now(), // Auto-verify the first user
            ]);

            DB::commit();

            // Log in the user automatically
            Auth::login($user);

            // Redirect to dashboard with success message
            return redirect()->route('dashboard')
                ->with('success', 'Organization created successfully! Welcome to Daily CRM.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->withErrors(['error' => 'An error occurred while creating your account. Please try again.'])
                ->withInput();
        }
    }

    /**
     * Show the login form
     */
    public function showLoginForm()
    {
        return view('login');
    }

    /**
     * Handle user login
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();
            
            // Check if user is active
            if (!$user->is_active) {
                Auth::logout();
                return redirect()->back()
                    ->withErrors(['email' => 'Your account has been deactivated. Please contact your administrator.'])
                    ->withInput();
            }

            // Update last login
            $user->update(['last_login_at' => now()]);

            // Redirect to dashboard
            return redirect()->intended(route('dashboard'))
                ->with('success', 'Welcome back, ' . $user->first_name . '!');
        }

        return redirect()->back()
            ->withErrors(['email' => 'The provided credentials do not match our records.'])
            ->withInput();
    }

    /**
     * Handle user logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login')
            ->with('success', 'You have been successfully logged out.');
    }
}
