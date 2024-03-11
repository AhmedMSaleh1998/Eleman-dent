@extends('layouts.admin')

@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="main-title-00">
            @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @elseif(Session::has('danger'))
                <div class="alert alert-danger">{{ Session::get('danger') }}</div>
            @endif
            <a style="color: #fff;" href="{{ route('admin.home') }}">Home</a>
            <a style="color: #fff;" href="{{ route('admin.event.index') }}">/ Events / </a>
            <a style="color: #36404a;"> Show </a>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <h4 class="header-title m-t-0 m-b-20">{{ $event->name_ar }}</h4>

                <table class="table table-bordered table-striped">
                    <tbody>

                        <tr>
                            <td> Main Image</td>
                            <td><img src="{{ asset('admin_assets/images/events/' . $event->image) }}" class="img-responsive"
                                    width="100px" height="100px"></td>
                        </tr>
                        <tr>
                            <td> Name Ar</td>
                            <td>{{ $event->translate('ar')->name }}</td>
                        </tr>
                        <tr>
                            <td>Name En </td>
                            <td>{{ $event->translate('en')->name }}</td>
                        </tr>

                        <tr>
                            <td> Description Ar</td>
                            <td>{{ $event->translate('ar')->description }}</td>
                        </tr>
                        <tr>
                            <td>Description En </td>
                            <td>{{ $event->translate('en')->description }}</td>
                        </tr>

                        <tr>
                            <td> Location Ar</td>
                            <td>{{ $event->translate('ar')->location }}</td>
                        </tr>
                        <tr>
                            <td>Location En </td>
                            <td>{{ $event->translate('en')->location }}</td>

                        <tr>

                        <tr>
                            <td>Date </td>
                            <td>{{ $event->date }}</td>

                        <tr>
                            <td>status</td>
                            <td>{{ $event->status == 1 ? 'Active' : ' Inactive' }}</td>
                        </tr>



                    </tbody>
                </table>
            </div>
        </div><!-- end col -->
    </div>
@endsection
