@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.shopfloor.title'))

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            @if (session('shp_deleted'))
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.access.shopfloor.title') }}
                    </h4>
                </div><!--col-->
                <div class="col-sm-2 alert alert-success">
                    {{ session('shp_deleted') }}
                </div>
                <div class="col-sm-4">
                    @include('backend.auth.shopfloor.includes.search_input')
                </div>
                <div class="col-sm-1">
                    @include('backend.auth.shopfloor.includes.header-buttons')
                </div><!--col-->
            @elseif (session('shp_updated'))
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.access.shopfloor.title') }}
                    </h4>
                </div><!--col-->
                <div class="col-sm-2 alert alert-success">
                    {{ session('shp_updated') }}
                </div>
                <div class="col-sm-4">
                    @include('backend.auth.shopfloor.includes.search_input')
                </div>
                <div class="col-sm-1">
                    @include('backend.auth.shopfloor.includes.header-buttons')
                </div><!--col-->
            @elseif (session('shp_added'))
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.access.shopfloor.title') }}
                    </h4>
                </div><!--col-->
                <div class="col-sm-2 alert alert-success">
                    {{ session('shp_added') }}
                </div>
                <div class="col-sm-4">
                    @include('backend.auth.shopfloor.includes.search_input')
                </div>
                <div class="col-sm-1">
                    @include('backend.auth.shopfloor.includes.header-buttons')
                </div><!--col-->
            @elseif (session('error'))
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.access.shopfloor.title') }}
                    </h4>
                </div><!--col-->
                <div class="col-sm-2 alert alert-danger text-center">
                    {{ session('error') }}
                </div>
                <div class="col-sm-4">
                    @include('backend.auth.shopfloor.includes.search_input')
                </div>
                <div class="col-sm-1">
                    @include('backend.auth.shopfloor.includes.header-buttons')
                </div><!--col-->
            @else
                <div class="col-sm-7">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.access.shopfloor.title') }}
                    </h4>
                </div><!--col-->
                <div class="col-sm-4">
                    @include('backend.auth.shopfloor.includes.search_input')
                </div>
                <div class="col-sm-1">
                    @include('backend.auth.shopfloor.includes.header-buttons')
                </div><!--col-->
            @endif

        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    {{ $shopfloor->links() }}
                    <table class="table">
                        <thead>
                            <tr>
                                <th>@lang('labels.backend.access.shopfloor.table.number')</th>
                                <th>@lang('labels.backend.access.shopfloor.table.title_shopfloor')</th>
                                <th>@lang('labels.backend.access.shopfloor.table.action')</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($shopfloor as $shp)
                            <tr>
                                <td>{{ $shp->id }}</td>
                                <td>{{ $shp->title }}</td>
                                <td>
                                    <a href="{{ route('admin.auth.shopfloor.edit.show', ['id' => $shp->id]) }}" class="btn btn-primary" role="button" aria-pressed="true">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <a href="{{ route('admin.auth.shopfloor.delete', ['id' => $shp->id]) }}" class="btn btn-danger" role="button" aria-pressed="true">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $shopfloor->links() }}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
