<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - SOUND GROUP</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.19/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
</head>
<body>
<!-- Animated Background start -->
    <div class="animated-bg"></div>
<!-- Animated Background end -->

<!-- Content Wrapper -->
    <div class="content-wrapper">

<!-- NavBar start -->
        <x-navbar />
<!-- NavBar end -->

<!-- Page Header start -->
        <section class="page-header">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-4xl mx-auto">
                    <h1 class="page-title display-font mb-6">ABOUT SOUND GROUP</h1>
                    <p class="text-2xl text-gray-300 font-light">Your ultimate destination for music and video entertainment</p>
                </div>
            </div>
        </section>
<!-- Page Header end -->

<!-- Main Content start -->
        <section class="py-8">
            <div class="container mx-auto px-4">
                <!-- Introduction -->
                <div class="content-card max-w-5xl mx-auto">
                    <h2 class="section-title display-font">WHO WE ARE</h2>
                    <p class="text-lg text-gray-300 leading-relaxed mb-4">
                        Welcome to SOUND GROUP, your premier destination for discovering and enjoying music and videos from around the world. We are passionate about bringing you an extensive collection of entertainment that spans across genres, languages, and cultures.
                    </p>
                    <p class="text-lg text-gray-300 leading-relaxed mb-4">
                        Founded with a vision to create a comprehensive entertainment platform, SOUND GROUP hosts thousands of songs and videos in both regional and English languages. Our mission is to make quality entertainment accessible to everyone, everywhere.
                    </p>
                    <p class="text-lg text-gray-300 leading-relaxed">
                        Whether you're looking for the latest chart-toppers, timeless classics, or hidden gems from independent artists, SOUND GROUP has something for every music and video enthusiast.
                    </p>
                </div>

                <!-- Stats Section -->
                <div class="max-w-6xl mx-auto my-16">
                    <h2 class="section-title display-font text-center mb-12">OUR IMPACT</h2>
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="stat-card">
                            <div class="stat-number display-font">5000+</div>
                            <div class="text-gray-400 mt-2">Music Tracks</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number display-font">3000+</div>
                            <div class="text-gray-400 mt-2">Video Content</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number display-font">50+</div>
                            <div class="text-gray-400 mt-2">Artists</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number display-font">20+</div>
                            <div class="text-gray-400 mt-2">Languages</div>
                        </div>
                    </div>
                </div>

                <!-- What We Offer -->
                <div class="content-card max-w-5xl mx-auto">
                    <h2 class="section-title display-font">WHAT WE OFFER</h2>
                    <div class="grid md:grid-cols-2 gap-6 mt-8">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.37 4.37 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold mb-2">Vast Music Library</h3>
                            <p class="text-gray-400">Access thousands of songs across all genres, from pop and rock to classical and folk music.</p>
                        </div>

                        <div class="feature-card">
                            <div class="feature-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold mb-2">Extensive Video Collection</h3>
                            <p class="text-gray-400">Watch music videos, concerts, live performances, and exclusive content from top artists.</p>
                        </div>

                        <div class="feature-card">
                            <div class="feature-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold mb-2">Multi-Language Support</h3>
                            <p class="text-gray-400">Enjoy content in 20+ languages including English, Hindi, Tamil, Telugu, Punjabi, and more.</p>
                        </div>

                        <div class="feature-card">
                            <div class="feature-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold mb-2">Ratings & Reviews</h3>
                            <p class="text-gray-400">Rate your favorite songs and videos, write reviews, and discover what others are enjoying.</p>
                        </div>

                        <div class="feature-card">
                            <div class="feature-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold mb-2">Personalized Experience</h3>
                            <p class="text-gray-400">Create your account, build playlists, and get personalized recommendations.</p>
                        </div>

                        <div class="feature-card">
                            <div class="feature-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold mb-2">Regular Updates</h3>
                            <p class="text-gray-400">New music and videos added regularly to keep your entertainment fresh and exciting.</p>
                        </div>
                    </div>
                </div>

                <!-- Our Mission -->
                <div class="content-card max-w-5xl mx-auto mt-8">
                    <h2 class="section-title display-font">OUR MISSION</h2>
                    <p class="text-lg text-gray-300 leading-relaxed mb-4">
                        At SOUND GROUP, our mission is to create a comprehensive entertainment platform that celebrates diversity in music and video content. We believe that great entertainment should be accessible to everyone, regardless of language or location.
                    </p>
                    <p class="text-lg text-gray-300 leading-relaxed mb-4">
                        We are committed to:
                    </p>
                    <ul class="space-y-3 text-lg text-gray-300 ml-6">
                        <li class="flex items-start">
                            <span class="text-purple-400 mr-3">•</span>
                            <span>Providing a seamless and user-friendly platform for discovering music and videos</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-purple-400 mr-3">•</span>
                            <span>Supporting artists from all backgrounds and genres</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-purple-400 mr-3">•</span>
                            <span>Maintaining high-quality content standards</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-purple-400 mr-3">•</span>
                            <span>Building a community of music and video enthusiasts</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-purple-400 mr-3">•</span>
                            <span>Continuously improving our platform based on user feedback</span>
                        </li>
                    </ul>
                </div>

                <!-- Why Choose Us -->
                <div class="content-card max-w-5xl mx-auto mt-8">
                    <h2 class="section-title display-font">WHY CHOOSE US</h2>
                    <div class="grid md:grid-cols-3 gap-6 mt-8">
                        <div class="text-center">
                            <div class="text-5xl mb-4">🎵</div>
                            <h3 class="text-xl font-bold mb-2">Quality Content</h3>
                            <p class="text-gray-400">Carefully curated collection of high-quality music and videos</p>
                        </div>
                        <div class="text-center">
                            <div class="text-5xl mb-4">🌍</div>
                            <h3 class="text-xl font-bold mb-2">Global Reach</h3>
                            <p class="text-gray-400">Content from artists and creators around the world</p>
                        </div>
                        <div class="text-center">
                            <div class="text-5xl mb-4">💡</div>
                            <h3 class="text-xl font-bold mb-2">Easy Discovery</h3>
                            <p class="text-gray-400">Intuitive browsing by album, artist, year, genre, and language</p>
                        </div>
                    </div>
                </div>

                <!-- Join Us Section -->
                <div class="content-card max-w-5xl mx-auto mt-8 text-center bg-gradient-to-r from-purple-900/20 to-pink-900/20">
                    <h2 class="section-title display-font">JOIN OUR COMMUNITY</h2>
                    <p class="text-lg text-gray-300 leading-relaxed mb-6">
                        Become part of the SOUND GROUP family today! Create your account to start exploring, rating, and reviewing your favorite music and videos.
                    </p>
                    <div class="flex gap-4 justify-center flex-wrap">
                        <button class="btn btn-gradient btn-lg text-white">Create Account</button>
                        <button class="btn btn-outline btn-lg">Learn More</button>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="content-card max-w-5xl mx-auto mt-8">
                    <h2 class="section-title display-font">GET IN TOUCH</h2>
                    <p class="text-lg text-gray-300 leading-relaxed mb-6">
                        Have questions or suggestions? We'd love to hear from you! Our team is always ready to assist you.
                    </p>
                    <div class="grid md:grid-cols-3 gap-6">
                        <div class="text-center">
                            <div class="text-3xl mb-3">📧</div>
                            <h3 class="font-bold mb-2">Email</h3>
                            <p class="text-gray-400">info@soundgroup.com</p>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl mb-3">📱</div>
                            <h3 class="font-bold mb-2">Phone</h3>
                            <p class="text-gray-400">+1 (555) 123-4567</p>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl mb-3">🌐</div>
                            <h3 class="font-bold mb-2">Social Media</h3>
                            <p class="text-gray-400">@soundgroup</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Bottom Spacing -->
        <div class="pb-16"></div>
    </div>
<!-- Main Content end -->

<!-- Footer start  -->
<x-footer />
<!-- Footer end  -->

    <script>
        // Smooth animations on scroll
        window.addEventListener('scroll', function() {
            const cards = document.querySelectorAll('.content-card, .stat-card, .feature-card');
            cards.forEach(card => {
                const cardTop = card.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;
                if (cardTop < windowHeight - 100) {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }
            });
        });
    </script>
</body>
</html>