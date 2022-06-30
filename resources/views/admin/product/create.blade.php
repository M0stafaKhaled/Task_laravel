@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('product.product')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">@lang('product.product')</a></li>
        <li class="breadcrumb-item">@lang('site.create')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post"  enctype="multipart/form-data" action="{{ route('admin.product.store') }}">
                    @csrf
                    @method('post')

                    @include('admin.partials._errors')

                    {{--name--}}
                    <div class="form-group">
                        <label>@lang('users.name')<span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required autofocus>
                    </div>


                                {{--Descirption--}}
                    <div class="form-group">
                        <label>@lang('product.descirption')<span class="text-danger">*</span></label>
                        <input type="text" name="description" class="form-control" value="{{ old('name') }}" required autofocus>
                    </div>




                                <div class="form-group">


                                    <label>Category <span class="text-danger">*</span></label>
                                    <select name="category_id" class="form-control select2" required>
                                        <option value="">@lang('site.choose') category</option>
                                        @foreach ($categories as $category)
                                            <option  value="{{ $category->id }}" {{ $category->id == old('$category_id') ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>@lang('users.image') </label>
                                    <input type="file" name="image" class="form-control load-image">

                                </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.create')</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection


