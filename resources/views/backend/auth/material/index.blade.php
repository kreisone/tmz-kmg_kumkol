@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.materials.title'))

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            @if (session('mat_deleted'))
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.access.materials.title') }}
                    </h4>
                </div><!--col-->
                <div class="col-sm-2 alert alert-success">
                    {{ session('mat_deleted') }}
                </div>
                <div class="col-sm-4">
                    @include('backend.auth.material.includes.search_input')
                </div>
                <div class="col-sm-1">
                    @include('backend.auth.material.includes.header-buttons')
                </div><!--col-->
            @elseif (session('mat_updated'))
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.access.materials.title') }}
                    </h4>
                </div><!--col-->
                <div class="col-sm-2 alert alert-success">
                    {{ session('mat_updated') }}
                </div>
                <div class="col-sm-4">
                    @include('backend.auth.material.includes.search_input')
                </div>
                <div class="col-sm-1">
                    @include('backend.auth.material.includes.header-buttons')
                </div><!--col-->
            @elseif (session('mat_added'))
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.access.materials.title') }}
                    </h4>
                </div><!--col-->
                <div class="col-sm-2 alert alert-success">
                    {{ session('mat_added') }}
                </div>
                <div class="col-sm-4">
                    @include('backend.auth.material.includes.search_input')
                </div>
                <div class="col-sm-1">
                    @include('backend.auth.material.includes.header-buttons')
                </div><!--col-->
            @elseif (session('error'))
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.access.materials.title') }}
                    </h4>
                </div><!--col-->
                <div class="col-sm-2 alert alert-danger text-center">
                    {{ session('error') }}
                </div>
                <div class="col-sm-4">
                    @include('backend.auth.material.includes.search_input')
                </div>
                <div class="col-sm-1">
                    @include('backend.auth.material.includes.header-buttons')
                </div><!--col-->
            @else
                <div class="col-sm-7">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.access.materials.title') }}
                    </h4>
                </div><!--col-->
                <div class="col-sm-4">
                    @include('backend.auth.material.includes.search_input')
                </div>
                <div class="col-sm-1">
                    @include('backend.auth.material.includes.header-buttons')
                </div><!--col-->
            @endif

        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    {{ $materials->links() }}
                    <table class="table">
                        <thead>
                            <tr>
                                <th>@lang('labels.backend.access.materials.table.number')</th>
                                <th>@lang('labels.backend.access.materials.table.title_material')</th>
                                <th>@lang('labels.backend.access.materials.table.action')</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($materials as $mat)
                            <tr>
                                <td>{{ $mat->id }}</td>
                                <td>{{ $mat->title }}</td>
                                <td>
                                    <a href="{{ route('admin.auth.material.edit.show', ['id' => $mat->id]) }}" class="btn btn-primary" role="button" aria-pressed="true">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <a href="{{ route('admin.auth.material.delete', ['id' => $mat->id]) }}" class="btn btn-danger" role="button" aria-pressed="true">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $materials->links() }}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
