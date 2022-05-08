@section('title','Add User')

@push('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2-materialize.css')}}">
@endpush
@push('style')
<link rel="stylesheet" type="text/css" href="{{asset('css/admin/users/addUser.css')}}">
@endpush

@push('vendor-script')
<script src="{{asset('vendors/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('vendors/select2/select2.full.min.js')}}"></script>
@endpush

@push('script')
<script src="{{asset('js/admin/users/addUser.js')}}"></script>
@endpush

<x-admin-layout>

    <x-breadcrumbs :breadcrumbs="$breadcrumbs"></x-breadcrumbs>

    {{-- Page Content --}}

    <div class="col s12 m12 l12">
        <div id="Form-advance" class="card card card-default scrollspy">
            <div class="card-content">
                <form method="POST" id="userForm" action="{{route('user_create')}}">
                    @csrf
                    <div class="row">
                        <div class="input-field col m4 s12">
                            <input id="name" name="name" type="text" value="{{old('name')}}">
                            <label for="name">Name <span class="red-text">*</span></label>
                            @error('name')<small class="form-text red-text text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="input-field col m4 s12">
                            <input id="email" name="email" type="email" value="{{old('email')}}">
                            <label for="email">Email <span class="red-text">*</span></label>
                            @error('email')<small class="form-text red-text text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="input-field col m4 s12 ">
                            <select name="status" class="form-select">
                                <option value="1">Active</option>
                                <option value="0">Banned</option>
                            </select>
                            <label>Status</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col m4 s12">
                            <input id="password" name="password" type="password">
                            <label for="password">Password <span class="red-text">*</span></label>
                            @error('password')<small class="form-text red-text text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="input-field col m4 s12">
                            <input id="password_confirm" name="password_confirm" type="password">
                            <label for="password_confirm">Confirm Password <span class="red-text">*</span></label>
                            @error('password_confirm')<small class="form-text red-text text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="input-field col m4 s12">
                            <select class="select2" name="role_id" id="role_id" data-error="#role_id-error-div" data-placeholder="Select role">
                                @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                            <label class="active">Select Role <span class="red-text">*</span></label>
                            @error('role_id')<small class="form-text red-text text-danger">{{ $message }}</small>@enderror
                            <div id="role_id-error-div"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 display-flex justify-content-end mt-3">
                            <a href="{{route("user_list")}}" class="btn btn-light">Cancel</a>
                            <button type="submit" class="btn indigo submit-btn">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-admin-layout>