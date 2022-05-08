@section('title','Add Student')

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
<link rel="stylesheet" href="{{asset('css/admin/student/editStudent.css')}}">
@endpush

@push('script')
<script src="{{asset('js/admin/student/editStudent.js')}}"></script>
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
                                    <form action="{{route('student_update')}}" id="studentForm" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="id" id="id" value="{{$student->id}}">
                                        @csrf
                                        <div class="row justify-content-md-center">
                                            <div class="input-field col m6 s12">
                                                <input type="text" value="{{old('name', $student->name)}}" name="name" id="name">
                                                <label for="name" class="mandatory">
                                                    @lang('student Name') <span class="red-text">*</span>
                                                </label>
                                                @error('name')<small class="form-text text-danger">{{ $message }}</small>@enderror
                                            </div>
                                            <div class="input-field col m6 s12">
                                                <input type="number" value="{{old('age', $student->age)}}" name="age" id="age">
                                                <label for="age" class="mandatory">
                                                    @lang('Age') <span class="red-text">*</span>
                                                </label>
                                                @error('age')<small class="form-text text-danger">{{ $message }}</small>@enderror
                                            </div>
                                        </div>
                                        <div class="row justify-content-md-center">
                                            <div class="input-field col m6 s12">
                                                <div class="switch">
                                                    <label for="gender">
                                                        @lang('Gender')<span class="red-text">*</span>
                                                    </label>
                                                    <br>
                                                    <label>
                                                        <input class="with-gap" name="gender" type="radio" value="0" {{!old('gender', $student->gender) ? "checked" : ""}} />
                                                        <span>Male</span>
                                                    </label>
                                                    <label>
                                                        <input class="with-gap" name="gender" type="radio" value="1" {{old('gender', $student->gender) == 1 ? "checked" : ""}} />
                                                        <span>Female</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="input-field col m6 s12">
                                                <label class="active" for="teacher_id">
                                                    @lang('Teacher') <span class="red-text">*</span>
                                                </label>
                                                <br>
                                                <div>
                                                    <select name="teacher_id" data-error="#teacher_id-error-div" id="teacher_id" data-placeholder="Select teacher" data-option-url="{{ route('options_teachers') }}" class="select2-ajax browser-default">
                                                        @if (isset($old['teacher_id']) && $old['teacher_id'] != '')
                                                        <option value="{{ $old['teacher_id']->id }}">{{ $old['teacher_id']->name }} </option>
                                                        @endif
                                                    </select>
                                                </div>
                                                @error('teacher_id')<small class="form-text text-danger">{{ $message }}</small>@enderror
                                                <div id="teacher-error-div"></div>
                                            </div>
                                            <div class="input-field col m6 s12">
                                                <div class="switch">
                                                    <label for="status">
                                                        @lang('Status')<span class="red-text">*</span>
                                                    </label>
                                                    <label>
                                                        <input class="with-gap" name="status" type="radio" value="1" {{$student->status ? "checked" : ""}} />
                                                        <span>Active</span>
                                                    </label>
                                                    <label>
                                                        <input class="with-gap" name="status" type="radio" value="0" {{!$student->status ? "checked" : ""}} />
                                                        <span>Inactive</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <button class="btn cyan waves-effect waves-light right mr-1" type="submit" id="btnSubmit">
                                                Submit <i class="material-icons right">send</i></button>
                                            <button class="btn red waves-effect waves-light btn-reset right mr-1" type="reset">
                                                <i class="material-icons left">refresh</i> @lang('Reset')
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