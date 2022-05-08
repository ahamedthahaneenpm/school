<!-- BEGIN: SideNav-->
<aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light sidenav-active-square">
    <div class="brand-sidebar">
        <h1 class="logo-wrapper">
            <a class="brand-logo darken-1" href="{{route('dashboard')}}">
                <img class="hide-on-med-and-down small-logo"
                    src="{{config('settings.fav_icon') && Storage::disk('school')->exists(config('settings.fav_icon')) ? Storage::disk('school')->url(config('settings.fav_icon')) : asset("images/admin/favicon.png")}}" alt="materialize logo" />
                <img class="hide-on-med-and-down big-logo"
                    src="{{config('settings.logo_dark') && Storage::disk('school')->exists(config('settings.logo_dark')) ? Storage::disk('school')->url(config('settings.logo_dark')) : asset("images/admin/logo-dark.png")}}" alt="materialize logo" />
                <img class="show-on-medium-and-down hide-on-med-and-up"
                    src="{{config('settings.fav_icon') && Storage::disk('school')->exists(config('settings.fav_icon')) ? Storage::disk('school')->url(config('settings.fav_icon')) : asset("images/logo/logo-small.png")}}" alt="materialize logo" />
            </a>
            <a class="navbar-toggler" href="#">
                <i class="material-icons">radio_button_checked</i>
            </a>
        </h1>
    </div>
    <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
        {!!sideMenu()!!}
    </ul>
    {{-- mobile menu --}}
    <div class="navigation-background"></div>
    <a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only" href="#" data-target="slide-out">
        <i class="material-icons">menu</i>
    </a>
</aside>
<!-- END: SideNav-->