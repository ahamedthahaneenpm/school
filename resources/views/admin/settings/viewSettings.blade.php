@section('title', 'Settings')

@push('style')
<link rel="stylesheet" href="{{asset('css/admin/settings/viewSettings.css')}}">
@endpush

@push('vendor-script')
@endpush

@push('script')
<script src="{{asset('js/admin/settings/viewSettings.js')}}"></script>
@endpush

<x-admin-layout>

    <x-breadcrumbs :breadcrumbs="$breadcrumbs">
    </x-breadcrumbs>

    <div class="row">
        <div class="col s12 m6 l6">
            <div id="basic-form" class="card card card-default scrollspy">
                <div class="card-content">
                    <h4 class="card-title">@lang('General')</h4>

                    <form action="{{route('settings_general_save')}}" method="post" enctype='multipart/form-data'>
                        @csrf
                        <div class="row">
                            <div class="col s12">
                                <div class="input-field">
                                    <label for="company_name">@lang('Company Name')</label>
                                    <input type="text" value="{{ old('company_name',$settings->get('company_name')->value) }}" name="company_name" id="company_name" class="form-control">
                                    @error('company_name')<small class="form-text text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="input-field">
                                    <label for="company_description">@lang('Company Description')</label>
                                    <textarea name="company_description" id="company_description" class="materialize-textarea">{!! old('company_description',$settings->get('company_description')->value) !!}</textarea>
                                    @error('company_description')<small class="form-text text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="file-field input-field">
                                    @if($settings->get('fav_icon')->value && Storage::disk('school')->exists($settings->get('fav_icon')->value))
                                    <div class="row">
                                        <div class="col s12">
                                            <label for="fav_icon" class="active">@lang('Fav Icon')</label>
                                            <img class="preview favicon_preview" src="{{Storage::disk('school')->url($settings->get('fav_icon')->value)}}" alt="" style="width:auto; max-width:40px;">
                                            <a href="{{route('settings_remove_favicon')}}" class="confirm-delete text-danger"><i class="material-icons dp48">close</i></a>
                                        </div>
                                    </div>
                                    @else
                                    <div class="btn">
                                        <span>@lang('Fav Icon')</span>
                                        <input type="file" id="fav_icon" name="fav_icon">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
                                    </div>
                                    @endif
                                    @error('fav_icon')<small class="form-text text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="file-field input-field">
                                    @if($settings->get('logo_dark')->value && Storage::disk('school')->exists($settings->get('logo_dark')->value))
                                    <div class="row">
                                        <div class="col s12">
                                            <label for="logo_dark" class="active">@lang('Dark Logo')</label>
                                            <img class="preview" src="{{Storage::disk('school')->url($settings->get('logo_dark')->value)}}" alt="" style="width:150px">
                                            <a href="{{route('settings_remove_dark_logo')}}" class="confirm-delete text-danger"><i class="material-icons dp48">close</i></a>
                                        </div>
                                    </div>
                                    @else
                                    <div class="btn">
                                        <span>@lang('Dark Logo')</span>
                                        <input type="file" id="logo_dark" name="logo_dark">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
                                    </div>
                                    @endif
                                    @error('logo_dark')<small class="form-text text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="file-field input-field">
                                    @if($settings->get('logo_light')->value && Storage::disk('school')->exists($settings->get('logo_light')->value))
                                    <div class="row">
                                        <div class="col s12">
                                            <label for="logo_light" class="active">@lang('Light Logo')</label>
                                            <img class="preview" src="{{Storage::disk('school')->url($settings->get('logo_light')->value)}}" alt="" style="width:150px">
                                            <a href="{{route('settings_remove_light_logo')}}" class="confirm-delete text-danger"><i class="material-icons dp48">close</i></a>
                                        </div>
                                    </div>
                                    @else
                                    <div class="btn">
                                        <span>@lang('Light Logo')</span>
                                        <input type="file" id="logo_light" name="logo_light">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
                                    </div>
                                    @endif
                                    @error('logo_light')<small class="form-text text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="input-field">
                                    <label for="meta_tags">@lang('Meta Tags')</label>
                                    <textarea name="meta_tags" id="meta_tags" class="materialize-textarea">{!! old('meta_tags',$settings->get('meta_tags')->value) !!}</textarea>
                                    @error('meta_tags')<small class="form-text text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="input-field">
                                    <label for="address">@lang('Address')</label>
                                    <textarea name="address" id="address" class="materialize-textarea">{!! old('address',$settings->get('address')->value) !!}</textarea>
                                    @error('address')<small class="form-text text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="input-field">
                                    <label for="email">@lang('Email')</label>
                                    <input type="email" value="{{ old('email',$settings->get('email')->value) }}" name="email" id="email" class="form-control">
                                    @error('email')<small class="form-text text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="input-field">
                                    <label for="phone">@lang('Phone')</label>
                                    <input type="text" value="{{ old('phone',$settings->get('phone')->value) }}" name="phone" id="phone" class="form-control">
                                    @error('phone')<small class="form-text text-danger">{{ $message }}</small>@enderror
                                </div>
                            </div>
                            <div class="col s12 l3 display-flex align-items-center show-btn">
                                <button type="submit" class="btn btn-sm btn-primary">@lang('SAVE')</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="col s12 m6 l6">
            <div id="basic-form" class="card card card-default scrollspy">
                <div class="card-content">
                    <h4 class="card-title">@lang('External Links')</h4>

                    <form action="{{route('settings_general_save')}}" method="post" enctype='multipart/form-data'>
                        @csrf
                        <div class="row">
                            <div class="col s12">
                                <div class="input-field">
                                    <label for="facebook_url">@lang('Facebook')</label>
                                    <input type="text" value="{{ old('facebook_url',$settings->get('facebook_url')->value) }}" name="facebook_url" id="facebook_url" class="form-control">
                                    @error('facebook_url')<small class="form-text text-danger">{{ $message }}</small>@enderror
                                </div>
                            </div>
                            <div class="col s12">
                                <div class="input-field">
                                    <label for="twitter_url">@lang('Twitter')</label>
                                    <input type="text" value="{{ old('twitter_url',$settings->get('twitter_url')->value) }}" name="twitter_url" id="twitter_url" class="form-control">
                                    @error('twitter_url')<small class="form-text text-danger">{{ $message }}</small>@enderror
                                </div>
                            </div>
                            <div class="col s12">
                                <div class="input-field">
                                    <label for="youtube_url">@lang('Youtube')</label>
                                    <input type="text" value="{{ old('youtube_url',$settings->get('youtube_url')->value) }}" name="youtube_url" id="youtube_url" class="form-control">
                                    @error('youtube_url')<small class="form-text text-danger">{{ $message }}</small>@enderror
                                </div>
                            </div>
                            <div class="col s12">
                                <div class="input-field">
                                    <label for="instagram_url">@lang('Instagram')</label>
                                    <input type="text" value="{{ old('instagram_url',$settings->get('instagram_url')->value) }}" name="instagram_url" id="instagram_url" class="form-control">
                                    @error('instagram_url')<small class="form-text text-danger">{{ $message }}</small>@enderror
                                </div>
                            </div>
                            <div class="col s12 l3 display-flex align-items-center show-btn">
                                <button type="submit" class="btn btn-sm btn-primary">@lang('SAVE')</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>