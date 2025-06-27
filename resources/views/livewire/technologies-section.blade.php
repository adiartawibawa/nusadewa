<style>
    /* Animation Styles */
    @keyframes reveal {
        from {
            clip-path: inset(0 100% 0 0);
        }

        to {
            clip-path: inset(0 0 0 0);
        }
    }

    @keyframes textReveal {
        from {
            transform: translateY(20px);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    @keyframes float {

        0%,
        100% {
            transform: translate(0, 0) rotate(0deg);
        }

        33% {
            transform: translate(30px, -50px) rotate(5deg);
        }

        66% {
            transform: translate(-20px, 40px) rotate(-5deg);
        }
    }

    @keyframes shine {
        from {
            transform: translateX(-100%) rotate(45deg);
        }

        to {
            transform: translateX(200%) rotate(45deg);
        }
    }

    @keyframes gradientMove {
        0% {
            background-position: 0% 0%;
        }

        50% {
            background-position: 100% 100%;
        }

        100% {
            background-position: 0% 0%;
        }
    }

    /* Tech Slider Container */
    .tech-slider-container {
        position: relative;
        height: 100vh;
        overflow: hidden;
        /* background-color: #0a0a0a; */
        isolation: isolate;
    }

    /* Background Ornaments */
    .bg-ornament {
        position: absolute;
        pointer-events: none;
        z-index: 0;
    }

    .bg-grid {
        width: 100%;
        height: 100%;
        background-image:
            linear-gradient(to right, rgba(255, 255, 255, 0.02) 1px, transparent 1px),
            linear-gradient(to bottom, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
        background-size: 40px 40px;
        opacity: 0.5;
    }

    .bg-circles {
        width: 100%;
        height: 100%;
        background-image:
            radial-gradient(circle at 20% 30%, rgba(100, 217, 255, 0.05) 0%, transparent 15%),
            radial-gradient(circle at 80% 70%, rgba(255, 100, 217, 0.05) 0%, transparent 15%),
            radial-gradient(circle at 50% 20%, rgba(217, 100, 255, 0.05) 0%, transparent 15%);
        background-size: 200% 200%;
        animation: gradientMove 20s ease infinite;
    }

    /* Blob Ornaments */
    .blob {
        position: absolute;
        filter: blur(40px);
        opacity: 0.15;
        border-radius: 50%;
        animation: float 15s infinite ease-in-out;
    }

    .blob-1 {
        width: 400px;
        height: 400px;
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        top: 20%;
        left: 10%;
    }

    .blob-2 {
        width: 300px;
        height: 300px;
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        bottom: 15%;
        right: 10%;
        animation-delay: 5s;
    }

    .blob-3 {
        width: 350px;
        height: 350px;
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        top: 60%;
        left: 70%;
        animation-delay: 8s;
    }

    /* Slider Components */
    .tech-slider {
        height: 100%;
        overflow-y: scroll;
        scroll-snap-type: y mandatory;
        scroll-behavior: smooth;
        -webkit-overflow-scrolling: touch;
    }

    .tech-slider::-webkit-scrollbar {
        display: none;
    }

    .scroll-section {
        scroll-snap-align: start;
        position: relative;
        z-index: 1;
        min-height: 100vh;
        display: flex;
        align-items: center;
    }

    .tech-dots-container {
        position: fixed;
        right: 1.5rem;
        top: 50%;
        transform: translateY(-50%);
        z-index: 50;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .dot-button-tech {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        transition: all 0.3s ease;
        background-color: rgba(255, 255, 255, 0.2);
    }

    .dot-button-tech:hover {
        background-color: rgba(255, 255, 255, 0.5);
        transform: scale(1.25);
    }

    .dot-button-tech.active {
        background-color: white;
        transform: scale(1.5);
    }

    .tech-slide-content {
        opacity: 0;
        animation: textReveal 0.8s ease-out forwards;
        animation-delay: 0.3s;
    }

    /* Responsive Styles */
    @media (max-width: 767px) {
        .tech-slider-container {
            height: auto;
            min-height: 100vh;
        }

        .scroll-section {
            padding: 2rem 0;
        }

        .tech-slide-content {
            padding-top: 1.5rem;
            padding-bottom: 3rem;
            animation-delay: 0.1s;
        }

        .tech-dots-container {
            right: 0.75rem;
            gap: 0.5rem;
        }

        .blob {
            filter: blur(30px);
        }
    }
</style>

<!-- Slider Container -->
<div class="tech-slider-container" id="tech-main-container">
    <!-- Background Ornaments -->
    <div class="bg-ornament bg-grid"></div>
    <div class="bg-ornament bg-circles"></div>

    <!-- Blob Ornaments -->
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>

    @if ($posts && count($posts) > 0)
        <!-- Main scroll container -->
        <div class="tech-slider" id="tech-scroll-container">
            @foreach ($posts as $index => $post)
                <!-- Each slide section -->
                <section class="relative w-full scroll-section">
                    <div class="container h-full px-4 mx-auto sm:px-6 lg:px-8">
                        <div class="flex flex-col items-center h-full gap-6 py-8 md:flex-row lg:gap-12 md:py-12">
                            <!-- Image Column -->
                            <div class="flex items-center justify-center w-full md:w-1/2 tech-image-container">
                                <div
                                    class="p-1 bg-white/10 rounded-lg shadow-2xl w-full max-h-[500px] overflow-hidden backdrop-blur-sm">
                                    <img src="{{ $post['image'] }}" alt="{{ $post['title'] }}"
                                        class="object-cover w-full h-full rounded-lg"
                                        loading="{{ $index === 0 ? 'eager' : 'lazy' }}">
                                </div>
                            </div>

                            <!-- Content Column -->
                            <div class="w-full md:w-1/2 tech-slide-content">
                                <div class="max-w-2xl px-4 mx-auto sm:px-6 lg:px-0">
                                    <h2 class="mb-4 text-3xl font-bold text-white sm:text-4xl md:text-5xl">
                                        {{ $post['title'] }}
                                    </h2>

                                    <div class="flex my-6 tech-divider">
                                        <span class="w-40 h-1 bg-white rounded-full"></span>
                                        <span class="w-3 h-1 mx-1 rounded-full bg-white/50"></span>
                                        <span class="w-1 h-1 rounded-full bg-white/30"></span>
                                    </div>

                                    <div class="space-y-4 text-base text-gray-300 sm:text-lg">
                                        <p>{{ $post['summary'] }}</p>
                                    </div>

                                    <a href="{{ route('news.show', $post['slug']) }}"
                                        class="inline-flex items-center px-6 py-3 mt-8 text-sm font-medium transition-all duration-300 bg-white rounded-full hover:bg-white/90 hover:pl-8 group">
                                        <span>Learn More</span>
                                        <span class="ml-2 transition-transform group-hover:translate-x-1">→</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endforeach
        </div>

        <!-- Navigation dots -->
        <div class="tech-dots-container">
            @foreach ($posts as $index => $post)
                <button onclick="scrollToTechSection({{ $index }})"
                    class="dot-button-tech {{ $index === 0 ? 'active' : '' }}" title="Go to section {{ $index + 1 }}"
                    aria-label="Go to slide {{ $index + 1 }}">
                </button>
            @endforeach
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const techContainer = document.getElementById('tech-scroll-container');
                const techDots = document.querySelectorAll('.tech-dots-container .dot-button-tech');
                let isTechScrolling = false;

                // Scroll to section function
                function scrollToTechSection(index) {
                    if (isTechScrolling || !techContainer.children[index]) return;

                    isTechScrolling = true;
                    techContainer.children[index].scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });

                    updateTechDots(index);
                    setTimeout(() => isTechScrolling = false, 1000);
                }

                // Update dot indicators
                function updateTechDots(index) {
                    techDots.forEach((dot, i) => {
                        dot.classList.toggle('active', i === index);
                    });
                }

                // Intersection Observer for scroll detection
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting && !isTechScrolling) {
                            const index = Array.from(techContainer.children).indexOf(entry.target);
                            if (index >= 0) updateTechDots(index);
                        }
                    });
                }, {
                    threshold: 0.5
                });

                // Observe all sections
                Array.from(techContainer.children).forEach(section => {
                    observer.observe(section);
                });

                // Initialize first dot as active
                updateTechDots(0);
            });
        </script>
    @else
        <div class="flex items-center justify-center h-screen p-4">
            <p class="text-center text-neutral-400">No technology posts available at the moment.</p>
        </div>
    @endif
</div>
