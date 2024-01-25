@extends('layouts.admin')

@section('content')
    <!-- Page-Title -->
    @if (Session::has('success'))
        <div class="alert alert-success text-center">{{ Session::get('success') }}</div>
    @elseif(Session::has('danger'))
        <div class="alert alert-danger text-center">{{ Session::get('danger') }}</div>
    @endif
    <div class="row">

    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <h4 class="header-title m-t-0 m-b-20">Setting </h4>

                <table class="table table-bordered table-striped">
                    @if(!$setting)
                    {{ Form::model($setting, ['method' => 'Post', 'action' => ['App\Http\Controllers\Admin\SettingController@store'], 'files' => true]) }}
                    <tbody>
                        <tr>
                            <td> Phone Number</td>
                            <td>
                                <input type="text" name="phone" class="form-control"
                                    value="{{ isset($setting) ? $setting->phone : old('phone') }}">
                                @if ($errors->has('phone'))
                                    <span class="alert alert-danger">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td> Email</td>
                            <td>
                                <input type="email" name="email" class="form-control"
                                    value="{{ isset($setting) ? $setting->email : old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="alert alert-danger">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </td>
                        </tr>


                        <tr>
                            <td>Facebook</td>
                            <td>
                                <input type="text" name="facebook" class="form-control"
                                    value="{{ isset($setting) ? $setting->facebook : old('facebook') }}">

                                @if ($errors->has('facebook'))
                                    <span class="alert alert-danger">
                                        <strong>{{ $errors->first('facebook') }}</strong>
                                    </span>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td>Twitter</td>
                            <td><input type="text" class="form-control" name="twitter"
                                    value="{{ isset($setting) ? $setting->twitter : old('twitter') }}">

                            </td>
                            @if ($errors->has('twitter'))
                                <div class="alert alert-danger">
                                    <strong>{{ $errors->first('twitter') }}</strong>
                                </div>
                            @endif
                        </tr>

                        <tr>
                            <td>Instagram</td>
                            <td><input type="text" class="form-control" name="instagram"
                                    value="{{ isset($setting) ? $setting->instagram : old('instagram') }}">

                            </td>
                            @if ($errors->has('instagram'))
                                <div class="alert alert-danger">
                                    <strong>{{ $errors->first('instagram') }}</strong>
                                </div>
                            @endif
                        </tr>
                        <tr>
                            <td>Whatsapp</td>
                            <td><input type="text" class="form-control" name="whatsapp"
                                    value="{{ isset($setting) ? $setting->whatsapp : old('whatsapp') }}">

                            </td>
                            @if ($errors->has('whatsapp'))
                                <div class="alert alert-danger">
                                    <strong>{{ $errors->first('whatsapp') }}</strong>
                                </div>
                            @endif
                        </tr>
                        <tr>
                            <td>Youtube</td>
                            <td><input type="text" class="form-control" name="youtube"
                                    value="{{ isset($setting) ? $setting->youtube : old('youtube') }}">

                            </td>
                            @if ($errors->has('youtube'))
                                <div class="alert alert-danger">
                                    <strong>{{ $errors->first('youtube') }}</strong>
                                </div>
                            @endif
                        </tr>
                       <tr>
                            <td> Address AR </td>
                            <td>
                                <input type="text" name="address_ar" class="form-control"
                                    value="{{ isset($setting) ? $setting->translate('ar')->address : old('address_ar') }}">

                                @if ($errors->has('address_ar'))
                                    <span class="alert alert-danger">
                                        <strong>{{ $errors->first('address_ar') }}</strong>
                                    </span>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td> Address En </td>
                            <td>
                                <input type="text" name="address_en" class="form-control"
                                    value="{{ isset($setting) ? $setting->translate('en')->address : old('address_en') }}">

                                @if ($errors->has('address_en'))
                                    <span class="alert alert-danger">
                                        <strong>{{ $errors->first('address_en') }}</strong>
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td> Keywords Ar </td>
                            <td>
                                <input type="text" name="keywords_ar" class="form-control"
                                    value="{{ isset($setting) ? $setting->translate('ar')->keywords : old('keywords_ar') }}">

                                @if ($errors->has('keywords_ar'))
                                    <span class="alert alert-danger">
                                        <strong>{{ $errors->first('keywords_ar') }}</strong>
                                    </span>
                                @endif
                            </td>
                        </tr>
                       <tr>
                            <td> Keywords En </td>
                            <td>
                                <input type="text" name="keywords_en" class="form-control"
                                    value="{{ isset($setting) ? $setting->translate('en')->keywords : old('keywords_en') }}">
                                @if ($errors->has('keywords_en'))
                                    <span class="alert alert-danger">
                                        <strong>{{ $errors->first('keywords_en') }}</strong>
                                    </span>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td> AboutUs Ar </td>
                            <td>
                                <textarea id="textarea" maxlength="100" class="form-control" name="about_us_ar">{{ $setting ? $setting->translate('ar')->about_us : old('about_us_ar') }}</textarea>
                                @if ($errors->has('about_us_ar'))
                                    <span class="alert alert-danger">
                                        <strong>{{ $errors->first('about_us_ar') }}</strong>
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td> AboutUs En</td>
                            <td>
                                <textarea id="textarea" maxlength="100" class="form-control" name="about_us_en">{{ $setting ? $setting->translate('en')->about_us : old('about_us_en') }}</textarea>
                                @if ($errors->has('about_us'))
                                    <span class="alert alert-danger">
                                        <strong>{{ $errors->first('about_us') }}</strong>
                                    </span>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td> Privacy Ar </td>
                            <td>
                                <textarea id="textarea" maxlength="100" class="form-control" name="privacy_ar">{{ $setting ? $setting->translate('ar')->privacy : old('privacy_ar') }}</textarea>
                                @if ($errors->has('privacy_ar'))
                                    <span class="alert alert-danger">
                                        <strong>{{ $errors->first('privacy_ar') }}</strong>
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td> Privacy En </td>
                            <td>
                                <textarea id="textarea" maxlength="100" class="form-control" name="privacy_en">{{ $setting ? $setting->translate('en')->privacy : old('privacy_en') }}</textarea>
                                @if ($errors->has('privacy_en'))
                                    <span class="alert alert-danger">
                                        <strong>{{ $errors->first('privacy_en') }}</strong>
                                    </span>
                                @endif
                            </td>
                        </tr> 
                        <tr>
                            <td> Terms Ar</td>
                            <td>
                                <textarea id="textarea" maxlength="100" class="form-control" name="terms_ar">{{ $setting ? $setting->translate('ar')->terms : old('terms_ar') }}</textarea>
                                @if ($errors->has('terms_ar'))
                                    <span class="alert alert-danger">
                                        <strong>{{ $errors->first('terms_ar') }}</strong>
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td> Terms En</td>
                            <td>
                                <textarea id="textarea" maxlength="100" class="form-control" name="terms_en">{{ $setting ? $setting->translate('en')->terms : old('terms_en') }}</textarea>
                                @if ($errors->has('terms_en'))
                                    <span class="alert alert-danger">
                                        <strong>{{ $errors->first('terms_en') }}</strong>
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td style="width:25%"></td>
                            <td><button type="submit"
                                    class="btn btn-default waves-effect waves-light form-control">Save</button></td>
                        </tr>
                    </tbody>
                    {!! Form::close() !!}
                    @else
                    {{ Form::model($setting, ['method' => 'PATCH', 'action' => ['App\Http\Controllers\Admin\SettingController@update', $setting->id], 'files' => true]) }}
                    <tbody>
                        <tr>
                            <td> Phone Number</td>
                            <td>
                                <input type="text" name="phone" class="form-control"
                                    value="{{ isset($setting) ? $setting->phone : old('phone') }}">
                                @if ($errors->has('phone'))
                                    <span class="alert alert-danger">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td> Email</td>
                            <td>
                                <input type="email" name="email" class="form-control"
                                    value="{{ isset($setting) ? $setting->email : old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="alert alert-danger">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </td>
                        </tr>


                        <tr>
                            <td>Facebook</td>
                            <td>
                                <input type="text" name="facebook" class="form-control"
                                    value="{{ isset($setting) ? $setting->facebook : old('facebook') }}">

                                @if ($errors->has('facebook'))
                                    <span class="alert alert-danger">
                                        <strong>{{ $errors->first('facebook') }}</strong>
                                    </span>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td>Twitter</td>
                            <td><input type="text" class="form-control" name="twitter"
                                    value="{{ isset($setting) ? $setting->twitter : old('twitter') }}">

                            </td>
                            @if ($errors->has('twitter'))
                                <div class="alert alert-danger">
                                    <strong>{{ $errors->first('twitter') }}</strong>
                                </div>
                            @endif
                        </tr>

                        <tr>
                            <td>Instagram</td>
                            <td><input type="text" class="form-control" name="instagram"
                                    value="{{ isset($setting) ? $setting->instagram : old('instagram') }}">

                            </td>
                            @if ($errors->has('instagram'))
                                <div class="alert alert-danger">
                                    <strong>{{ $errors->first('instagram') }}</strong>
                                </div>
                            @endif
                        </tr>
                        <tr>
                            <td>Whatsapp</td>
                            <td><input type="text" class="form-control" name="whatsapp"
                                    value="{{ isset($setting) ? $setting->whatsapp : old('whatsapp') }}">

                            </td>
                            @if ($errors->has('whatsapp'))
                                <div class="alert alert-danger">
                                    <strong>{{ $errors->first('whatsapp') }}</strong>
                                </div>
                            @endif
                        </tr>
                        <tr>
                            <td>Youtube</td>
                            <td><input type="text" class="form-control" name="youtube"
                                    value="{{ isset($setting) ? $setting->youtube : old('youtube') }}">

                            </td>
                            @if ($errors->has('youtube'))
                                <div class="alert alert-danger">
                                    <strong>{{ $errors->first('youtube') }}</strong>
                                </div>
                            @endif
                        </tr>
                       <tr>
                            <td> Address AR </td>
                            <td>
                                <input type="text" name="address_ar" class="form-control"
                                    value="{{ isset($setting) ? $setting->translate('ar')->address : old('address_ar') }}">

                                @if ($errors->has('address_ar'))
                                    <span class="alert alert-danger">
                                        <strong>{{ $errors->first('address_ar') }}</strong>
                                    </span>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td> Address En </td>
                            <td>
                                <input type="text" name="address_en" class="form-control"
                                    value="{{ isset($setting) ? $setting->translate('en')->address : old('address_en') }}">

                                @if ($errors->has('address_en'))
                                    <span class="alert alert-danger">
                                        <strong>{{ $errors->first('address_en') }}</strong>
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td> Keywords Ar </td>
                            <td>
                                <input type="text" name="keywords_ar" class="form-control"
                                    value="{{ isset($setting) ? $setting->translate('ar')->keywords : old('keywords_ar') }}">

                                @if ($errors->has('keywords_ar'))
                                    <span class="alert alert-danger">
                                        <strong>{{ $errors->first('keywords_ar') }}</strong>
                                    </span>
                                @endif
                            </td>
                        </tr>
                       <tr>
                            <td> Keywords En </td>
                            <td>
                                <input type="text" name="keywords_en" class="form-control"
                                    value="{{ isset($setting) ? $setting->translate('en')->keywords : old('keywords_en') }}">
                                @if ($errors->has('keywords_en'))
                                    <span class="alert alert-danger">
                                        <strong>{{ $errors->first('keywords_en') }}</strong>
                                    </span>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td> AboutUs Ar </td>
                            <td>
                                <textarea id="textarea" maxlength="100" class="form-control" name="about_us_ar">{{ $setting ? $setting->translate('ar')->about_us : old('about_us_ar') }}</textarea>
                                @if ($errors->has('about_us_ar'))
                                    <span class="alert alert-danger">
                                        <strong>{{ $errors->first('about_us_ar') }}</strong>
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td> AboutUs En</td>
                            <td>
                                <textarea id="textarea" maxlength="100" class="form-control" name="about_us_en">{{ $setting ? $setting->translate('en')->about_us : old('about_us_en') }}</textarea>
                                @if ($errors->has('about_us'))
                                    <span class="alert alert-danger">
                                        <strong>{{ $errors->first('about_us') }}</strong>
                                    </span>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td> Privacy Ar </td>
                            <td>
                                <textarea id="textarea" maxlength="100" class="form-control" name="privacy_ar">{{ $setting ? $setting->translate('ar')->privacy : old('privacy_ar') }}</textarea>
                                @if ($errors->has('privacy_ar'))
                                    <span class="alert alert-danger">
                                        <strong>{{ $errors->first('privacy_ar') }}</strong>
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td> Privacy En </td>
                            <td>
                                <textarea id="textarea" maxlength="100" class="form-control" name="privacy_en">{{ $setting ? $setting->translate('en')->privacy : old('privacy_en') }}</textarea>
                                @if ($errors->has('privacy_en'))
                                    <span class="alert alert-danger">
                                        <strong>{{ $errors->first('privacy_en') }}</strong>
                                    </span>
                                @endif
                            </td>
                        </tr> 
                        <tr>
                            <td> Terms Ar</td>
                            <td>
                                <textarea id="textarea" maxlength="100" class="form-control" name="terms_ar">{{ $setting ? $setting->translate('ar')->terms : old('terms_ar') }}</textarea>
                                @if ($errors->has('terms_ar'))
                                    <span class="alert alert-danger">
                                        <strong>{{ $errors->first('terms_ar') }}</strong>
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td> Terms En</td>
                            <td>
                                <textarea id="textarea" maxlength="100" class="form-control" name="terms_en">{{ $setting ? $setting->translate('en')->terms : old('terms_en') }}</textarea>
                                @if ($errors->has('terms_en'))
                                    <span class="alert alert-danger">
                                        <strong>{{ $errors->first('terms_en') }}</strong>
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td style="width:25%"></td>
                            <td><button type="submit"
                                    class="btn btn-default waves-effect waves-light form-control">Save</button></td>
                        </tr>
                    </tbody>
                    {!! Form::close() !!}
                    @endif
                </table>
            </div>
        </div><!-- end col -->
    </div>
@endsection
