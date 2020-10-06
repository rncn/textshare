<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }}</title>
    @if($post->theme_id == 1)
    <link rel="stylesheet" href="{{ asset('css/themes/basic.css') }}">
    @elseif($post->theme_id == 2)
    <link rel="stylesheet" href="{{ asset('css/themes/simple.css') }}">
    <meta name="robots" content="nofollow" />
    @endif
</head>
<body>
    <header>
        <h1>{{ $post->title }}</h1>
    </header>
    <div class="container">
        {!! nl2br($post->content) !!}
    </div>
    <div class="app-pr">Powerd by <a href="{{ route('home') }}">TextShare</a></div>
    <footer >
        
            <form action="{{ route('delete') }}" method="POST">
                @csrf
                <h2>記事を削除する</h2>
                <label for="password_input">下の入力欄に削除用パスワードを入力してください。</label>
                <input id="password_input" type="text" name="password">
                <input type="hidden" name="id" value="{{ $post->id }}">
                <button type="submit">削除</button>
            </form>
    </footer>
    <p>このテキストは、TextShareが作成したものではありません。</p>
</body>
</html>