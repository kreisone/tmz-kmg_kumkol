@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.group_of_personnel.add'))


@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.access.group_of_personnel.add') }}
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row">
            <div class="col">
                <form action="{{ route('admin.auth.group_of_personnel.add') }}" method="POST">
                    @csrf
                    <div class="row mt-4">
                        <div class="col">
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Наименование группы персонала</span>
                              </div>
                              <input type="text" class="form-control" name="group_of_personnel" placeholder="" aria-label="group_of_personnel" aria-describedby="basic-addon1">
                            </div>
                        </div><!--col-->
                    </div><!--row-->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="shopfloor">Цех</label>
                        </div>
                        <select class="custom-select" name="shopfloor" id="shopfloor">
                            <option value="" selected>Выбрать...</option>
                            @foreach ($shopfloors as $shflr)
                                <option value="{{ $shflr['id'] }}">
                                    {{ $shflr['title'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
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
