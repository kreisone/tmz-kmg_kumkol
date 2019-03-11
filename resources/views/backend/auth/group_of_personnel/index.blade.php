@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.group_of_personnel.title'))

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            @if (session('grp_deleted'))
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.access.group_of_personnel.title') }}
                    </h4>
                </div><!--col-->
                <div class="col-sm-2 alert alert-success">
                    {{ session('grp_deleted') }}
                </div>
                <div class="col-sm-4">
                    @include('backend.auth.group_of_personnel.includes.search_input')
                </div>
                <div class="col-sm-1">
                    @include('backend.auth.group_of_personnel.includes.header-buttons')
                </div><!--col-->
            @elseif (session('grp_updated'))
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.access.group_of_personnel.title') }}
                    </h4>
                </div><!--col-->
                <div class="col-sm-2 alert alert-success">
                    {{ session('grp_updated') }}
                </div>
                <div class="col-sm-4">
                    @include('backend.auth.group_of_personnel.includes.search_input')
                </div>
                <div class="col-sm-1">
                    @include('backend.auth.group_of_personnel.includes.header-buttons')
                </div><!--col-->
            @elseif (session('grp_added'))
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.access.group_of_personnel.title') }}
                    </h4>
                </div><!--col-->
                <div class="col-sm-2 alert alert-success">
                    {{ session('grp_added') }}
                </div>
                <div class="col-sm-4">
                    @include('backend.auth.group_of_personnel.includes.search_input')
                </div>
                <div class="col-sm-1">
                    @include('backend.auth.group_of_personnel.includes.header-buttons')
                </div><!--col-->
            @elseif (session('grp_existed'))
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.access.group_of_personnel.title') }}
                    </h4>
                </div><!--col-->
                <div class="col-sm-2 alert alert-warning">
                    {{ session('grp_existed') }}
                </div>
                <div class="col-sm-4">
                    @include('backend.auth.group_of_personnel.includes.search_input')
                </div>
                <div class="col-sm-1">
                    @include('backend.auth.group_of_personnel.includes.header-buttons')
                </div><!--col-->
            @elseif (session('error'))
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.access.group_of_personnel.title') }}
                    </h4>
                </div><!--col-->
                <div class="col-sm-2 alert alert-danger text-center">
                    {{ session('error') }}
                </div>
                <div class="col-sm-4">
                    @include('backend.auth.group_of_personnel.includes.search_input')
                </div>
                <div class="col-sm-1">
                    @include('backend.auth.group_of_personnel.includes.header-buttons')
                </div><!--col-->
            @else
                <div class="col-sm-7">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.access.group_of_personnel.title') }}
                    </h4>
                </div><!--col-->
                <div class="col-sm-4">
                    @include('backend.auth.group_of_personnel.includes.search_input')
                </div>
                <div class="col-sm-1">
                    @include('backend.auth.group_of_personnel.includes.header-buttons')
                </div><!--col-->
            @endif

        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                    <div class="row mb-2">
                        <div class="col-sm-2">

                        @if (active_class(Active::checkUriPattern('admin/group_of_personnel')))
                            <div class="dropdown">
                                <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Цеха
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    @foreach ($shopfloors as $shflr)
                                        <a class="dropdown-item" href="{{ route('admin.auth.group_of_personnel.index', ['shopfloor' => $shflr['id']]) }}">
                                            {{ $shflr['title'] }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        </div>
                    </div>
                    <!-- </div> -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th>@lang('labels.backend.access.group_of_personnel.table.number')</th>
                                <th>@lang('labels.backend.access.group_of_personnel.table.title_group')</th>
                                <th>@lang('labels.backend.access.group_of_personnel.table.title_shopfloor')</th>
                                <th>@lang('labels.backend.access.group_of_personnel.table.action')</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($group_of_personnel as $grp)
                            <tr>
                                <td>{{ $grp->id }}</td>
                                <td>{{ $grp->title }}</td>
                                <td>{{ $grp->shopfloor_title }}</td>
                                <td>
                                    <a href="{{ route('admin.auth.group_of_personnel.edit.show', ['id' => $grp->id]) }}" class="btn btn-primary" role="button" aria-pressed="true">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <a href="{{ route('admin.auth.group_of_personnel.delete', ['id' => $grp->id]) }}" class="btn btn-danger" role="button" aria-pressed="true">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $group_of_personnel->links() }}
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
