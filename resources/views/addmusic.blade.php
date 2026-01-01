<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Music - SOUND GROUP</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.19/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/addmusic.css') }}">

</head>
<body>
    <!-- Animated Background -->
    <div class="animated-bg"></div>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <!-- Navigation Component -->
        <x-navbar />

        <!-- Page Header -->
        <section class="page-header">
            <div class="container mx-auto px-4">
                <h1 class="page-title display-font mb-4">ADD MUSIC</h1>
                <p class="text-xl text-gray-300">Upload a new music file to the library</p>
            </div>
        </section>

        <!-- Add Music Form -->
        <section class="py-8 pb-16">
            <div class="container mx-auto px-4">
                <div class="form-card">
                    <form id="addMusicForm">
                        <!-- Thumbnail Upload -->
                        <div class="mb-6">
                            <label class="form-label">
                                Thumbnail Image <span class="required">*</span>
                            </label>
                            <div class="file-upload" onclick="document.getElementById('thumbnail').click()">
                                <input type="file" id="thumbnail" name="thumbnail" accept="image/*" required onchange="previewThumbnail(event)" />
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-3 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="text-gray-400">Click to upload thumbnail</p>
                                <p class="text-sm text-gray-500 mt-2">PNG, JPG, WEBP (Max 5MB)</p>
                            </div>
                            <img id="thumbnailPreview" class="preview-image" alt="Thumbnail Preview" />
                        </div>

                        <!-- Music File Upload -->
                        <div class="mb-6">
                            <label class="form-label">
                                Music File <span class="required">*</span>
                            </label>
                            <div class="file-upload" onclick="document.getElementById('musicFile').click()">
                                <input type="file" id="musicFile" name="musicFile" accept="audio/*" required onchange="displayFileName(event)" />
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-3 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                                </svg>
                                <p class="text-gray-400" id="fileNameDisplay">Click to upload music file</p>
                                <p class="text-sm text-gray-500 mt-2">MP3, WAV, OGG (Max 50MB)</p>
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-4">
                            <!-- Music Name -->
                            <div class="mb-4">
                                <label for="musicName" class="form-label">
                                    Music Name <span class="required">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="musicName" 
                                    name="musicName" 
                                    class="input form-input w-full" 
                                    placeholder="Enter music name"
                                    required
                                />
                            </div>

                            <!-- Artist -->
                            <div class="mb-4">
                                <label for="artist" class="form-label">
                                    Artist <span class="required">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="artist" 
                                    name="artist" 
                                    class="input form-input w-full" 
                                    placeholder="Enter artist name"
                                    required
                                />
                            </div>

                            <!-- Album -->
                            <div class="mb-4">
                                <label for="album" class="form-label">
                                    Album <span class="required">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="album" 
                                    name="album" 
                                    class="input form-input w-full" 
                                    placeholder="Enter album name"
                                    required
                                />
                            </div>

                            <!-- Year -->
                            <div class="mb-4">
                                <label for="year" class="form-label">
                                    Year <span class="required">*</span>
                                </label>
                                <select id="year" name="year" class="select form-input w-full" required>
                                    <option value="" disabled selected>Select Year</option>
                                    <option value="2026">2026</option>
                                    <option value="2025">2025</option>
                                    <option value="2024">2024</option>
                                    <option value="2023">2023</option>
                                    <option value="2022">2022</option>
                                    <option value="2021">2021</option>
                                    <option value="2020">2020</option>
                                    <option value="2019">2019</option>
                                    <option value="2018">2018</option>
                                    <option value="2017">2017</option>
                                    <option value="2016">2016</option>
                                    <option value="2015">2015</option>
                                    <option value="2014">2014</option>
                                    <option value="2013">2013</option>
                                    <option value="2012">2012</option>
                                    <option value="2011">2011</option>
                                    <option value="2010">2010</option>




                                </select>
                            </div>

                            <!-- Genre -->
                            <div class="mb-4">
                                <label for="genre" class="form-label">
                                    Genre <span class="required">*</span>
                                </label>
                                <select id="genre" name="genre" class="select form-input w-full" required>
                                    <option value="" disabled selected>Select Genre</option>
                                    <option value="Pop">Pop</option>
                                    <option value="Rock">Rock</option>
                                    <option value="Hip Hop">Hip Hop</option>
                                    <option value="Jazz">Jazz</option>
                                    <option value="Classical">Classical</option>
                                    <option value="Electronic">Electronic</option>
                                    <option value="Folk">Folk</option>
                                    <option value="Romantic">Romantic</option>
                                    <option value="Bhangra">Bhangra</option>
                                    <option value="Qawwali">Qawwali</option>
                                </select>
                            </div>

                            <!-- Language -->
                            <div class="mb-4">
                                <label for="language" class="form-label">
                                    Language <span class="required">*</span>
                                </label>
                                <select id="language" name="language" class="select form-input w-full" required>
                                    <option value="" disabled selected>Select Language</option>
                                    <option value="English">English</option>
                                    <option value="Hindi">Urdu</option>
                                </select>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-4">
                            <button type="submit" class="btn btn-gradient text-white flex-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                                </svg>
                                Add Music
                            </button>
                            <button type="button" class="btn btn-outline flex-1" onclick="window.history.back()">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <!-- Footer start  -->
        <x-footer />
        <!-- Footer end  -->
    </div>

    <script>
        // Preview thumbnail
        function previewThumbnail(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('thumbnailPreview');
                    preview.src = e.target.result;
                    preview.classList.add('show');
                };
                reader.readAsDataURL(file);
            }
        }

        // Display music file name
        function displayFileName(event) {
            const file = event.target.files[0];
            if (file) {
                document.getElementById('fileNameDisplay').textContent = file.name;
            }
        }

        // Form submission
        document.getElementById('addMusicForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const formData = new FormData(this);
            
            // In production, send data to server
            console.log('Music data:', {
                thumbnail: formData.get('thumbnail').name,
                musicFile: formData.get('musicFile').name,
                musicName: formData.get('musicName'),
                artist: formData.get('artist'),
                album: formData.get('album'),
                year: formData.get('year'),
                genre: formData.get('genre'),
                language: formData.get('language'),
                description: formData.get('description'),
                markAsNew: formData.get('markAsNew') ? true : false
            });
            
            alert('Music added successfully! (This is a demo)');
            
            // Redirect to admin dashboard
            // window.location.href = '/admin/dashboard';
        });
    </script>
</body>
</html>