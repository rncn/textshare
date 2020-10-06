<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワードを入力してください。</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
</head>
<body>
    <div class="container">
        <div class="box has-background-black my-5">
            <h1 class="title is-2 has-text-success">このテキストはパスワードで保護されています。</h1>
        </div>
        <div class="box my-5">
            <h1 class="title is-5">閲覧するには、パスワードを入力してください。</h1>
            <div class="field">
                <div class="control">
                    <form method="POST" action="{{ route('password') }}">
                        @csrf
                        <input class="input is-info has-background-success-light" type="text" placeholder="Please, type a password." name="password">
                        <input type="hidden" name="id" value="{{ $id }}" hidden>
                        <button class="button is-fullwidth" type="submit">確認</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>