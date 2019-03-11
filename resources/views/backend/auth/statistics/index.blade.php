@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.statistics.title'))

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.access.statistics.title') }}
                </h4>
            </div><!--col-->

        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <form action="{{ route('admin.auth.statistics.index') }}" method="GET">
                    @csrf
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="shopfloor">Цех</label>
                                </div>
                                <select class="custom-select" name="shopfloor" id="shopfloor">
                                    <option value="" selected>Выбрать...</option>
                                    @foreach ($shopfloor as $shflr)
                                        <option value="{{ $shflr['id'] }}">
                                            {{ $shflr['title'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="group_of_personnel">Группа персонала</label>
                                </div>
                                <select class="custom-select" name="group_of_personnel" id="group_of_personnel">
                                    <option value="" selected>Выбрать...</option>
                                    @foreach ($group_of_personnel as $grp)
                                        <option value="{{ $grp['id'] }}">
                                            {{ $grp['shopfloor_title'] }} / {{ $grp['title'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="worker">Сотрудник</label>
                                </div>
                                <select class="custom-select" name="worker" id="worker">
                                    <option value="" selected>Выбрать...</option>
                                    @foreach ($worker as $wrk)
                                        <option value="{{ $wrk['id'] }}">
                                            {{ $wrk['lastname'] }} {{ $wrk['name'] }} {{ $wrk['middlename'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-sm-2">
                            <button type="input" class="btn btn-primary">Показать</button>
                        </div>

                    </div>
                </form>
            </div><!--col-->
        </div><!--row-->

        @if ($item)
        <div class="row">
            <div class="col">
                <table class="table">
                        <thead>
                            <tr>
                                <th>@lang('labels.backend.access.statistics.table.number')</th>
                                <th>@lang('labels.backend.access.statistics.table.title_shopfloor')</th>
                                <th>@lang('labels.backend.access.statistics.table.title_group_of_personnel')</th>
                                <th>@lang('labels.backend.access.statistics.table.title_worker')</th>
                                <th>@lang('labels.backend.access.statistics.table.title_material')</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($item as $key => $itm)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $itm['shopfloor_title'] }}</td>
                                <td>{{ $itm['group_for_personnel_title'] }}</td>
                                <td>
                                    {{ $itm['lastname'] }} {{ $itm['name'] }} {{ $itm['middlename'] }}  
                                </td>
                                <td>
                                    @foreach ($itm['materials'] as $itm_mat)
                                        {{ $itm_mat }} <br />
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
            {{ $item->links() }}
            </div>
        </div>
        @endif

    </div><!--card-body-->
</div><!--card-->
@endsection
