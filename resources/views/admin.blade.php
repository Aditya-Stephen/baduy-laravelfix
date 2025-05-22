<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Baduy</title>
    <link rel="shortcut icon" href="{{ asset('images/logobadui1.webp') }}" type="image/png" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-100">
    <!-- Header/Navbar -->
    <header class="bg-gray-800 text-white shadow">
        <div class="container mx-auto flex justify-between items-center p-4">
            <div class="flex items-center space-x-4">
                <img src="{{ asset('images/logobadui1.webp') }}" class="h-10 w-auto" alt="Baduy Logo">
                <h1 class="text-xl font-bold">Admin Dashboard</h1>
            </div>
            <div class="flex items-center space-x-4">
                <span>Selamat Datang, {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-600 hover:bg-red-700 px-3 py-1 rounded text-sm">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8" x-data="{ activeTab: 'products' }">
        <div class="flex flex-col md:flex-row gap-6">
            <!-- Sidebar -->
            <div class="w-full md:w-1/4 bg-white rounded-lg shadow p-4">
                <h2 class="text-lg font-semibold mb-4 text-gray-800">Menu Admin</h2>
                <nav>
                    <ul class="space-y-2">
                        <li>
                            <a href="#"
                                class="block py-2 px-4 rounded"
                                :class="{ 'bg-gray-800 text-white': activeTab === 'products', 'hover:bg-gray-200 text-gray-800': activeTab !== 'products' }"
                                @click.prevent="activeTab = 'products'">
                                Kelola Produk
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="block py-2 px-4 rounded"
                                :class="{ 'bg-gray-800 text-white': activeTab === 'carousel', 'hover:bg-gray-200 text-gray-800': activeTab !== 'carousel' }"
                                @click.prevent="activeTab = 'carousel'">
                                Kelola Carousel
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/') }}" class="block py-2 px-4 rounded hover:bg-gray-200 text-gray-800">
                                Lihat Website
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Main Panel -->
            <div class="w-full md:w-3/4" x-data="{ showAddProductModal: false, showEditProductModal: false, showAddCarouselModal: false, showEditCarouselModal: false, editProductId: null, editCarouselId: null }">

                <!-- Products Tab -->
                <div x-show="activeTab === 'products'">
                    <div class="bg-white rounded-lg shadow p-6 mb-6">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-xl font-bold text-gray-800">Kelola Produk</h2>
                            <button type="button"
                                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded"
                                @click="showAddProductModal = true">
                                Tambah Produk
                            </button>
                        </div>

                        <!-- Success Message -->
                        @if(session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                            <p>{{ session('success') }}</p>
                        </div>
                        @endif

                        <!-- Products Table -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-2 border">ID</th>
                                        <th class="px-4 py-2 border">Gambar</th>
                                        <th class="px-4 py-2 border">Nama Produk</th>
                                        <th class="px-4 py-2 border">Deskripsi</th>
                                        <th class="px-4 py-2 border">Harga</th>
                                        <th class="px-4 py-2 border">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($products ?? [] as $product)
                                    <tr>
                                        <td class="px-4 py-2 border text-center">{{ $product->id }}</td>
                                        <td class="px-4 py-2 border">
                                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="h-16 w-16 object-cover mx-auto">
                                        </td>
                                        <td class="px-4 py-2 border">{{ $product->name }}</td>
                                        <td class="px-4 py-2 border">{{ Str::limit($product->description, 50) }}</td>
                                        <td class="px-4 py-2 border">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                        <td class="px-4 py-2 border">
                                            <div class="flex space-x-2 justify-center">
                                                <button class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded text-sm edit-product-btn"
                                                    @click="showEditProductModal = true; editProductId = {{ $product->id }}; 
                                                        document.getElementById('editProductForm').action = '{{ url('products') }}/{{ $product->id }}';
                                                        document.getElementById('edit_name').value = '{{ $product->name }}';
                                                        document.getElementById('edit_description').value = '{{ $product->description }}';
                                                        document.getElementById('edit_price').value = '{{ $product->price }}';">
                                                    Edit
                                                </button>
                                                <form method="POST" action="{{ route('products.destroy', $product->id) }}"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-sm">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="px-4 py-2 text-center border">Belum ada produk</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Carousel Tab -->
                <div x-show="activeTab === 'carousel'">
                    <div class="bg-white rounded-lg shadow p-6 mb-6">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-xl font-bold text-gray-800">Kelola Carousel Homepage</h2>
                            <button type="button"
                                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded"
                                @click="showAddCarouselModal = true">
                                Tambah Slide
                            </button>
                        </div>

                        <!-- Carousel Images Table -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-2 border">ID</th>
                                        <th class="px-4 py-2 border">Gambar</th>
                                        <th class="px-4 py-2 border">Judul</th>
                                        <th class="px-4 py-2 border">Deskripsi</th>
                                        <th class="px-4 py-2 border">Urutan</th>
                                        <th class="px-4 py-2 border">Aksi</th>
                                    </tr>
                                </thead>
                                <!-- Carousel Items Table Body -->
                                <tbody>
                                    @forelse($carousels ?? [] as $carousel)
                                    <tr>
                                        <td class="px-4 py-2 border text-center">{{ $carousel->id }}</td>
                                        <td class="px-4 py-2 border">
                                            <img src="{{ asset($carousel->image) }}" alt="{{ $carousel->title }}" class="h-16 w-28 object-cover mx-auto">
                                        </td>
                                        <td class="px-4 py-2 border">{{ $carousel->title }}</td>
                                        <td class="px-4 py-2 border">{{ Str::limit($carousel->description, 50) }}</td>
                                        <td class="px-4 py-2 border text-center">{{ $carousel->order }}</td>
                                        <td class="px-4 py-2 border">
                                            <div class="flex space-x-2 justify-center">
                                                <button class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded text-sm"
                                                    @click="showEditCarouselModal = true; editCarouselId = {{ $carousel->id }};
                                                        document.getElementById('editCarouselForm').action = '{{ url('carousels') }}/{{ $carousel->id }}';
                                                        document.getElementById('edit_carousel_title').value = '{{ $carousel->title }}';
                                                        document.getElementById('edit_carousel_description').value = '{{ $carousel->description }}';
                                                        document.getElementById('edit_order').value = '{{ $carousel->order }}';">
                                                    Edit
                                                </button>
                                                <form method="POST" action="{{ route('carousels.destroy', $carousel->id) }}"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus slide ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-sm">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="px-4 py-2 text-center border">Belum ada item carousel</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Add Product Modal -->
                <div x-show="showAddProductModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
                    <div class="bg-white rounded-lg p-8 max-w-md w-full max-h-screen overflow-y-auto">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-bold text-gray-800">Tambah Produk Baru</h3>
                            <button type="button" class="text-gray-600 hover:text-gray-800"
                                @click="showAddProductModal = false">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama Produk:</label>
                                <input type="text" id="name" name="name" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>

                            <div class="mb-4">
                                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi:</label>
                                <textarea id="description" name="description" rows="3" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                            </div>

                            <div class="mb-4">
                                <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Harga (Rp):</label>
                                <input type="number" id="price" name="price" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>

                            <div class="mb-4">
                                <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Gambar Produk:</label>
                                <input type="file" id="image" name="image" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" accept="image/*" required>
                            </div>

                            <div class="flex justify-end space-x-4">
                                <button type="button" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded"
                                    @click="showAddProductModal = false">
                                    Batal
                                </button>
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Edit Product Modal -->
                <div x-show="showEditProductModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
                    <div class="bg-white rounded-lg p-8 max-w-md w-full max-h-screen overflow-y-auto">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-bold text-gray-800">Edit Produk</h3>
                            <button type="button" class="text-gray-600 hover:text-gray-800"
                                @click="showEditProductModal = false">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        <form action="{{ url('products/1') }}" id="editProductForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label for="edit_name" class="block text-gray-700 text-sm font-bold mb-2">Nama Produk:</label>
                                <input type="text" id="edit_name" name="name" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>

                            <div class="mb-4">
                                <label for="edit_description" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi:</label>
                                <textarea id="edit_description" name="description" rows="3" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                            </div>

                            <div class="mb-4">
                                <label for="edit_price" class="block text-gray-700 text-sm font-bold mb-2">Harga (Rp):</label>
                                <input type="number" id="edit_price" name="price" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Gambar Saat Ini:</label>
                                <img id="current_product_image" src="" alt="Current Image" class="h-32 w-32 object-cover rounded mb-2">
                                <label for="edit_image" class="block text-gray-700 text-sm font-bold mb-2">Ganti Gambar (opsional):</label>
                                <input type="file" id="edit_image" name="image" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" accept="image/*">
                            </div>

                            <div class="flex justify-end space-x-4">
                                <button type="button" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded"
                                    @click="showEditProductModal = false">
                                    Batal
                                </button>
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                                    Perbarui
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Add Carousel Modal -->
                <div x-show="showAddCarouselModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
                    <div class="bg-white rounded-lg p-8 max-w-md w-full max-h-screen overflow-y-auto">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-bold text-gray-800">Tambah Slide Carousel</h3>
                            <button type="button" class="text-gray-600 hover:text-gray-800"
                                @click="showAddCarouselModal = false">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        <form action="{{ route('carousels.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Judul Slide:</label>
                                <input type="text" id="title" name="title" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>

                            <div class="mb-4">
                                <label for="carousel_description" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi:</label>
                                <textarea id="carousel_description" name="description" rows="3" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                            </div>

                            <div class="mb-4">
                                <label for="order" class="block text-gray-700 text-sm font-bold mb-2">Urutan:</label>
                                <input type="number" id="order" name="order" min="1" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>

                            <div class="mb-4">
                                <label for="carousel_image" class="block text-gray-700 text-sm font-bold mb-2">Gambar Slide:</label>
                                <input type="file" id="carousel_image" name="image" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" accept="image/*" required>
                            </div>

                            <div class="flex justify-end space-x-4">
                                <button type="button" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded"
                                    @click="showAddCarouselModal = false">
                                    Batal
                                </button>
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Edit Carousel Modal -->
                <div x-show="showEditCarouselModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
                    <div class="bg-white rounded-lg p-8 max-w-md w-full max-h-screen overflow-y-auto">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-bold text-gray-800">Edit Slide Carousel</h3>
                            <button type="button" class="text-gray-600 hover:text-gray-800"
                                @click="showEditCarouselModal = false">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        <form action="{{ url('carousels/1') }}" id="editCarouselForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label for="edit_carousel_title" class="block text-gray-700 text-sm font-bold mb-2">Judul Slide:</label>
                                <input type="text" id="edit_carousel_title" name="title" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>

                            <div class="mb-4">
                                <label for="edit_carousel_description" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi:</label>
                                <textarea id="edit_carousel_description" name="description" rows="3" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                            </div>

                            <div class="mb-4">
                                <label for="edit_order" class="block text-gray-700 text-sm font-bold mb-2">Urutan:</label>
                                <input type="number" id="edit_order" name="order" min="1" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Gambar Saat Ini:</label>
                                <img id="current_carousel_image" src="{{ asset('images/suasana1.jpg') }}" alt="Current Image" class="h-32 w-60 object-cover rounded mb-2">
                                <label for="edit_carousel_image" class="block text-gray-700 text-sm font-bold mb-2">Ganti Gambar (opsional):</label>
                                <input type="file" id="edit_carousel_image" name="image" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" accept="image/*">
                            </div>

                            <div class="flex justify-end space-x-4">
                                <button type="button" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded"
                                    @click="showEditCarouselModal = false">
                                    Batal
                                </button>
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                                    Perbarui
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @vite(['resources/js/app.js'])
</body>
</html>