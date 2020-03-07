@extends('layouts.admin')
@section('title', '本日の進捗')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>本日の進捗</h2>
                <div class="form-group row">
                    <label class="col-md-2">摂取カロリー</label>
                    <div class="col-md-10">
                        <h3>{{ $todayCalorie }}kcal</h3>
                        <p>※今日摂取したカロリー</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2">目標カロリー</label>
                    <div class="col-md-10">
                        <h3>{{ $profile->total_calorie }}kcal</h3>
                        <p>※1日に摂取可能（すべき）カロリー</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2">内訳</label>
                    <div class="col-md-10">
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th width="33%">タンパク質 (現在/目標値)</th>
                                    <th width="33%">炭水化物 (現在/目標値)</th>
                                    <th width="33%">脂質 (現在/目標値)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td width="33%">{{ $todayProtein }} / {{ $profile->protein }} g</td>
                                    <td width="33%">{{ $todayCarbohydrate }} / {{ $profile->carbohydrate }} g</td>
                                    <td width="33%">{{ $todayLipid }} / {{ $profile->lipid }} g</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <p>本日食べたもの一覧</p>
                <div class="row">
                    <div class="list-news col-md-12 mx-auto">
                        <div class="row">
                            <table class="table table-dark">
                                <thead>
                                    <tr>
                                        <th width="10%">朝昼晩</th>
                                        <th width="12%">食品名</th>
                                        <th width="15%">タンパク質(g)</th>
                                        <th width="14%">炭水化物(g)</th>
                                        <th width="13%">脂質(g)</th>
                                        <th width="7%">編集</th></th>
                                        <th width="7%">削除</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($foods as $food)
                                        <tr>
                                            <td>{{ \Str::limit($food->eat_time, 100) }}</td>
                                            <td>{{ \Str::limit($food->food, 100) }}</td>
                                            <td>{{ \Str::limit($food->protein, 100) }}</td>
                                            <td>{{ \Str::limit($food->carbohydrate, 100) }}</td>
                                            <td>{{ \Str::limit($food->lipid, 100) }}</td>
                                            <td>
                                                <div>
                                                    <a href="{{ action('Admin\FoodController@edit', ['id' => $food->id]) }}">編集</a>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <a href="{{ action('Admin\FoodController@delete', ['id' => $food->id]) }}">削除</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <p>※食品を追加する場合は、<a href="{{ url('admin/food/create') }}">コチラ</a>から。</p>
          </div>
@endsection