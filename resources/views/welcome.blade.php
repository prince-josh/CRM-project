<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Daily CRM - Customer Relationship Management</title>
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
                                        <h1 class="text-center font-weight-light my-4">Welcome to Daily CRM</h1>
                                        <p class="text-center text-muted mb-0">Your complete customer relationship management solution</p>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="text-center mb-4">
                                                    <i class="fas fa-users fa-3x text-primary mb-3"></i>
                                                    <h4>Manage Contacts</h4>
                                                    <p class="text-muted">Keep track of all your customer contacts in one place</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="text-center mb-4">
                                                    <i class="fas fa-handshake fa-3x text-success mb-3"></i>
                                                    <h4>Track Deals</h4>
                                                    <p class="text-muted">Monitor your sales pipeline and close more deals</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="text-center mb-4">
                                                    <i class="fas fa-building fa-3x text-info mb-3"></i>
                                                    <h4>Organize Companies</h4>
                                                    <p class="text-muted">Manage company information and relationships</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="text-center mb-4">
                                                    <i class="fas fa-chart-line fa-3x text-warning mb-3"></i>
                                                    <h4>Track Activities</h4>
                                                    <p class="text-muted">Log and monitor all customer interactions</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="text-center mt-4">
                                            <h5 class="text-primary mb-3">Get Started Today</h5>
                                            <p class="text-muted mb-4">Create your organization account and start managing your customer relationships effectively.</p>
                                            
                                            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                                <a href="{{ route('register') }}" class="btn btn-primary btn-lg me-md-2">
                                                    <i class="fas fa-building me-2"></i>Create Organization
                                                </a>
                                                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg">
                                                    <i class="fas fa-sign-in-alt me-2"></i>Login
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small">
                                            <p class="mb-2">Already have an account? <a href="{{ route('login') }}">Login here</a></p>
                                            <p class="mb-0">Need to create a new organization? <a href="{{ route('register') }}">Register here</a></p>
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
