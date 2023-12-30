@extends('layouts.admin')

@section('content')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        @if (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
        @elseif(Session::has('danger'))
        <div class="alert alert-danger">{{ Session::get('danger') }}</div>
        @endif
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card-box">
            <h4 class="header-title m-t-0 m-b-20">الإعدادت </h4>

            <table class="table table-bordered table-striped">
                @if(isset($setting->id))
                {{Form::model($setting,['method'=>'PATCH','action' => ['App\Http\Controllers\Admin\SettingController@update',$setting->id], 'files' => true])}}
                <tbody>
                    <tr>
                        <td>الهاتف رقم 1</td>
                        <td>
                            <input type="text" name="phone_one" class="form-control" value="<?php if(isset($setting->phone_one)){echo $setting->phone_one;} ?>">
                            @if ($errors->has('phone_one'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('phone_one') }}</strong>
                            </span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>الهاتف رقم 2</td>
                        <td>
                            <input type="text" name="phone_two" class="form-control" value="<?php if(isset($setting->phone_two)){echo $setting->phone_two;} ?>">
                            @if ($errors->has('phone_two'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('phone_two') }}</strong>
                            </span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>البريد الألكتروني 1</td>
                        <td>
                            <input type="email" name="email_one" class="form-control" value="<?php if(isset($setting->email_one)){echo $setting->email_one;} ?>">
                            @if ($errors->has('email_one'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('email_one') }}</strong>
                            </span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>البريد الألكتروني 2</td>
                        <td>
                            <input type="email" name="email_two" class="form-control" value="<?php if(isset($setting->email_two)){echo $setting->email_two;} ?>">
                            @if ($errors->has('email_two'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('email_two') }}</strong>
                            </span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>فيسبوك</td>
                        <td>
                            <input type="text" name="facebook" class="form-control" value="<?php if(isset($setting->facebook)){echo $setting->facebook;} ?>">
                            @if ($errors->has('facebook'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('facebook') }}</strong>
                            </span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>تويتر</td>
                        <td><input type="text" class="form-control" name="twitter" value=<?php if(isset($setting->twitter)){echo $setting->twitter;} ?>></td>
                        @if ($errors->has('twitter'))
                        <div class="alert alert-danger">
                            <strong>{{ $errors->first('twitter') }}</strong>
                        </div>
                        @endif
                    </tr>

                    <tr>
                        <td>انستجرام</td>
                        <td><input type="text" class="form-control" name="instagram" value="<?php if(isset($setting->instagram)){echo $setting->instagram;} ?>"></td>
                        @if ($errors->has('instagram'))
                        <div class="alert alert-danger">
                            <strong>{{ $errors->first('instagram') }}</strong>
                        </div>
                        @endif
                    </tr>

                    <tr>
                        <td>العنوان عربي </td>
                        <td>
                            <input type="text" name="address_ar" class="form-control" value="<?php if(isset($setting->address_ar)){echo $setting->address_ar;} ?>">
                            @if ($errors->has('address_ar'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('address_ar') }}</strong>
                            </span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>العنوان انجليزي </td>
                        <td>
                            <input type="text" name="address_en" class="form-control" value="<?php if(isset($setting->address_en)){echo $setting->address_en;} ?>">
                            @if ($errors->has('address_en'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('address_en') }}</strong>
                            </span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="width:25%"></td>
                        <td><button type="submit" class="btn btn-default waves-effect waves-light form-control">تعديل</button></td>
                    </tr>
                </tbody>
                {!! Form::close() !!}
                @else
                {{Form::open(['method'=>'POST','action' => ['App\Http\Controllers\Admin\SettingController@store'], 'files' => true])}}
                <tbody>
                    <tr>
                        <td>الهاتف رقم 1</td>
                        <td>
                            <input type="text" name="phone_one" class="form-control" value="<?php if(isset($setting->phone_one)){echo $setting->phone_one;} ?>">
                            @if ($errors->has('phone_one'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('phone_one') }}</strong>
                            </span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>الهاتف رقم 2</td>
                        <td>
                            <input type="text" name="phone_two" class="form-control" value="<?php if(isset($setting->phone_two)){echo $setting->phone_two;} ?>">
                            @if ($errors->has('phone_two'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('phone_two') }}</strong>
                            </span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>البريد الألكتروني 1</td>
                        <td>
                            <input type="email" name="email_one" class="form-control" value="<?php if(isset($setting->email_one)){echo $setting->email_one;} ?>">
                            @if ($errors->has('email_one'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('email_one') }}</strong>
                            </span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>البريد الألكتروني 2</td>
                        <td>
                            <input type="email" name="email_two" class="form-control" value="<?php if(isset($setting->email_two)){echo $setting->email_two;} ?>">
                            @if ($errors->has('email_two'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('email_two') }}</strong>
                            </span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>فيسبوك</td>
                        <td>
                            <input type="text" name="facebook" class="form-control" value="<?php if(isset($setting->facebook)){echo $setting->facebook;} ?>">
                            @if ($errors->has('facebook'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('facebook') }}</strong>
                            </span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>تويتر</td>
                        <td><input type="text" class="form-control" name="twitter" value=<?php if(isset($setting->twitter)){echo $setting->twitter;} ?>></td>
                        @if ($errors->has('twitter'))
                        <div class="alert alert-danger">
                            <strong>{{ $errors->first('twitter') }}</strong>
                        </div>
                        @endif
                    </tr>

                    <tr>
                        <td>انستجرام</td>
                        <td><input type="text" class="form-control" name="instagram" value="<?php if(isset($setting->instagram)){echo $setting->instagram;} ?>"></td>
                        @if ($errors->has('instagram'))
                        <div class="alert alert-danger">
                            <strong>{{ $errors->first('instagram') }}</strong>
                        </div>
                        @endif
                    </tr>

                    <tr>
                        <td>العنوان عربي </td>
                        <td>
                            <input type="text" name="address_ar" class="form-control" value="<?php if(isset($setting->address_ar)){echo $setting->address_ar;} ?>">
                            @if ($errors->has('address_ar'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('address_ar') }}</strong>
                            </span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>العنوان انجليزي </td>
                        <td>
                            <input type="text" name="address_en" class="form-control" value="<?php if(isset($setting->address_en)){echo $setting->address_en;} ?>">
                            @if ($errors->has('address_en'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('address_en') }}</strong>
                            </span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="width:25%"></td>
                        <td><button type="submit" class="btn btn-default waves-effect waves-light form-control">تعديل</button></td>
                    </tr>
                </tbody>
                {!! Form::close() !!}
                @endif
            </table>
        </div>
    </div><!-- end col -->
</div>

@endsection
