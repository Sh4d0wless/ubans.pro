@extends('layouts.app')

@section('title', 'Профиль')

@section('content')
    <div class="container mt-3">
        <div class="row row-sm">
            <div class="col-lg-8">
                <div class="card card-profile">
                    <div class="card-body">
                        <div class="media">
                            <img src="http://via.placeholder.com/500x500" alt="">
                            <div class="media-body">
                                <h3 class="card-profile-name">{{ $model->nickname }}</h3>
                                <p>{{ $model->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-sm">
                    @forelse($model->privileges as $privilege)
                        <div class="col-lg-6 mg-t-20">
                            <div class="card card-info">
                                <div class="card-body pd-40 server-{{ $privilege['server']->id }}">
                                    <h5 class="tx-inverse mg-b-20">{{ $privilege['server']->hostname }}</h5>
                                    @if($privilege['privilege'])
                                        <p class="tx-18">{{ $privilege['privilege']->title }}</p>
                                        <p>Действует до: <b>{{ $privilege['expire'] }}</b></p>
                                        @if($privilege['server']->pivot->expire !== null && $privilege['privilege']->rates)
                                            <div class="form-group">
                                                <select class="form-control select2-show-search select2-hidden-accessible"
                                                        name="rate">
                                                    @foreach($privilege['privilege']->rates as $rate)
                                                        <option value="{{ $rate->id }}">
                                                            @if ($rate->term === 0)
                                                                Навсегда
                                                            @else
                                                                {{ $rate->term  }} дн.
                                                            @endif
                                                             - {{ $rate->price }} руб.
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button class="btn btn-teal btn-block extend-privilege"
                                                    data-server="{{ $privilege['server']->id }}">Продлить</button>
                                        @endif
                                    @else
                                        <p>Привилегию невозможно продлить.</p>
                                        <p>Доступ на сервере: <b>{{ $privilege['flags'] }}</b></p>
                                        <p>Действует до: <b>{{ $privilege['expire'] }}</b></p>
                                    @endif
                                </div><!-- card -->
                            </div><!-- card -->
                        </div>
                    @empty
                        <div class="col-lg-6 mg-t-20">
                            <div class="card card-info">
                                <div class="card-body pd-40">
                                    <h5 class="tx-inverse mg-b-20">Услуги не найдены</h5>
                                    <p>Покупка привилегии способствует дальнейшему развитию проекта.</p>
                                    <a href="{{ route('payment.privilege') }}"
                                       class="btn btn-primary btn-block">Купить</a>
                                </div><!-- card -->
                            </div><!-- card -->
                        </div>
                    @endforelse
                </div>
            </div><!-- col-8 -->

            <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                <div class="card pd-25">
                    <div class="slim-card-title">Контакты проекта</div>

                    <div class="media-list mg-t-25">
                        <div class="media">
                            <div><i class="icon ion-link tx-24 lh-0"></i></div>
                            <div class="media-body mg-l-15 mg-t-4">
                                <h6 class="tx-14 tx-gray-700">Сайты</h6>
                                <a href="//vk.com/sentryguns" class="d-block">vk.com/sentryguns</a>
                                <a href="//steamcommunity.com/groups/sentryguns" class="d-block">steamcommunity.com</a>
                            </div>
                        </div>
                        <div class="media mg-t-25">
                            <div><i class="icon ion-ios-email-outline tx-24 lh-0"></i></div>
                            <div class="media-body mg-l-15 mg-t-4">
                                <h6 class="tx-14 tx-gray-700">Почта админа</h6>
                                <span class="d-block">admin@sentryguns.ru</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body pd-30 update-profile-form" data-action="{{ route('profile.update') }}">
                        <h6 class="slim-card-title">Обновить информацию</h6>

                        <div class="form-group">
                            <label class="form-control-label">Ник</label>
                            <input type="text" name="nickname" class="form-control" value="{{ $model->steamid }}" required>
                            <p class="errors parsley-errors-list mt-2"></p>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label">Новый пароль</label>
                            <input type="text" name="password" class="form-control">
                            <p class="errors parsley-errors-list mt-2"></p>
                        </div>

                        <div class="mg-t-30">
                            <button class="btn btn-primary pd-x-20 do-update">Сохранить</button>
                        </div>
                    </div><!-- card-body -->
                </div>
            </div>
        </div>
    </div>
@endsection