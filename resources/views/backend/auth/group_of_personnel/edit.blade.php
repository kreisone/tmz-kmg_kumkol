@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.group_of_personnel.edit'))

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.access.group_of_personnel.edit') }}
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.auth.group_of_personnel.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row">
            <div class="col">
                <form action="{{ route('admin.auth.group_of_personnel.edit', ['id' => $grp['id']]) }}" method="POST">
                    @csrf

                    <div class="row mt-4">
                        <div class="col">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="group_of_personnel">Группа персонала</span>
                                </div>
                                <input type="text" value="{{ $grp['title'] }}" name="group_of_personnel" class="form-control" placeholder="..." aria-label="group_of_personnel" aria-describedby="group_of_personnel">
                            </div>

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
                        </div>
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
