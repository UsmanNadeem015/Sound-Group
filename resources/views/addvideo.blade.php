<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Video - SOUND GROUP</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.19/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/addvideo.css') }}">
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
                <h1 class="page-title display-font mb-4">ADD VIDEO</h1>
                <p class="text-xl text-gray-300">Upload a new video file to the library</p>
            </div>
        </section>

        <!-- Add Video Form -->
        <section class="py-8 pb-16">
            <div class="container mx-auto px-4">
                <div class="form-card">
                    <form id="addVideoForm">
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

                        <!-- Video File Upload -->
                        <div class="mb-6">
                            <label class="form-label">
                                Video File <span class="required">*</span>
                            </label>
                            <div class="file-upload" onclick="document.getElementById('videoFile').click()">
                                <input type="file" id="videoFile" name="videoFile" accept="video/*" required onchange="displayFileName(event)" />
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-3 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                                <p class="text-gray-400" id="fileNameDisplay">Click to upload video file</p>
                                <p class="text-sm text-gray-500 mt-2">MP4, AVI, MOV, MKV (Max 500MB)</p>
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-4">
                            <!-- Video Name -->
                            <div class="mb-4">
                                <label for="videoName" class="form-label">
                                    Video Name <span class="required">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="videoName" 
                                    name="videoName" 
                                    class="input form-input w-full" 
                                    placeholder="Enter video name"
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
                                    <option value="Dance">Dance</option>
                                    <option value="Concert">Concert</option>
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
                                    <option value="Urdu">Urdu</option>
                                </select>
                            </div>

                            <!-- Duration -->
                            <div class="mb-4">
                                <label for="duration" class="form-label">
                                    Duration <span class="required">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="duration" 
                                    name="duration" 
                                    class="input form-input w-full" 
                                    placeholder="e.g., 45:32"
                                    required
                                />
                            </div>
                        </div>


                        <!-- Buttons -->
                        <div class="flex gap-4">
                            <button type="submit" class="btn btn-gradient text-white flex-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                                </svg>
                                Add Video
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

        // Display video file name
        function displayFileName(event) {
            const file = event.target.files[0];
            if (file) {
                document.getElementById('fileNameDisplay').textContent = file.name;
            }
        }

        // Form submission
        document.getElementById('addVideoForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const formData = new FormData(this);
            
            // In production, send data to server
            console.log('Video data:', {
                thumbnail: formData.get('thumbnail').name,
                videoFile: formData.get('videoFile').name,
                videoName: formData.get('videoName'),
                artist: formData.get('artist'),
                album: formData.get('album'),
                year: formData.get('year'),
                genre: formData.get('genre'),
                language: formData.get('language'),
                duration: formData.get('duration'),
                description: formData.get('description'),
                markAsNew: formData.get('markAsNew') ? true : false
            });
            
            alert('Video added successfully! (This is a demo)');
            
            // Redirect to admin dashboard
            // window.location.href = '/admin/dashboard';
        });
    </script>
</body>
</html>