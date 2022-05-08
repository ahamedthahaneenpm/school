@push('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2-materialize.css')}}">
@endpush

@section('title','Users')

@push('vendor-script')
<script src="{{asset('vendors/data-tables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendors/select2/select2.full.min.js')}}"></script>
<script src="{{asset('vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}"></script>
@endpush

@push('script')
<script src="{{asset('js/admin/users/listUsers.js')}}"></script>
@endpush

@push('style')
<link rel="stylesheet" type="text/css" href="{{asset('css/admin/users/listUser.css')}}">
@endpush

<x-admin-layout>

    <x-breadcrumbs :breadcrumbs="$breadcrumbs">
    </x-breadcrumbs>
    <div class="col s12">
        <div class="container">
            <div class="section">
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <form id="userFilterAttribute" class="searchform" class="searchform">
                                <div class="col s12 m6 l2">
                                    <label for="users-list-status">Status</label>
                                    <div class="input-field">
                                        <select class="select2" id="user-status">
                                            <option value="">All</option>
                                            <option value="0">Inactive</option>
                                            <option value="1">Active</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class="show-btn" style="height: 50px;">
                                    <button type="submit" class="waves-effect waves dark btn btn-primary" style="background: #53a1e2;">Show</button>
                                    <button class="red btn btn-reset reset_search ">Reset</button>
                                    @can('user_create')
                                    <a class="btn waves-effect waves-light breadcrumbs-btn" href="{{route('user_add')}}">
                                        <i class="material-icons hide-on-med-and-up">add</i><span class="hide-on-small-onl">Add</span>
                                    </a>
                                    @endcan
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col s12">
        <div class="container">
            {{-- Content --}}
            <div class="section">
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <div class="col s12 data-list-table">
                                <table class="users-list-datatable" id="users-list-datatable" class="table" data-url="{{route('user_table')}}">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="content-overlay"></div>
    </div>

</x-admin-layout>