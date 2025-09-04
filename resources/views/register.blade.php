<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Organization Registration - Daily CRM</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header">
                                        <h3 class="text-center font-weight-light my-4">Create Organization Account</h3>
                                        <p class="text-center text-muted mb-0">Register your organization and create your first admin account</p>
                                    </div>
                                    <div class="card-body">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul class="mb-0">
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <form method="POST" action="{{ route('register') }}">
                                            @csrf
                                            
                                            <!-- Organization Information -->
                                            <div class="mb-4">
                                                <h5 class="text-primary mb-3">Organization Information</h5>
                                                <div class="form-floating mb-3">
                                                    <input class="form-control @error('organization_name') is-invalid @enderror" 
                                                           id="organization_name" 
                                                           name="organization_name" 
                                                           type="text" 
                                                           placeholder="Enter organization name" 
                                                           value="{{ old('organization_name') }}" 
                                                           required />
                                                    <label for="organization_name">Organization Name</label>
                                                    @error('organization_name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                
                                                <div class="form-floating mb-3">
                                                    <input class="form-control @error('organization_domain') is-invalid @enderror" 
                                                           id="organization_domain" 
                                                           name="organization_domain" 
                                                           type="text" 
                                                           placeholder="yourcompany.com" 
                                                           value="{{ old('organization_domain') }}" />
                                                    <label for="organization_domain">Domain (Optional)</label>
                                                    @error('organization_domain')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                
                                                <div class="form-floating mb-3">
                                                    <input class="form-control @error('organization_phone') is-invalid @enderror" 
                                                           id="organization_phone" 
                                                           name="organization_phone" 
                                                           type="tel" 
                                                           placeholder="+1 (555) 123-4567" 
                                                           value="{{ old('organization_phone') }}" />
                                                    <label for="organization_phone">Phone Number (Optional)</label>
                                                    @error('organization_phone')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- User Information -->
                                            <div class="mb-4">
                                                <h5 class="text-primary mb-3">Admin Account Information</h5>
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <div class="form-floating mb-3 mb-md-0">
                                                            <input class="form-control @error('first_name') is-invalid @enderror" 
                                                                   id="first_name" 
                                                                   name="first_name" 
                                                                   type="text" 
                                                                   placeholder="Enter your first name" 
                                                                   value="{{ old('first_name') }}" 
                                                                   required />
                                                            <label for="first_name">First Name</label>
                                                            @error('first_name')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating">
                                                            <input class="form-control @error('last_name') is-invalid @enderror" 
                                                                   id="last_name" 
                                                                   name="last_name" 
                                                                   type="text" 
                                                                   placeholder="Enter your last name" 
                                                                   value="{{ old('last_name') }}" 
                                                                   required />
                                                            <label for="last_name">Last Name</label>
                                                            @error('last_name')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input class="form-control @error('email') is-invalid @enderror" 
                                                           id="email" 
                                                           name="email" 
                                                           type="email" 
                                                           placeholder="name@example.com" 
                                                           value="{{ old('email') }}" 
                                                           required />
                                                    <label for="email">Email Address</label>
                                                    @error('email')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <div class="form-floating mb-3 mb-md-0">
                                                            <input class="form-control @error('password') is-invalid @enderror" 
                                                                   id="password" 
                                                                   name="password" 
                                                                   type="password" 
                                                                   placeholder="Create a password" 
                                                                   required />
                                                            <label for="password">Password</label>
                                                            @error('password')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating mb-3 mb-md-0">
                                                            <input class="form-control @error('password_confirmation') is-invalid @enderror" 
                                                                   id="password_confirmation" 
                                                                   name="password_confirmation" 
                                                                   type="password" 
                                                                   placeholder="Confirm password" 
                                                                   required />
                                                            <label for="password_confirmation">Confirm Password</label>
                                                            @error('password_confirmation')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="mt-4 mb-0">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary btn-block">
                                                        <i class="fas fa-building me-2"></i>Create Organization & Account
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small">
                                            <a href="{{ route('login') }}">Already have an account? Go to login</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Daily CRM 2024</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
