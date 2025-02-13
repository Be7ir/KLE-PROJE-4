<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Kayıt Ol</title>
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
    <form action="/signup" method="POST">
        @csrf

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-3">
            <label for="isim" class="form-label">İsim Soyisim:</label>
            <input type="text" id="isim" name="username" class="form-control" placeholder="İsim ve Soyisim Giriniz" required>
        </div>

        <div class="mb-3">
            <label for="mail" class="form-label">E-mail:</label>
            <input type="email" id="mail" name="email" class="form-control" placeholder="E-mail Giriniz" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Şifre:</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Şifrenizi Giriniz" required>
        </div>

        <div class="mb-3">
            <label for="confirm_password" class="form-label">Şifre Tekrarı:</label>
            <input type="password" id="confirm_password" name="password_confirmation" class="form-control" placeholder="Şifrenizi Tekrar Giriniz" required>
        </div>

        <div>
            <p>Zaten hesabınız var mı? <a href="/login">Giriş yap</a></p>
        </div>
        <button type="submit" class="btn btn-info w-100">Kayıt ol</button>
    </form>
</div>
</body>
</html>
