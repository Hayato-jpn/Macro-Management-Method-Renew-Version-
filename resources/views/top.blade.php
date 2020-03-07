@extends('layouts.admin')
@section('title', 'マクロ管理法とは？')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>マクロ管理法とは？</h2>
                <p>あなたの性別・身長・体重・年齢、そして3段階に分け活動量から算出した1日に摂取すべき総カロリーと、そこから導かれたマクロバランスに沿って食べるだけという超シンプルな食事法です。<br/><br/>これによって、あなたは必要なマクロ栄養素（タンパク質・炭水化物・脂質）を指定されただけ食べていけば、ダイエット・増量など、あなたの目的に合った体作りが可能になります。</p>
                <br />
                <p class="add-p">詳細は、コチラ(↓)をご覧下さい。このサイトの元となった「マクロ管理法とは何か」について説明しています。</p>
                <iframe width="864" height="486" src="https://www.youtube.com/embed/1Y44qkuHJQ0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <p>※このサイトは、動画作成者さんとは全く関係ありません。</p>
                <br />
                <br />
                <h2>このサイトの使い方</h2>
                <p>あなたのプロフィールデータを入力することで1日における必要栄養素が判明します。後は、日々の食事データを入力するだけで、必要栄養素が不足しているのか、それとも摂取し過ぎているのか可視化されます。<br />また、当日だけでなく過去データも閲覧可能です。</p>
                <p>詳細は<a href="{{ url('howtouse') }}">コチラ</a>をご確認下さい。</p>
            </div>
        </div>
    </div>
@endsection