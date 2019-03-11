@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.config.title'))

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            @if (session('config_saved'))
                <div class="col-sm-4">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.access.config.title') }}
                    </h4>
                </div><!--col-->
                <div class="col-sm-3 alert alert-success">
                    {{ session('config_saved') }}
                </div>
            @else
                <div class="col-sm-7">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.access.config.title') }}
                    </h4>
                </div>
            @endif

        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <form action="{{ route('admin.auth.config.save') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Пагинация страниц</span>
                                </div>
                                <input type="text" name="count_of_page" value="{{ $count_of_page }}" class="form-control" placeholder="" aria-label="count_of_page" aria-describedby="basic-addon1">
                            </div>
                        </div>
                      
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <button type="input" class="btn btn-primary">Сохранить</button>
                        </div>
                    </div>
                </form>
            </div><!--col-->
        </div><!--row-->


    </div><!--card-body-->
</div><!--card-->
@endsection
