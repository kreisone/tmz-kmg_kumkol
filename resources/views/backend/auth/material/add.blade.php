@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.materials.add'))

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.access.materials.add') }}
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row">
            <div class="col">
                <form action="{{ route('admin.auth.material.add') }}" method="POST">
                    @csrf
                    <div class="row mt-4">
                        <div class="col">
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Наименование материала</span>
                              </div>
                              <input type="text" class="form-control" name="title" placeholder="" aria-label="material" aria-describedby="basic-addon1">
                            </div>
                        </div><!--col-->
                    </div><!--row-->
                    <div class="row mt-4">
                        <div class="col">
                            <button type="input" class="btn btn-primary">Сохранить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div><!--card-body-->
</div><!--card-->
@endsection
