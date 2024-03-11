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
        <a style="color: #fff;" href="{{route('admin.home')}}">Home</a>
        <a style="color: #fff;" href="{{route('admin.product.index')}}">/ Products / </a>
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
            <h4 class="header-title m-t-0 m-b-20">{{$product->name_ar}}</h4>

            <table class="table table-bordered table-striped">
                <tbody>

                    <tr>
                        <td> Main Image</td>
                        <td><img src="{{asset('admin_assets/images/products/'.$product->image)}}" class="img-responsive" width="100px" height="100px"></td>
                    </tr>
                    <tr>
                        <td> Name Ar</td>
                        <td>{{ $product->translate('ar')->name }}</td>
                    </tr>
                    <tr>
                        <td>Name En </td>
                        <td>{{ $product->translate('en')->name }}</td>
                    </tr>
                    <tr>
    <td>Categories</td>
    <td>
        @foreach ($product->categories as $category)
            {{ $category->translate('ar')->name }}
            @if (!$loop->last)
                , <!-- Add comma if it's not the last category -->
            @endif
        @endforeach
    </td>
</tr>
                    <tr>
                        <td> Title Ar</td>
                        <td>{{ $product->translate('ar')->title }}</td>
                    </tr>
                    <tr>
                        <td>Title En  </td>
                        <td>{{ $product->translate('en')->title }}</td>
                    </tr>
                    <tr>
                        <td> Alt Ar</td>
                        <td>{{ $product->translate('ar')->alt }}</td>
                    </tr>
                    <tr>
                        <td>Alt En  </td>
                        <td>{{ $product->translate('en')->alt }}</td>
                    </tr>
                    <tr>
                        <td> Description Ar</td>
                        <td>{{ $product->translate('ar')->description }}</td>
                    </tr>
                    <tr>
                        <td>Description En  </td>
                        <td>{{ $product->translate('en')->description }}</td>
                    </tr>
                   
                    <tr>
                        <td> Description Meta Ar</td>
                        <td>{{ $product->translate('ar')->description_meta }}</td>
                    </tr>
                    <tr>
                        <td>Description Meta En  </td>
                        <td>{{ $product->translate('en')->description_meta }}</td>
                    </tr><tr>
                        <td> Keyword Ar</td>
                        <td>{{ $product->translate('ar')->keywords }}</td>
                    </tr>
                    <tr>
                        <td>Keyword En  </td>
                        <td>{{ $product->translate('en')->keywords }}</td>
                    </tr><tr>
                        <td> Keyword Meta Ar</td>
                        <td>{{ $product->translate('ar')->keywords_meta }}</td>
                    </tr>
                    <tr>
                        <td>Keyword Meta En  </td>
                        <td>{{ $product->translate('en')->keywords_meta }}</td>
                    </tr>
                    <tr>
                        <td>status</td>
                        <td>{{$product->status == 1 ? 'Active' : ' Inactive'}}</td>
                    </tr>
                  
                   
                  
                </tbody>
            </table>
        </div>
    </div><!-- end col -->
</div>

@endsection
