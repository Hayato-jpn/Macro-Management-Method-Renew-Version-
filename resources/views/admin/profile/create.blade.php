@extends('layouts.admin')
@section('title', 'プロフィール新規登録')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>プロフィール新規登録</h2>
                <p>下記にある必要情報を正しく入力して下さい。<br />入力内容から、</p>
                <ul>
                    <li>あなたの目的(ダイエット等)に沿った場合の「1日の推奨摂取カロリー」</li>
                    <li>1日の必要カロリーから推奨される「三大栄養素(タンパク質、脂質、炭水化物)量」</li>
                </ul>
                <p>を計算します。</p>
                <form action="{{ action('Admin\ProfileController@record') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    
                    <div class="form-group row">
                        <input type="hidden" name="user_id" value="{{ $user_id }}">
                        <label class="col-md-2">性別</label>
                        <div class="col-md-10">
                            <select class="form-control" name="sex">
                                <option value="">性別を選択して下さい</option>
                                <option value="man">男性</option>
                                <option value="woman">女性</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">身長</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="height" value="{{ old('height') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">体重</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="weight" value="{{ old('weight') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">年齢</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="age" value="{{ old('age') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">アクティブ度</label>
                        <div class="col-md-10">
                            <select class="form-control" name="active">
                                <option value="">アクティブ度を選択して下さい</option>
                                <option value="low">【低】座り仕事が多く、一日の運動は歩いたり階段を上ったりする程度</option>
                                <option value="normal">【普通】立ち仕事や重労働が多く、比較的一日中動き回っている</option>
                                <option value="high">【高】立ち仕事や重労働が多く、それに加えジムでトレーニングを行っている</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">目的</label>
                        <div class="col-md-10">
                            <select class="form-control" name="purpose">
                                <option value="">目的を選択して下さい</option>
                                <option value="diet">減量(ダイエット)</option>
                                <option value="keep">現状維持</option>
                                <option value="increase">増量</option>
                            </select>
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="登録">
                </form>
            </div>
        </div>
    </div>
@endsection