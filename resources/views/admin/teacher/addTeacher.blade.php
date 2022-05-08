@section('title','Add Teacher')

@push('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2-materialize.css')}}">
@endpush

@push('vendor-script')
<script src="{{asset('vendors/select2/select2.full.min.js')}}"></script>
<script src="{{asset('vendors/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('vendors/jquery-validation/additional-methods.min.js')}}"></script>
@endpush

@push('style')
<link rel="stylesheet" href="{{asset('css/admin/teacher/addTeacher.css')}}">
@endpush

@push('script')
<script src="{{asset('js/admin/teacher/addTeacher.js')}}"></script>
@endpush

<x-admin-layout>

    <x-breadcrumbs :breadcrumbs="$breadcrumbs">
    </x-breadcrumbs>

    <div class="row">
        <div class="col s12">
            <div class="container">
                {{-- Content --}}
                <div class="section">
                    <div class="card">
                        <div class="card-content">
                            <div class="row">
                                <div class="col s12">
                                    <form action="{{route('teacher_save')}}" id="teacherForm" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row justify-content-md-center">
                                            <div class="input-field col m6 s12">
                                                <input type="text" value="{{old('name')}}" name="name" id="name">
                                                <label for="name" class="mandatory">
                                                    @lang('Teacher Name') <span class="red-text">*</span>
                                                </label>
                                                @error('name')<small class="form-text text-danger">{{ $message }}</small>@enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <button class="btn cyan waves-effect waves-light right mr-4" type="submit" id="btnSubmit">
                                                Submit
                                                <i class="material-icons right">send</i></button>
                                            <button class="btn red waves-effect waves-light btn-reset right mr-4" type="reset">
                                                <i class="material-icons left">refresh</i>
                                                @lang('Reset')
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>