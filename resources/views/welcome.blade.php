<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TextShare(仮) オンラインでテキストを共有</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//cdn.quilljs.com/1.3.6/quill.bubble.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        {{-- ページ遷移時確認 --}}
        window.onbeforeunload = function(e) {
            //e.returnValue = "ページを離れようとしています。よろしいですか？";
        }
        function send() {
            const container = document.getElementsByClassName('ql-editor')[0].innerHTML;
            const input = document.forms.main.content;
            input.value = container;
            document.forms.main.submit();

        }
    </script>

    <meta name="description" content="会員登録せずテキストを簡単に共有しましょう！TextShareなら登録不要です！">

    <!-- Google / Search Engine Tags -->
    <meta itemprop="name" content="TextShare テキストシェア">
    <meta itemprop="description" content="会員登録せずテキストを簡単に共有しましょう！TextShareなら登録不要です！">
    <meta itemprop="image" content="https://textshare.rnicsn.com/ogp.png">

    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="http://textshare.rnicsn.com">
    <meta property="og:type" content="website">
    <meta property="og:title" content="TextShare テキストシェア">
    <meta property="og:description" content="会員登録せずテキストを簡単に共有しましょう！TextShareなら登録不要です！">
    <meta property="og:image" content="https://textshare.rnicsn.com/ogp.png">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="TextShare テキストシェア">
    <meta name="twitter:description" content="会員登録せずテキストを簡単に共有しましょう！TextShareなら登録不要です！">
    <meta name="twitter:image" content="https://textshare.rnicsn.com/ogp.png">

<!-- Meta Tags Generated via http://heymeta.com -->

</head>
<body>
    <div class="brand-nav">
        <p class="powerdby">Powerd by</p>
        <a href="https://about.rnicsn.com/" target="_blank"><img class="logo" src="https://about.rnicsn.com/logo.svg" alt="logo"></a>
    </div>
    <nav class="navbar navbar-light fixed-top">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Text Share (仮)</a>
          <div>
            <a href="#editor" class="btn blur shadow-sm">はじめる</a>
          </div>
        </div>
    </nav>
    <article>
        <section class="pr">
            <h2 class="pr-text">簡単にテキストを公開・編集</h2>
            <p class="pr-text">簡単にシンプルなテキストページを作成できます。テキストにスタイルを指定することもできます。<br>シンプルで広告に邪魔されることなくテキストを公開できます。<a href="/sample">サンプル</a></p>
        </section>
        <section class="editor-ui">
            <div class="controll">
                <h2>エディターで書く</h2>
                <p>画像を貼り付けできてしまいますが、投稿はできません。ご了承下さい。<br>公開時に、ページ遷移の確認ダイアログがでますが、無視できます。</p>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form id="main" method="POST" action="{{ route('post') }}" autocomplete="off">
                    @csrf
                    <input class="form-control" name="title" placeholder="タイトル(必須)" type="text" value="{{ old('title') }}">
                    <input class="form-control" name="delpassword" placeholder="削除用パスワード(必須)" type="password" value="{{ old('delpassword') }}">
                    <input class="form-control" name="password" placeholder="閲覧用パスワード" type="password" value="{{ old('password') }}">
                    <input hidden name="content" type="hidden">
                    <span>テーマ</span>
                    <select name="theme" class="form-select" aria-label="Default select " name="themes">
                        <option value="1">Basic</option>
                        <option value="2">Simple</option>
                    </select>
                </form>
                <button type="button" onclick="send();" class="btn btn-success shadow-sm btn-block"><a href="https://about.rnicsn.com/terms.html" target="_blank">利用規約に同意して</a>公開</button>
            </div>
            <div id="editor">
                @if(old('content'))
                {!! old('content') !!}
                @else
                <p>ようこそ</p>
                <h1>ここから書き始めて下さい！</h1>
                <blockquote>引用も利用できます！</blockquote>
                <a href="https://www.example.com">リンク</a>
                @endif
            </div>
        </section>
        <script>
        var quill = new Quill('#editor', {
            theme: 'bubble',
            placeholder: 'ココをタップして書き始めて下さい！'
        });
        </script>
    </article>
</body>
</html>