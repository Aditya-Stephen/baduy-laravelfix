<body>
    <div class="container article-form">
        <h2>Buat Artikel Baru</h2>
        
        <form action="{{ route('artikel.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Input Judul -->
            <div class="form-group">
                <label for="title">Judul Artikel</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <!-- Input genre -->
            <div class="form-group">
                <label for="genre">Kategori Artikel</label>
                <select class="form-control" id="genre" name="genre" required>
                    <option value="">Pilih Kategori</option>
                    <option value="Budaya & Tradisi">Budaya & Tradisi</option>
                    <option value="Kearifan Lokal">Kearifan Lokal</option>
                    <option value="Mitos & Kepercayaan">Mitos & Kepercayaan</option>
                    <option value="Lokasi">Lokasi</option>
                </select>
            </div>

            <!-- Input Gambar Header -->
            <div class="form-group">
                <label for="header_image">URL Gambar Header</label>
                <input type="url" class="form-control" id="header_image" name="header_image" required>
            </div>

            <!-- Input Konten -->
            <div class="form-group">
                <label for="content">Isi Artikel</label>
                <textarea class="form-control12" id="content" name="content" rows="10" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Publikasikan</button>
        </form>
    </div>
</body>
<style>
    body {
    background-image: linear-gradient(to bottom, #305792, #313a4d);
    background-attachment: fixed;
    background-size: cover;
    min-height: 100vh;
    margin: 0;
    padding: 0;
    }

    /* Style untuk container form */
    .container.article-form {
        max-width: 800px;
        margin: 40px auto;
        padding: 20px;
        background-color: #f8f8c8;
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    /* Style untuk judul form */
    .container.article-form h2 {
        text-align: center;
        margin-bottom: 20px;
        font-weight: bold;
        font-size: 24px;
        color: #333;
    }

    /* Style untuk form-group */
    .form-group {
        margin-bottom: 20px;
    }

    /* Style untuk label */
    .form-group label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
        font-size: 16px;
        color: #666;
    }

    /* Style untuk input dan textarea */
    .form-control {
        width: 100%;
        height: 40px;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    .form-control12 {
        width: 100%;
        height: 400px;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    /* Style untuk textarea */
    .form-control textarea {
        height: 150px;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    .form-control select {
    height: 40px;
    padding: 5px 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    width: 100%;
    }

    .form-control select:focus {
        border-color: #4CAF50;
        outline: none;
        box-shadow: 0 0 5px rgba(76,175,80,0.3);
    }

    /* Style untuk tombol submit */
    .btn.btn-primary {
        width: 100%;
        height: 40px;
        padding: 10px;
        font-size: 16px;
        background-color: #4CAF50;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    /* Style untuk tombol submit saat di hover */
    .btn.btn-primary:hover {
        background-color: #3e8e41;
    }

    /* Style untuk error message */
    .error-message {
        color: #f00;
        font-size: 14px;
        margin-bottom: 10px;
    }

    /* Style untuk placeholder */
    .form-control::placeholder {
        color: #ccc;
        font-size: 16px;
    }

    /* Style untuk focus */
    .form-control:focus {
        border-color: #4CAF50;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
</style>
