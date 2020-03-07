@extends('layouts.admin')
@section('title', 'プロフィールデータ')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>プロフィールデータ</h2>
                <p>※小数点以下は切り捨て表記</p>
                <div class="form-group row">
                    <label class="col-md-2">目標</label>
                    <div class="col-md-10">
                        <h3>{{ $profile->total_calorie }} kcal</h3>
                        <p>※1日に摂取可能（すべき）カロリー</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2">内訳</label>
                    <div class="col-md-10">
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th width="33%">タンパク質</th>
                                    <th width="33%">炭水化物</th>
                                    <th width="33%">脂質</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td width="33%">{{ $profile->protein }} g</td>
                                    <td width="33%">{{ $profile->carbohydrate }} g</td>
                                    <td width="33%">{{ $profile->lipid }} g</td>
                                </tr>
                            </tbody>
                        </table>
                        <p>※摂取可能（すべき）カロリーから割り出す必要三大栄養素量</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>プロフィールデータ</h2>
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th width="10%">性別</th>
                            <th width="10%">身長</th>
                            <th width="10%">体重</th>
                            <th width="10%">年齢</th>
                            <th width="45%">アクティブ度</th>
                            <th width="15%">目的</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $profile->personal_sex }}</td>
                            <td>{{ $profile->height }} cm</td>
                            <td>{{ $profile->weight }} kg</td>
                            <td>{{ $profile->age }} 歳</td>
                            <td>{{ $profile->personal_active }}</td>
                            <td>{{ $profile->personal_purpose }}</td>
                        </tr>
                    </tbody>
                </table>
                <p>※プロフィールを編集する場合は、<a href="{{ action('Admin\ProfileController@edit', ['id' => $profile->id]) }}">コチラ</a>をタップして下さい。</p>
            </div>
        </div>
    </div>
@endsection