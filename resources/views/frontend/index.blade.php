@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')
    <div class="row justify-content-center align-items-center">
        <div class="col col-sm-10 align-self-center">

            @guest
                <div class="row justify-content-center align-items-center">
                    <div class="col-sm-8">
                        <div class="card">
                            <div class="card-header">
                                <strong>
                                    @lang('labels.frontend.auth.login_box_title')
                                </strong>
                            </div><!--card-header-->

                            <div class="card-body">
                                {{ html()->form('POST', route('frontend.auth.login.post'))->open() }}
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                {{ html()->label(__('validation.attributes.frontend.email'))->for('email') }}

                                                {{ html()->email('email')
                                                    ->class('form-control')
                                                    ->placeholder(__('validation.attributes.frontend.email'))
                                                    ->attribute('maxlength', 191)
                                                    ->required() }}
                                            </div><!--form-group-->
                                        </div><!--col-->
                                    </div><!--row-->

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                {{ html()->label(__('validation.attributes.frontend.password'))->for('password') }}

                                                {{ html()->password('password')
                                                    ->class('form-control')
                                                    ->placeholder(__('validation.attributes.frontend.password'))
                                                    ->required() }}
                                            </div><!--form-group-->
                                        </div><!--col-->
                                    </div><!--row-->

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <div class="checkbox">
                                                    {{ html()->label(html()->checkbox('remember', true, 1) . ' ' . __('labels.frontend.auth.remember_me'))->for('remember') }}
                                                </div>
                                            </div><!--form-group-->
                                        </div><!--col-->
                                    </div><!--row-->

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group clearfix">
                                                {{ form_submit(__('labels.frontend.auth.login_button')) }}
                                            </div><!--form-group-->
                                        </div><!--col-->
                                    </div><!--row-->

                                    
                                {{ html()->form()->close() }}

                            </div><!--card body-->
                        </div><!--card-->
                    </div>
                </div>
            @endguest

            @auth
                <form action="{{ route('frontend.user.get_worker') }}" method="POST">
                    <div class="input-group mb-3">
                        {{ csrf_field() }}
                        <input name="card_number" type="text" class="form-control" placeholder="Введите номер карты" aria-label="Введите номер карты" aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Найти</button>
                        </div>
                    </div>
                </form>

                @if (session('hasnt_worker'))
                    <div class="alert alert-warning">
                        {{ session('hasnt_worker') }}
                    </div>
                @endif



                @if (active_class(Active::checkUri('get_worker')))
                <div class="card">
                    <div class="card-header">
                        <strong>
                            <i class="fas fa-user-circle"></i> @lang('labels.frontend.home.user_card')
                        </strong>
                    </div><!--card-header-->

                    <div class="card-body">
                        <div class="row">
                            <div class="col col-sm-4">
                                <div class="card mb-4 bg-light">
                                    <img class="card-img-top" style="flex: 0 0 auto" src="{{ $worker['avatar'] }}" alt="Фото сотрудника">

                                    <div class="card-body">
                                        <h4 class="card-title">
                                            {{ $worker['lastname'] }} {{ $worker['name'] }} {{ $worker['middlename'] }}
                                        </h4>

                                        <p class="card-text">
                                            <small>
                                                <i class="fas fa-building"></i> {{ $shopfloor['title'] }}<br/> 

                                                @foreach ($personnel as  $key)
                                                    <i class="fas fa-briefcase"></i> {{ $key[0]['title'] }}<br/>
                                                @endforeach
                                            </small>
                                        </p>

                                    </div>
                                </div>
                            </div><!--col-md-4-->

                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col">
                                        <div class="card mb-4">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item list-group-item-primary">Список материалов допустимых к проносу</li>

                                                @foreach ($materials as $mat)
                                                    <li class="list-group-item">{{ $mat['title'] }}</li>
                                                @endforeach
                                                
                                            </ul>
                                        </div><!--card-->
                                    </div><!--col-md-6-->
                                </div><!--row-->
                                
                            </div><!--col-md-8-->
                        </div><!-- row -->
                    </div> <!-- card-body -->
                </div><!-- card -->
                @endif

            @endauth



        </div><!-- col-md-8 -->
    </div><!-- row -->

    
@endsection
