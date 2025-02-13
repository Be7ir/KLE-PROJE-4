<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürünler</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">


    <div class="d-flex justify-content-end mb-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger" style="margin-bottom: -115%;">Çıkış Yap</button>
        </form>
    </div>

    <h2>Yeni Ürün Ekle</h2>
    <form method="POST" action="{{ url('/products') }}" class="mb-4">
        @csrf
        <div class="row">
            <div class="col-12 col-md-4 mb-4">
                <input type="text" name="urun_adı" placeholder="Ürün Adı" class="form-control" required>
            </div>
            <div class="col-12 col-md-4 mb-4">
                <input type="number" step="0.01" name="urun_fiyatı" placeholder="Ürün Fiyatı" class="form-control" required>
            </div>
            <div class="col-12 col-md-4 mb-4">
                <input type="text" name="urun_açıklaması" placeholder="Ürün Açıklaması" class="form-control" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary w-100">Ekle</button>
    </form>

    @if(session('message'))
        <div class="alert alert-info">
            {{ session('message') }}
        </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


    <h2 class="mt-4">Ürünler</h2>
    <ul class="list-group mb-3">
        @foreach ($products as $product)
            <li class="list-group-item">
                <form method="POST" action="{{ url('/products/' . $product['id']) }}" class="d-inline">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-4 mb-2">
                            <label class="form-label">Ürün Adı</label>
                            <input type="text" name="urun_adı" value="{{ $product['urun_adı'] }}" class="form-control" required>
                        </div>
                        <div class="col-12 col-md-4 mb-2">
                            <label class="form-label">Ürün Fiyatı (TL)</label>
                            <input type="number" step="0.01" name="urun_fiyatı" value="{{ $product['urun_fiyatı'] }}" class="form-control" required>
                        </div>
                        <div class="col-12 col-md-4 mb-2">
                            <label class="form-label">Ürün Açıklaması</label>
                            <input type="text" name="urun_açıklaması" value="{{ $product['urun_açıklaması'] }}" class="form-control" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Güncelle</button>
                </form>
                <form method="POST" action="{{ url('/products/' . $product['id']) }}" class="d-inline">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger float-end">Sil</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>

</nav>
</body>
</html>
