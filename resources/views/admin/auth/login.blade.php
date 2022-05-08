@section('title','Login')

@push('style')
<link rel="stylesheet" href="{{asset('css/admin/auth/login.css')}}">
@endpush

@push('vendor-script')
<script src="{{asset('vendors/jquery-validation/jquery.validate.min.js')}}"></script>
@endpush

@push('script')
<script src="{{asset('js/admin/auth/login.js')}}"></script>
@endpush

<x-admin-guest-layout>
    <x-auth-card>
        <div id="login-page" class="row">
            <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                <form class="login-form" action="{{ route('login') }}" method="POST" name="registration">
                    @csrf
                    <div class="row">
                        <div class="input-field col s12">
                            <h5 class="ml-4">Sign in</h5>
                        </div>
                    </div>
                    <div class="row margin">
                        <div class="input-field col s12">
                            <i class="material-icons prefix pt-2">person_outline</i>
                            <input type="text" name="email" id="email">
                            <label for="email" class="center-align">Username</label>
                            @error('email')<small class="form-text red-text text-danger">{{ $message }}</small>@enderror
                        </div>
                    </div>
                    <div class="row margin">
                        <div class="input-field col s12">
                            <i class="material-icons prefix pt-2">lock_outline</i>
                            <input id="password" type="password" name="password" id="password">
                            <label for="password">Password</label>
                            @error('password')<small class="form-text red-text text-danger">{{ $message }}</small>@enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12 ml-2 mt-1">
                            <p>
                                <label>
                                    <input type="checkbox" name="remember" />
                                    <span>Remember Me</span>
                                </label>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <button id="login" type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Login</button>
                        </div>
                    </div>
                    <div class="row">
                        {{-- <div class="input-field col s6 m6 l6">
                            <p class="margin medium-small"><a href="user-register.html">Register Now!</a></p>
                        </div>
                        <div class="input-field col s6 m6 l6">
                            <p class="margin right-align medium-small"><a href="user-forgot-password.html">Forgot password ?</a></p>
                        </div> --}}
                    </div>
                </form>
            </div>
        </div>
    </x-auth-card>
</x-admin-guest-layout>