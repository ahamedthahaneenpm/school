@section('title','Add Role')

@push('style')
<link rel="stylesheet" type="text/css" href="{{asset('css/admin/roles/addRole.css')}}">
@endpush

@push('vendor-script')
<script src="{{asset('vendors/jquery-validation/jquery.validate.min.js')}}"></script>
@endpush

@push('script')
<script src="{{asset('js/admin/roles/addRole.js')}}"></script>
@endpush

<x-admin-layout>

    <x-breadcrumbs :breadcrumbs="$breadcrumbs"></x-breadcrumbs>

    {{-- Page Content --}}
    <div class="col s12 data-add">
        <div class="container">
            <div class="section">
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <div class="col s12" id="account">
                                <!-- users edit account form start -->
                                <form id="accountForm" method="POST" action="{{route('role_create')}}">
                                    @csrf
                                    <div class="row">
                                        <div class="col s12 m6">
                                            <div class="row">
                                                <div class="col s12 input-field">
                                                    <input id="name" name="name" type="text" class="validate" value="" data-error=".errorTxt2">
                                                    <label for="name">Name<span class="red-text">*</span></label>
                                                    <small class="errorTxt2"></small>
                                                    @error('name')<small class="form-text text-danger red-text">{{ $message }}</small>@enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col s12 m6">
                                            <div class="row">
                                                <div class="col s12 input-field">
                                                    <select name="status" class="form-select">
                                                        <option value="1">Active</option>
                                                        <option value="0">Banned</option>
                                                    </select>
                                                    <label>Status</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col s12">
                                            <table class="mt-1">
                                                <thead>
                                                    <tr>
                                                        <th>Module Permission</th>
                                                        <th>Read</th>
                                                        <th>Create</th>
                                                        <th>Update</th>
                                                        <th>Delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($permissions as $permission)
                                                    <tr>
                                                        <td>{{$permission['label']}}</td>
                                                        <td>
                                                            <label>
                                                                <input name="permissions[]" value="{{$permission['key']}}_read" type="checkbox" />
                                                                <span></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label>
                                                                <input name="permissions[]" value="{{$permission['key']}}_create" type="checkbox" />
                                                                <span></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label>
                                                                <input name="permissions[]" value="{{$permission['key']}}_update" type="checkbox" />
                                                                <span></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label>
                                                                <input name="permissions[]" value="{{$permission['key']}}_delete" type="checkbox" />
                                                                <span></span>
                                                            </label>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <!-- </div> -->
                                        </div>
                                        <div class="col s12 display-flex justify-content-end mt-3">
                                            <a href="{{route("role_list")}}" class="btn btn-light">Cancel</a>
                                            <button type="submit" class="btn submit-btn indigo">Create</button>
                                        </div>
                                    </div>
                                </form>
                                <!-- users edit account form ends -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>