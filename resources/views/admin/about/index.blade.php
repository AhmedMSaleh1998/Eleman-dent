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
            <h4 class="header-title m-t-0 m-b-20">من نحن</h4>

            <table class="table table-bordered table-striped">
                @if(isset($about->id))
                {{Form::model($about,['method'=>'PATCH','action' => ['App\Http\Controllers\Admin\AboutController@update',$about->id], 'files' => true])}}
                <tbody>
                    <tr>
                        <td>الوصف</td>
                        <td>
                            <textarea name="description" class="form-control" id="content2"><?php if(isset($about->description)){echo $about->description;} ?></textarea>
                            @if ($errors->has('description'))
                            <span class=" alert alert-danger">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>السياسات</td>
                        <td>
                            <textarea name="policy" class="form-control" id="content2"><?php if(isset($about->policy)){echo $about->policy;} ?></textarea>
                            @if ($errors->has('policy'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('policy') }}</strong>
                            </span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>عنوان الاحصائية الأولي</td>
                        <td>
                            <input type="text" name="title_one" class="form-control" value="<?php if(isset($about->title_one)){echo $about->title_one;} ?>">
                            @if ($errors->has('title_one'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('title_one') }}</strong>
                            </span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>قيمة الاحصائية الأولي</td>
                        <td>
                            <input type="text" name="value_one" class="form-control" value="<?php if(isset($about->value_one)){echo $about->value_one;} ?>">
                            @if ($errors->has('value_one'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('value_one') }}</strong>
                            </span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>عنوان الاحصائية الثانية</td>
                        <td>
                            <input type="text" name="title_two" class="form-control" value="<?php if(isset($about->title_two)){echo $about->title_two;} ?>">
                            @if ($errors->has('title_two'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('title_two') }}</strong>
                            </span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>قيمة الاحصائية الثانية</td>
                        <td>
                            <input type="text" name="value_two" class="form-control" value="<?php if(isset($about->value_two)){echo $about->value_two;} ?>">
                            @if ($errors->has('value_two'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('value_two') }}</strong>
                            </span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>عنوان الاحصائية الثالثة</td>
                        <td>
                            <input type="text" name="title_three" class="form-control" value="<?php if(isset($about->title_three)){echo $about->title_three;} ?>">
                            @if ($errors->has('title_three'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('title_three') }}</strong>
                            </span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>قيمة الاحصائية الثالثة</td>
                        <td>
                            <input type="text" name="value_three" class="form-control" value="<?php if(isset($about->value_three)){echo $about->value_three;} ?>">
                            @if ($errors->has('value_three'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('value_three') }}</strong>
                            </span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>عنوان الاحصائية الرابعة</td>
                        <td>
                            <input type="text" name="title_four" class="form-control" value="<?php if(isset($about->title_four)){echo $about->title_four;} ?>">
                            @if ($errors->has('title_four'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('title_four') }}</strong>
                            </span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>قيمة الاحصائية الرابعة</td>
                        <td>
                            <input type="text" name="value_four" class="form-control" value="<?php if(isset($about->value_four)){echo $about->value_four;} ?>">
                            @if ($errors->has('value_four'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('value_four') }}</strong>
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
                {{Form::open(['method'=>'POST','action' => ['App\Http\Controllers\Admin\AboutController@store'], 'files' => true])}}
                <tbody>
                    <tr>
                        <td>الوصف</td>
                        <td>
                            <textarea name="description" class="form-control" id="content2"></textarea>
                            @if ($errors->has('description'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>السياسات</td>
                        <td>
                            <textarea name="policy" class="form-control" id="content2"></textarea>
                            @if ($errors->has('policy'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('policy') }}</strong>
                            </span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>عنوان الاحصائية الأولي</td>
                        <td>
                            <input type="text" name="title_one" class="form-control">
                            @if ($errors->has('title_one'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('title_one') }}</strong>
                            </span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>قيمة الاحصائية الاولي</td>
                        <td>
                            <input type="text" name="value_one" class="form-control">
                            @if ($errors->has('value_one'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('value_one') }}</strong>
                            </span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>عنوان الاحصائية الثانية</td>
                        <td>
                            <input type="text" name="title_two" class="form-control">
                            @if ($errors->has('title_two'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('title_two') }}</strong>
                            </span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>قيمة الاحصائية الثانية</td>
                        <td>
                            <input type="text" name="value_two" class="form-control">
                            @if ($errors->has('value_two'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('value_two') }}</strong>
                            </span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>عنوان الاحصائية الثالثة</td>
                        <td>
                            <input type="text" name="title_three" class="form-control">
                            @if ($errors->has('title_three'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('title_three') }}</strong>
                            </span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>قيمة الاحصائية الثالثة</td>
                        <td>
                            <input type="text" name="value_three" class="form-control">
                            @if ($errors->has('value_three'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('value_three') }}</strong>
                            </span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>عنوان الاحصائية الرابعة</td>
                        <td>
                            <input type="text" name="title_four" class="form-control">
                            @if ($errors->has('title_four'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('title_four') }}</strong>
                            </span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>قيمة الاحصائية الرابعة</td>
                        <td>
                            <input type="text" name="value_four" class="form-control">
                            @if ($errors->has('value_four'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('value_four') }}</strong>
                            </span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="width:25%"></td>
                        <td><button type="submit" class="btn btn-default waves-effect waves-light form-control">حفظ</button></td>
                    </tr>
                </tbody>
                {!! Form::close() !!}
                @endif
            </table>
        </div>
    </div><!-- end col -->
</div>

@endsection
