<div class="shadow container-fluid bg-light position-relative">
    <nav class="px-0 py-3 navbar navbar-expand-lg bg-light navbar-light py-lg-0 px-lg-5">
        <a href="" class="navbar-brand font-weight-bold text-secondary" style="font-size: 50px">
            <span class="text-primary"> C.Hub</span>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
            <div class="py-0 mx-auto navbar-nav font-weight-bold">
                <a href="{{ url('') }}" class="nav-item nav-link active">Home</a>
                <a href="{{ url('about') }}"
                    class="nav-item nav-link @if (Request::segment(1) == '') active @endif">About Us</a>
                <a href="{{ url('hub') }}"
                    class="nav-item nav-link @if (Request::segment(1) == '') active @endif">Hub</a>
                <a href="{{ url('contact') }}"
                    class="nav-item nav-link  @if (Request::segment(1) == '') active @endif">Contact</a>
            </div>
            <a href="{{ url('login') }}" class="px-4 btn btn-primary">Login</a>
            <a href="{{ url('register') }}" class="px-4 btn btn-primary" style="margin-left: 8px;">Register</a>
        </div>
    </nav>
</div>
