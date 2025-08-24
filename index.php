<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillzUp - Learn Real Skills, in Your Language.</title>

    <!-- CDNs: Tailwind, Font Awesome, Google Fonts, GSAP, Alpine.js -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js" defer></script>
    <script src="//unpkg.com/alpinejs" defer></script>

    <style>
        body { font-family: 'Inter', sans-serif; background-color: #020617; color: #cbd5e1; }
        .hero-gradient-text { background: -webkit-linear-gradient(45deg, #38bdf8, #a78bfa, #f472b6); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .course-card { transition: transform 0.3s, box-shadow 0.3s; }
        .course-card:hover { transform: translateY(-8px); box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3), 0 10px 10px -5px rgba(0, 0, 0, 0.2); }
    </style>
</head>
<body class="antialiased">

    <!-- =========== HEADER =========== -->
    <header class="sticky top-0 z-50 bg-slate-900/50 backdrop-blur-lg border-b border-slate-800">
        <div class="container mx-auto max-w-7xl px-6">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <div class="text-2xl font-black text-white">
                    <i class="fas fa-rocket text-sky-400"></i> SkillzUp
                </div>
                <!-- Navigation (Desktop) -->
                <nav class="hidden md:flex space-x-8 text-sm font-semibold">
                    <a href="#" class="hover:text-sky-400 transition-colors">Courses</a>
                    <a href="#" class="hover:text-sky-400 transition-colors">For Instructors</a>
                    <a href="#" class="hover:text-sky-400 transition-colors">Help</a>
                </nav>
                <!-- CTA Buttons -->
                <div class="flex items-center space-x-4">
                    <a href="#" class="hidden md:block text-sm font-semibold hover:text-sky-400 transition-colors">Log In</a>
                    <a href="#" class="bg-sky-500 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-sky-600 transition-colors">Sign Up</a>
                </div>
            </div>
        </div>
    </header>

    <!-- =========== MAIN CONTENT =========== -->
    <main>
        <!-- =========== HERO SECTION =========== -->
        <section class="py-20 md:py-32">
            <div class="container mx-auto max-w-7xl px-6 text-center">
                <div class="gsap-reveal-group">
                    <h1 class="text-5xl md:text-7xl font-black tracking-tight leading-tight">
                        Learn Real Skills, <br> <span class="hero-gradient-text">in Your Language.</span>
                    </h1>
                    <p class="mt-6 max-w-2xl mx-auto text-lg text-slate-400">
                        Stop wasting time on confusing tutorials. Get access to premium, step-by-step video courses from India's top creators, designed for your success.
                    </p>
                    <div class="mt-8 flex justify-center gap-4">
                        <a href="#courses" class="bg-sky-500 text-white px-6 py-3 rounded-lg font-bold hover:bg-sky-600 transition-colors">
                            Explore Courses
                        </a>
                        <a href="#" class="bg-slate-700 text-white px-6 py-3 rounded-lg font-bold hover:bg-slate-600 transition-colors">
                            Become an Instructor
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- =========== FEATURED COURSES SECTION =========== -->
        <section id="courses" class="py-20 bg-slate-900">
            <div class="container mx-auto max-w-7xl px-6">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-extrabold">Featured Courses</h2>
                    <p class="mt-3 text-slate-400">Hand-picked courses to kickstart your new career.</p>
                </div>
                
                <!-- Course Grid -->
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    
                    <!-- Course Card 1 -->
                    <div class="course-card gsap-reveal-card bg-slate-800 rounded-2xl overflow-hidden border border-slate-700">
                        <a href="#">
                            <!-- BADLEIN: Yahan course ka image link daalein -->
                            <img src="https://images.pexels.com/photos/1181244/pexels-photo-1181244.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Course Thumbnail" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <h3 class="text-xl font-bold mb-2">The Ultimate Video Editing Course</h3>
                                <p class="text-sm text-slate-400 mb-4">By Aarushi Sharma</p>
                                <div class="flex justify-between items-center">
                                    <div class="text-lg font-extrabold text-sky-400">₹499</div>
                                    <div class="flex items-center text-sm">
                                        <i class="fas fa-star text-yellow-400 mr-1"></i> 4.9 (251)
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Course Card 2 -->
                    <div class="course-card gsap-reveal-card bg-slate-800 rounded-2xl overflow-hidden border border-slate-700">
                        <a href="#">
                             <!-- BADLEIN: Yahan course ka image link daalein -->
                            <img src="https://images.pexels.com/photos/326503/pexels-photo-326503.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Course Thumbnail" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <h3 class="text-xl font-bold mb-2">Modern Graphic Design for Beginners</h3>
                                <p class="text-sm text-slate-400 mb-4">By Rohan Singh</p>
                                <div class="flex justify-between items-center">
                                    <div class="text-lg font-extrabold text-sky-400">₹599</div>
                                    <div class="flex items-center text-sm">
                                        <i class="fas fa-star text-yellow-400 mr-1"></i> 4.8 (198)
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Course Card 3 -->
                    <div class="course-card gsap-reveal-card bg-slate-800 rounded-2xl overflow-hidden border border-slate-700">
                        <a href="#">
                             <!-- BADLEIN: Yahan course ka image link daalein -->
                            <img src="https://images.pexels.com/photos/546819/pexels-photo-546819.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Course Thumbnail" class="w-full h-48 object-cover">
                             <div class="p-6">
                                <h3 class="text-xl font-bold mb-2">The Complete Web Development Bootcamp</h3>
                                <p class="text-sm text-slate-400 mb-4">By Priya Kumar</p>
                                <div class="flex justify-between items-center">
                                    <div class="text-lg font-extrabold text-sky-400">₹799</div>
                                    <div class="flex items-center text-sm">
                                        <i class="fas fa-star text-yellow-400 mr-1"></i> 4.9 (420)
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    
                </div>
            </div>
        </section>
        
        <!-- Add more sections here later -->

    </main>

    <!-- =========== FOOTER =========== -->
    <footer class="bg-slate-900 border-t border-slate-800">
        <div class="container mx-auto max-w-7xl px-6 py-8 text-center text-slate-400 text-sm">
            <p>&copy; <?php echo date('Y'); ?> SkillzUp. All Rights Reserved.</p>
            <div class="mt-4 space-x-6">
                <a href="#" class="hover:text-white">Terms of Service</a>
                <a href="#" class="hover:text-white">Privacy Policy</a>
            </div>
        </div>
    </footer>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            gsap.registerPlugin(ScrollTrigger);

            // Hero Section Animation
            gsap.from(".gsap-reveal-group > *", {
                opacity: 0,
                y: 30,
                duration: 0.8,
                stagger: 0.2,
                ease: 'power2.out'
            });

            // Course Card Reveal Animation
            gsap.from(".gsap-reveal-card", {
                scrollTrigger: {
                    trigger: ".gsap-reveal-card",
                    start: "top 90%",
                },
                opacity: 0,
                y: 50,
                duration: 0.8,
                stagger: 0.2,
                ease: 'power2.out'
            });
        });
    </script>
</body>
</html>
