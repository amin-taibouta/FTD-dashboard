<div class="nav accordion" id="accordionSidenav">
    <!-- Sidenav Menu Heading (Core)-->
    <div class="sidenav-footer">
        <div class="sidenav-footer-content">
            <div class="sidenav-footer-title">{{ _('Welcome') }} : {{ Auth::user()->name }}</div>
            <div class="sidenav-footer-title">{{ _('office ID') }} : {{ Auth::user()->username }}</div>
        </div>
    </div>

    <!-- Sidenav Accordion (Flows)-->
    <a class="nav-link {{ Nav::isRoute('dashboard') }}" href="{{ route('dashboard') }}"> 
        <div class="nav-link-icon"><i class="fa-solid fa-home"></i></div>
        {{ __('Dashboard') }}
    </a>
        
    <a class="nav-link {{ Nav::isRoute('calls-report') }}" href="{{ route('calls-report') }}"> 
        <div class="nav-link-icon"><i class="fa-solid fa-chart-line"></i></div>
        {{ __('Call Reporting') }}
    </a>

    <a class="nav-link {{ Nav::isRoute('profile') }}" href="{{ route('profile') }}"> 
        <div class="nav-link-icon"><i data-feather="tool"></i></i></div>
        {{ __('Account') }}
    </a>


    <a class="nav-link" href="https://www.futuredontics.com/contact-us"> 
        <div class="nav-link-icon"><i class="fa-solid fa-at"></i></div>
        {{ __('Contact Us') }}
    </a>

    <a class="nav-link" href="{{ route('logout') }}"> 
        <div class="nav-link-icon"><i class="fa-solid fa-arrow-right-from-bracket"></i></div>
        {{ __('Logout') }}
    </a>

</div>