@section('title','Edit Mark')

@push('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2-materialize.css')}}">
@endpush

@push('style')
<link rel="stylesheet" href="{{asset('css/admin/score/editScore.css')}}">
@endpush

@push('vendor-script')
<script src="{{asset('vendors/select2/select2.full.min.js')}}"></script>
<script src="{{asset('vendors/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('vendors/jquery-validation/additional-methods.min.js')}}"></script>
@endpush

@push('script')
<script src="{{asset('js/admin/score/editScore.js')}}"></script>
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
                                    <form action="{{route('score_update')}}" id="scoreForm" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="id" id="id" value="{{$score->id}}">
                                        @csrf
                                        <div class="row justify-content-md-center">
                                            <div class="input-field col m6 s12">
                                                <label class="active" for="student_id">
                                                    @lang('Student') <span class="red-text">*</span>
                                                </label>
                                                <br>
                                                <div>
                                                    <select name="student_id" data-error="#student_id-error-div" id="student_id" data-placeholder="Select student" data-option-url="{{ route('options_students') }}" class="select2-ajax browser-default">
                                                        @if (isset($old['student_id']) && $old['student_id'] != '')
                                                        <option value="{{ $old['student_id']->id }}">{{ $old['student_id']->name }} </option>
                                                        @endif
                                                    </select>
                                                </div>
                                                @error('student_id')<small class="form-text text-danger">{{ $message }}</small>@enderror
                                                <div id="student_id-error-div"></div>
                                            </div>
                                            <div class="input-field col m6 s12">
                                                <input type="number" value="{{old('maths', $score->maths)}}" name="maths" id="maths">
                                                <label for="maths" class="mandatory">
                                                    @lang('Maths Score') <span class="red-text">*</span>
                                                </label>
                                                @error('maths')<small class="form-text text-danger">{{ $message }}</small>@enderror
                                            </div>
                                        </div>
                                        <div class="row justify-content-md-center">
                                            <div class="input-field col m6 s12">
                                                <input type="number" value="{{old('sceince', $score->sceince)}}" name="sceince" id="sceince">
                                                <label for="sceince" class="mandatory">
                                                    @lang('Science Score') <span class="red-text">*</span>
                                                </label>
                                                @error('sceince')<small class="form-text text-danger">{{ $message }}</small>@enderror
                                            </div>
                                            <div class="input-field col m6 s12">
                                                <input type="number" value="{{old('history', $score->history)}}" name="history" id="history">
                                                <label for="history" class="mandatory">
                                                    @lang('History Score') <span class="red-text">*</span>
                                                </label>
                                                @error('history')<small class="form-text text-danger">{{ $message }}</small>@enderror
                                            </div>
                                        </div>
                                        <div class="row justify-content-md-center">
                                            <div class="input-field col m6 s12">
                                                <input type="text" value="{{old('term', $score->term)}}" name="term" id="term">
                                                <label for="term" class="mandatory">
                                                    @lang('Term') <span class="red-text">*</span>
                                                </label>
                                                @error('term')<small class="form-text text-danger">{{ $message }}</small>@enderror
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