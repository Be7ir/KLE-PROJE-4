<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Giriş Yap</title>
    <style>
        body {
            background: linear-gradient(to right, purple, red);
        }
        .form-container {
            max-width: 400px;
            padding: 2%;
            margin: auto;
            box-shadow: 5px 5px 10px;
            border: 4px double black;
            background-color: rgba(18, 1, 1, 0.0);
            border-radius: 2vw;
            margin-top: 5%;
        }
    </style>
</head>
<body>
<div class="form-container">
    <form action="/login" method="POST">
        @csrf
        <div class="mb-3">
            <label for="mail" class="form-label">E-mail:</label>
            <input type="email" id="mail" name="email" class="form-control" placeholder="E-mail Giriniz" required>
        </div>
        <div class="mb-3">
            <label for="sifre" class="form-label">Şifre:</label>
            <input type="password" id="sifre" name="password" class="form-control" placeholder="Şifrenizi Giriniz" required>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif
        <p class="mt-3">Hesabın yok mu? <a href="/signup">Kayıt Ol</a></p>
        <button type="submit" class="btn btn-info w-100">Giriş Yap</button>
    </form>
</div>
</body>
</html>
