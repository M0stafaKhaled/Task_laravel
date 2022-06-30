@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>Prodcts</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">Products</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <div class="row mb-2">

                    <div class="col-md-12">

                        @if (auth()->user()->hasPermission('read_users'))
                            <a href="{{ route('admin.product.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.create')</a>
                        @endif

                        @if (auth()->user()->hasPermission('delete_users'))
                            <form method="post" action="{{ route('admin.users.bulk_delete') }}" style="display: inline-block;">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="record_ids" id="record-ids">
                                <button type="submit" class="btn btn-danger" id="bulk-delete"><i class="fa fa-trash"></i> @lang('site.bulk_delete')</button>
                            </form><!-- end of form -->
                        @endif

                    </div>

                </div><!-- end of row -->

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" id="data-table-search" class="form-control" autofocus placeholder="@lang('site.search')">
                        </div>
                    </div>

                </div><!-- end of row -->

                <div class="row">

                    <div class="col-md-12">

                        <div class="table-responsive">

                            <table class="table datatable" id="products-table" style="width: 100%;">
                                <thead>
                                <tr>
                                    <th>
                                        <div class="animated-checkbox">
                                            <label class="m-0">
                                                <input type="checkbox" id="record__select-all">
                                                <span class="label-text"></span>
                                            </label>
                                        </div>
                                    </th>
                                    <th>@lang('users.name')</th>
                                    <th>image </th>
                                    <th>category</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product )


                                                    <tr>

                                                    <td>{{ $product->id }}</td>
                                                    <td>{{ $product->name }}</td>

                                                   @if ($product->image)
                                                   <td>
                                                    <img src="{{ Storage::url('uploads/'. $product->image) }}" alt="" style="display: block ; width:50px ; height: 50px;">
                                                   </td>
                                                   @else
                                                  <td> </td>
                                                   @endif
                                                   <td>{{ $product->category->name }}</td>

                                                </tr>


                                    @endforeach
                                </tbody>
                            </table>

                        </div><!-- end of table responsive -->

                    </div><!-- end of col -->

                </div><!-- end of row -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection

@push('scripts')

    <script>

        let usersTable =
        $(document).ready( function () {
            $('#products-table').DataTable();
} );
        // })
    </script>

@endpush
