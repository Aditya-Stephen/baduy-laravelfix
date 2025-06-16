<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Edit Profile - Baduy</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{ asset('images/logobadui1.webp') }}" type="image/png" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Cropperjs library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
    <!-- Alpine.js and Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
</head>

<body class="bg-gray-900 text-white" x-data="{ mobileMenuOpen: false }">
    <header
        x-data="{ scrolled: false, mobileMenuOpen: false }"
        x-init="window.addEventListener('scroll', () => { scrolled = window.pageYOffset > 20 })"
        :class="scrolled
    ? 'bg-gray-800 bg-opacity-90 backdrop-blur-md shadow-md'
    : 'bg-gray-800 bg-opacity-70 backdrop-blur-md'"
        class="sticky top-0 z-50 transition-colors duration-300 py-2">
        <nav class="container mx-auto px-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="{{ url('/') }}" class="flex items-center">
                        <img src="{{ asset('images/logobadui1.webp') }}" class="h-12 w-auto object-contain" alt="Baduy Logo">
                    </a>
                </div>

                <!-- Hamburger menu -->
                <div class="md:hidden">
                    <button
                        type="button"
                        class="text-white hover:text-gray-300 focus:outline-none"
                        @click="mobileMenuOpen = !mobileMenuOpen"
                        aria-label="Toggle menu">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>

                <!-- Nav links -->
                <div
                    :class="mobileMenuOpen
          ? 'absolute top-16 right-4 bg-blue-900 bg-opacity-95 p-4 shadow-lg rounded-lg z-50 w-48 flex flex-col space-y-2'
          : 'hidden md:flex items-center space-x-6'"
                    class="md:flex">
                    <a href="{{ url('/') }}" class="text-white hover:text-yellow-400 font-medium" :class="{'block py-2': mobileMenuOpen}">Home</a>
                    <a href="{{ url('/aboutUs') }}" class="text-white hover:text-yellow-400 font-medium" :class="{'block py-2': mobileMenuOpen}">About Us</a>
                    <a href="{{ url('/marketplace') }}" class="text-white hover:text-yellow-400 font-medium" :class="{'block py-2': mobileMenuOpen}">Product</a>
                    <a href="{{ url('/artikel') }}" class="text-white hover:text-yellow-400 font-medium" :class="{'block py-2': mobileMenuOpen}">Article</a>

                    @auth
                    <div class="relative" x-data="{ open: false }">
                        <button
                            @click="open = !open"
                            class="flex items-center text-white hover:text-yellow-400 font-medium w-full"
                            :class="mobileMenuOpen ? 'block py-2 text-left' : ''"
                            aria-haspopup="true"
                            :aria-expanded="open.toString()">
                            <!-- UBAH: Profile Image BLOB -->
                            @if(Auth::user()->profileImage())
                              <img src="{{ route('image.show', Auth::user()->profileImage()->id) }}" alt="Profile Photo" class="w-8 h-8 rounded-full mr-2 object-cover">
                            @else
                              <img src="{{ Auth::user()->defaultProfilePhotoUrl() }}" alt="Profile Photo" class="w-8 h-8 rounded-full mr-2 object-cover">
                            @endif
                            {{ Auth::user()->name }}
                            <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div
                            x-show="open"
                            @click.away="open = false"
                            x-transition
                            class="absolute right-0 mt-2 py-2 w-48 bg-gray-700 rounded-md shadow-lg z-10"
                            style="display: none;">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-white hover:bg-gray-600">
                                Edit Profile
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-white hover:bg-gray-600">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                    @else
                    <a href="{{ route('login') }}" class="text-white hover:text-yellow-400 font-medium" :class="{'block py-2': mobileMenuOpen}">Login</a>
                    @endauth
                </div>
            </div>
        </nav>
    </header>


    <main class="py-12">
        <div class="container mx-auto px-4">
            <!-- Back to home link -->
            <div class="mb-6 max-w-4xl mx-auto">
                <a href="{{ url('/') }}" class="inline-flex items-center text-gray-300 hover:text-yellow-400 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Back to Home
                </a>
            </div>

            <div class="max-w-4xl mx-auto" x-data="profileEditor()">
                <!-- Profile Edit Form -->
                <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden border border-gray-700">
                    <div class="bg-blue-900 p-4">
                        <h1 class="text-2xl font-bold text-yellow-400">Edit Your Profile</h1>
                    </div>

                    @if(session('success'))
                    <div class="bg-green-600/80 text-white p-4 m-4 rounded">
                        <p>{{ session('success') }}</p>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="p-6">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="cropped_photo" id="cropped_photo_data">

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <!-- Left: Profile Photo -->
                            <div class="md:col-span-1 flex flex-col items-center">
                                <!-- Current photo or placeholder -->
                                <div class="mb-4 w-40">
                                  <!-- UBAH: Current Profile Image BLOB -->
                                  @if(Auth::user()->profileImage())
                                    <img src="{{ route('image.show', Auth::user()->profileImage()->id) }}"
                                        class="w-full h-auto aspect-[3/4] rounded-lg border-2 border-yellow-400 object-cover">
                                  @else
                                    <div class="w-full aspect-[3/4] bg-gray-700 rounded-lg flex items-center justify-center text-gray-400 text-5xl font-bold">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </div>
                                  @endif
                                </div>

                                <!-- Upload button -->
                                <button type="button"
                                    @click="openFileInput"
                                    class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded transition">
                                    Choose New Photo
                                </button>
                                <input type="file" id="profile_photo" @change="fileChosen" class="hidden" accept="image/*">
                                <p class="text-sm text-gray-400 mt-2">Photo will be uploaded as BLOB and cropped to 3:4 ratio</p>

                                <!-- Preview of cropped image -->
                                <div x-show="croppedPreview" class="mt-4 w-32 aspect-[3/4]">
                                    <p class="text-sm text-gray-300 mb-2">Preview:</p>
                                    <img :src="croppedPreview" class="w-full h-auto rounded-lg border border-blue-500 object-cover">
                                </div>
                            </div>

                            <!-- Right: Form Fields -->
                            <div class="md:col-span-2">
                                <div class="mb-6">
                                    <label class="block text-gray-300 text-sm font-medium mb-2" for="name">
                                        Full Name
                                    </label>
                                    <input class="w-full bg-gray-700 border border-gray-600 rounded px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        id="name" name="name" type="text"
                                        value="{{ old('name', auth()->user()->name) }}" required>
                                </div>

                                <div class="mb-6">
                                    <label class="block text-gray-300 text-sm font-medium mb-2" for="email">
                                        Email Address
                                    </label>
                                    <input class="w-full bg-gray-700 border border-gray-600 rounded px-4 py-3 text-gray-300 focus:outline-none"
                                        id="email" type="email"
                                        value="{{ auth()->user()->email }}" disabled>
                                    <p class="text-xs text-gray-400 mt-2">Email cannot be changed</p>
                                </div>

                                <div class="flex justify-end">
                                    <button type="submit"
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded font-semibold transition">
                                        Update Profile
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Your Articles Section -->
                <div class="mt-10 bg-gray-800 rounded-lg shadow-lg overflow-hidden border border-gray-700">
                    <div class="bg-blue-900 p-4 flex justify-between items-center">
                        <h2 class="text-xl font-bold text-yellow-400">Your Articles</h2>
                        <a href="{{ url('/artikel/create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm transition flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            New Article
                        </a>
                    </div>

                    <div class="p-6">
                        @if($articles->isEmpty())
                        <div class="text-center py-10 bg-gray-700/30 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1M19 20a2 2 0 002-2V8m-2 12h-7a2 2 0 01-2-2v-4m11 0a1 1 0 001-1v-1a1 1 0 00-1-1h-1M8 12H6a1 1 0 01-1-1V9a1 1 0 011-1h2" />
                            </svg>
                            <p class="text-gray-400 text-lg">You haven't submitted any articles yet.</p>
                            <a href="{{ url('/artikel/create') }}" class="mt-4 inline-block text-blue-400 hover:text-blue-300">
                                Write your first article → 
                            </a>
                        </div>
                        @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-700">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                            Title
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                            Date
                                        </th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-300 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-700 bg-gray-800/50">
                                    @foreach($articles as $article)
                                    <tr class="hover:bg-gray-700/50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-200">{{ Str::limit($article->title, 40) }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($article->status === 'approved')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Approved
                                            </span>
                                            @elseif($article->status === 'pending')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Pending
                                            </span>
                                            @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Rejected
                                            </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                            {{ $article->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ url('/artikel/'.$article->id) }}" class="text-blue-400 hover:text-blue-300 mr-3">View</a>
                                            @if($article->status !== 'approved')
                                            <a href="{{ url('/artikel/'.$article->id.'/edit') }}" class="text-yellow-400 hover:text-yellow-300">Edit</a>
                                            @endif
                                        </td>
                                    </tr>
                                    @if($article->status === 'rejected' && $article->rejection_reason)
                                    <tr class="bg-gray-900/50">
                                        <td colspan="4" class="px-6 py-2 text-xs text-red-400 italic">
                                            <strong>Rejection reason:</strong> {{ $article->rejection_reason }}
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Image Cropping Modal -->
        <div id="cropperModal" class="fixed inset-0 bg-black bg-opacity-75 z-50 flex items-center justify-center hidden">
            <div class="bg-gray-800 p-6 rounded-lg max-w-2xl w-full mx-4">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-semibold text-yellow-400">Crop Your Profile Photo</h3>
                    <button id="closeCropModal" class="text-gray-400 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="mb-4">
                    <div class="bg-gray-900 rounded overflow-hidden">
                        <img id="cropperImage" class="max-w-full">
                    </div>
                    <p class="text-gray-300 text-xs mt-2">Drag or resize the crop area to fit a 3:4 ratio</p>
                </div>
                <div class="flex justify-end space-x-3">
                    <button id="cancelCrop" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded transition">
                        Cancel
                    </button>
                    <button id="applyCrop" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded transition">
                        Apply
                    </button>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('profileEditor', () => ({
                cropper: null,
                croppedPreview: null,

                openFileInput() {
                    document.getElementById('profile_photo').click();
                },

                fileChosen(event) {
                    const file = event.target.files[0];
                    if (!file) return;

                    console.log('File selected:', file.name, 'Size:', file.size);

                    // Show modal
                    const modal = document.getElementById('cropperModal');
                    modal.classList.remove('hidden');

                    // Setup cropper
                    const cropperImage = document.getElementById('cropperImage');
                    const reader = new FileReader();

                    reader.onload = (e) => {
                        cropperImage.src = e.target.result;
                        console.log('Image loaded for cropping');

                        // Initialize cropper when image is loaded
                        cropperImage.onload = () => {
                            if (this.cropper) {
                                this.cropper.destroy();
                            }

                            this.cropper = new Cropper(cropperImage, {
                                aspectRatio: 3 / 4,
                                viewMode: 1,
                                dragMode: 'move',
                                autoCropArea: 0.8,
                                restore: false,
                                guides: true,
                                center: true,
                                highlight: false,
                                cropBoxMovable: true,
                                cropBoxResizable: true,
                                toggleDragModeOnDblclick: false
                            });
                            
                            console.log('Cropper initialized');
                        };
                    };

                    reader.readAsDataURL(file);

                    // Setup modal buttons
                    document.getElementById('applyCrop').onclick = () => {
                        if (!this.cropper) {
                            console.error('No cropper instance found');
                            return;
                        }

                        console.log('Applying crop...');
                        
                        const canvas = this.cropper.getCroppedCanvas({
                            width: 300,
                            height: 400
                        });

                        if (!canvas) {
                            console.error('Failed to get cropped canvas');
                            return;
                        }

                        this.croppedPreview = canvas.toDataURL('image/jpeg', 0.8);
                        const hiddenInput = document.getElementById('cropped_photo_data');
                        hiddenInput.value = this.croppedPreview;
                        
                        console.log('Cropped image set:');
                        console.log('- Preview length:', this.croppedPreview.length);
                        console.log('- Hidden input set:', hiddenInput.value ? 'YES' : 'NO');
                        console.log('- First 100 chars:', this.croppedPreview.substring(0, 100));

                        modal.classList.add('hidden');
                        this.cropper.destroy();
                        this.cropper = null;
                    };

                    document.getElementById('cancelCrop').onclick = document.getElementById('closeCropModal').onclick = () => {
                        modal.classList.add('hidden');
                        if (this.cropper) {
                            this.cropper.destroy();
                            this.cropper = null;
                        }
                        document.getElementById('profile_photo').value = '';
                        console.log('Crop cancelled');
                    };
                },

                init() {
                    // Debug form submission
                    const form = document.querySelector('form');
                    if (form) {
                        form.addEventListener('submit', function(e) {
                            const croppedPhotoInput = document.getElementById('cropped_photo_data');
                            const nameInput = document.querySelector('input[name="name"]');
                            
                            console.log('=== FORM SUBMISSION ===');
                            console.log('Name:', nameInput.value);
                            console.log('Cropped photo length:', croppedPhotoInput.value.length);
                            console.log('Has cropped photo:', croppedPhotoInput.value ? 'YES' : 'NO');
                            
                            if (croppedPhotoInput.value.length > 0) {
                                console.log('Cropped photo preview:', croppedPhotoInput.value.substring(0, 100) + '...');
                            }
                        });
                    }
                }
            }));
        });
    </script>
</body>

</html>
