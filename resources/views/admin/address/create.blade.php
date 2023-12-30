@extends('layouts.admin')

@section('styles')
<!-- Plugins css-->
<link href="{{asset('admin_assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css')}}" rel="stylesheet" />
<link href="{{asset('admin_assets/plugins/switchery/css/switchery.min.css')}}" rel="stylesheet" />
<link href="{{asset('admin_assets/plugins/multiselect/css/multi-select.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('admin_assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('admin_assets/plugins/bootstrap-select/css/bootstrap-select.min.css')}}" rel="stylesheet" />
<link href="{{asset('admin_assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet" />
<link href="{{asset('admin_assets/plugins/bootstrap-table/css/bootstrap-table.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('admin_assets/plugins/custombox/css/custombox.css')}}" rel="stylesheet">
@endsection

@section('content')
<!-- Page-Title -->
<div class="row">
    <div class="main-title-00">
        <a style="color: #fff;" href="{{route('admin.home')}}">الرئيسية/</a>
        <a style="color: #fff;" href="{{route('admin.address.index',$record->user_id??$user_id)}}">العناوين /</a>

        @if(empty($record))
            <a style="color: #36404a;"> إضافة </a>
        @else
            <a style="color: #36404a;"> تعديل </a>
        @endif
    </div>

    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
<div class="row">
    <div class="col-12">

        @if(empty($record))

            {!! Form::open([ 'method'=>'POST','route' => 'admin.address.store' , 'files' => true]) !!} 
        @else 
            {!! Form::open([ 'method'=>'PUT','route' => [ 'admin.address.update', $record->id] , 'files' => true]) !!}
        
        @endif
        
        @csrf
        <div class="card-box">
            @if(empty($record))
            <h4 class="header-title m-t-0 m-b-20">اضافه عنوان</h4>
        @else
        <h4 class="header-title m-t-0 m-b-20">تعديل عنوان</h4>
        @endif
            <input type="hidden" name="user_id" value="{{ $record->user_id??$user_id }}">
            <div class="form-group">
                <label>
                    City Name
                </label>
                {!! Form::select('district_id', $districts->pluck('name_ar' , 'id'), $record->district_id??null, ['class' => 'form-control', 'placeholder' => ' اختر المنطقة' ,'id' =>'district']) !!}

            </div>
            <div class="form-group">
                <label>
                    street_name
                </label>

                {!! Form::text('street', $record->street??null ,['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                <label>
                    building_number
                </label>

                {!! Form::text('building', $record->building??null ,['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                <label>
                    floor_num
                </label>

                {!! Form::text('floor', $record->floor??null ,['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                <label>
                    apartment_num
                </label>
                {!! Form::text('apartment', $record->apartment??null ,['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                <label>
                    phone
                </label>
                {!! Form::text('phone', $record->phone??null ,['class' => 'form-control']) !!}
            </div>
        </div>
        <button type="submit" class="btn btn-default waves-effect waves-light form-control">حفظ</button>
    </div>
    {!! Form::close() !!}
</div><!-- end col -->
</div>
<script src="{{ mix('js/app.js') }}"></script>
@endsection