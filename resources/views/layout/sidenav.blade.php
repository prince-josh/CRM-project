<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                
                <div class="sb-sidenav-menu-heading">CRM</div>
                <a class="nav-link" href="{{ route('contacts.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                    Contacts
                </a>
                <a class="nav-link" href="#">
                    <div class="sb-nav-link-icon"><i class="fas fa-building"></i></div>
                    Companies
                </a>
                <a class="nav-link" href="#">
                    <div class="sb-nav-link-icon"><i class="fas fa-handshake"></i></div>
                    Deals
                </a>
                <a class="nav-link" href="#">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-line"></i></div>
                    Activities
                </a>
                
                <div class="sb-sidenav-menu-heading">Reports</div>
                <a class="nav-link" href="#">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Analytics
                </a>
                <a class="nav-link" href="#">
                    <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
                    Reports
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
            <br>
            <small class="text-muted">{{ Auth::user()->organization->name }}</small>
        </div>
    </nav>
</div>