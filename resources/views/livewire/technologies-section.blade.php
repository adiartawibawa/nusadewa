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

        100% {
            transform: translate(0, 0) rotate(0deg);
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

    /* Background Ornament Styles */
    .tech-slider-container {
        position: relative;
        height: 100vh;
        overflow: hidden;
        background-color: #0a0a0a;
        isolation: isolate;
    }

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

    /* Blob Ornament Styles */
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
        animation-delay: 0s;
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

    /* Component Styles */
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
    }

    .tech-dots-container {
        position: fixed;
        right: 1.5rem;
        top: 50%;
        transform: translateY(-50%);
        z-index: 50;
    }

    .shine-effect {
        position: relative;
        overflow: hidden;
    }

    .shine-effect::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg,
                transparent,
                rgba(255, 255, 255, 0.2),
                transparent);
        transform: translateX(-100%) rotate(45deg);
        z-index: 1;
    }

    .shine-effect:hover::before {
        animation: shine 1.5s ease;
    }

    .tech-divider span {
        height: 2px;
        border-radius: 9999px;
        display: block;
        background: linear-gradient(90deg, #ffffff, rgba(255, 255, 255, 0.5));
    }

    .tech-divider span:nth-child(1) {
        width: 10rem;
    }

    .tech-divider span:nth-child(2) {
        width: 0.75rem;
        margin: 0 0.25rem;
    }

    .tech-divider span:nth-child(3) {
        width: 0.25rem;
    }

    .tech-slide-content {
        opacity: 0;
        animation: textReveal 0.8s ease-out forwards;
        animation-delay: 0.3s;
    }

    .tech-image-container img {
        transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .tech-image-container:hover img {
        transform: scale(1.03);
    }

    /* Floating Particles */
    .particle {
        position: absolute;
        border-radius: 50%;
        pointer-events: none;
        z-index: 0;
        filter: blur(3px);
    }

    /* Responsive Styles */
    @media (max-width: 767px) {
        .tech-slider-container {
            height: auto;
            min-height: 100vh;
        }

        .scroll-section {
            min-height: 100vh;
            height: auto;
            padding: 2rem 0;
        }

        .tech-slide-content {
            padding-top: 1.5rem;
            padding-bottom: 3rem;
            animation-delay: 0.1s;
        }

        .tech-image-container {
            height: 18rem;
            margin-bottom: 1.5rem;
        }

        .tech-dots-container {
            right: 0.75rem;
            gap: 0.5rem;
        }

        .tech-divider {
            margin: 1.5rem 0;
        }

        .blob {
            filter: blur(30px);
        }
    }

    @media (min-width: 768px) and (max-width: 1023px) {
        .tech-slide-content {
            padding-left: 1rem;
            padding-right: 1rem;
        }
    }
</style>

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
                <section class="scroll-section relative w-full">
                    <div class="container h-full mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="flex flex-col md:flex-row items-center h-full gap-6 lg:gap-12 py-8 md:py-12">
                            <!-- Image Column -->
                            <div
                                class="w-full md:w-1/2 tech-image-container flex items-center justify-center shine-effect">
                                <div
                                    class="p-1 bg-white/10 rounded-lg shadow-2xl w-full max-h-[500px] overflow-hidden backdrop-blur-sm">
                                    <img src="{{ $post['image'] }}" alt="{{ $post['title'] }}"
                                        class="w-full h-full object-cover rounded-lg"
                                        loading="{{ $index === 0 ? 'eager' : 'lazy' }}">
                                </div>
                            </div>

                            <!-- Content Column -->
                            <div class="w-full md:w-1/2 tech-slide-content">
                                <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-0">
                                    <h2 class="mb-4 text-3xl sm:text-4xl md:text-5xl font-bold text-white">
                                        {{ $post['title'] }}
                                    </h2>

                                    <div class="tech-divider flex my-6">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>

                                    <div class="space-y-4 text-gray-300 text-base sm:text-lg">
                                        <p>{{ $post['summary'] }}</p>
                                        <p class="opacity-80">This scientific approach eliminates guesswork,
                                            guaranteeing consistent quality and performance.</p>
                                    </div>

                                    <a href="{{ route('news.show', $post['slug']) }}"
                                        class="mt-8 inline-flex items-center px-6 py-3 bg-white hover:bg-white/90 rounded-full text-sm font-medium transition-all duration-300 hover:pl-8 group">
                                        <span>Learn More</span>
                                        <span class="ml-2 group-hover:translate-x-1 transition-transform">→</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endforeach
        </div>

        <!-- Navigation dots -->
        <div class="tech-dots-container flex flex-col gap-4">
            @foreach ($posts as $index => $post)
                <button onclick="scrollToTechSection({{ $index }})"
                    class="dot-button w-3 h-3 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-white scale-150' : 'bg-white/20 hover:bg-white/50 hover:scale-125' }}"
                    title="Go to section {{ $index + 1 }}" aria-label="Go to slide {{ $index + 1 }}">
                </button>
            @endforeach
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const techContainer = document.getElementById('tech-scroll-container');
                const mainContainer = document.getElementById('tech-main-container');
                const techSections = document.querySelectorAll('.scroll-section');
                const techDots = document.querySelectorAll('.tech-dots-container button');
                let isTechScrolling = false;
                let touchStartY = 0;
                let scrollTimeout;

                // Create dynamic particles
                function createParticles() {
                    const particleCount = 20;
                    const colors = ['#4facfe', '#00f2fe', '#f093fb', '#f5576c', '#43e97b', '#38f9d7'];

                    for (let i = 0; i < particleCount; i++) {
                        const particle = document.createElement('div');
                        particle.className = 'particle';

                        // Random properties
                        const size = Math.random() * 6 + 2;
                        const posX = Math.random() * 100;
                        const posY = Math.random() * 100;
                        const opacity = Math.random() * 0.2 + 0.05;
                        const duration = Math.random() * 15 + 10;
                        const delay = Math.random() * 5;
                        const color = colors[Math.floor(Math.random() * colors.length)];

                        particle.style.cssText = `
                            width: ${size}px;
                            height: ${size}px;
                            left: ${posX}%;
                            top: ${posY}%;
                            opacity: ${opacity};
                            background: ${color};
                            animation: float ${duration}s infinite ${delay}s ease-in-out;
                        `;

                        mainContainer.appendChild(particle);
                    }
                }

                // Improved scroll function
                function scrollToTechSection(index) {
                    if (isTechScrolling || !techSections[index]) return;

                    isTechScrolling = true;
                    clearTimeout(scrollTimeout);

                    techSections[index].scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });

                    updateTechDots(index);

                    scrollTimeout = setTimeout(() => {
                        isTechScrolling = false;
                    }, 1000);
                }

                function updateTechDots(index) {
                    techDots.forEach((dot, i) => {
                        const isActive = i === index;
                        dot.classList.toggle('bg-white', isActive);
                        dot.classList.toggle('scale-150', isActive);
                        dot.classList.toggle('bg-white/20', !isActive);
                        dot.classList.toggle('hover:bg-white/50', !isActive);
                        dot.classList.toggle('hover:scale-125', !isActive);
                    });
                }

                // Touch support
                techContainer.addEventListener('touchstart', (e) => {
                    touchStartY = e.touches[0].clientY;
                }, {
                    passive: true
                });

                techContainer.addEventListener('touchend', (e) => {
                    if (isTechScrolling) return;

                    const touchEndY = e.changedTouches[0].clientY;
                    const diff = touchStartY - touchEndY;
                    const threshold = window.innerHeight * 0.1;

                    if (Math.abs(diff) > threshold) {
                        const direction = diff > 0 ? 1 : -1;
                        const currentIndex = Math.round(techContainer.scrollTop / window.innerHeight);
                        const newIndex = Math.max(0, Math.min(currentIndex + direction, techSections.length -
                            1));
                        scrollToTechSection(newIndex);
                    }
                }, {
                    passive: true
                });

                // Intersection Observer
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const index = Array.from(techSections).indexOf(entry.target);
                            if (index >= 0 && !isTechScrolling) {
                                updateTechDots(index);

                                const content = entry.target.querySelector('.tech-slide-content');
                                if (content) {
                                    content.style.animation = 'none';
                                    setTimeout(() => {
                                        content.style.animation =
                                            'textReveal 0.8s ease-out forwards';
                                    }, 50);
                                }
                            }
                        }
                    });
                }, {
                    threshold: 0.5
                });

                techSections.forEach(section => {
                    observer.observe(section);
                });

                // Blob morphing effect
                function morphBlobs() {
                    const blobs = document.querySelectorAll('.blob');
                    blobs.forEach(blob => {
                        const scale = 0.9 + Math.random() * 0.2;
                        const borderRadius1 = 40 + Math.random() * 10;
                        const borderRadius2 = 50 + Math.random() * 10;

                        blob.style.borderRadius =
                            `${borderRadius1}% ${borderRadius2}% ${borderRadius1}% ${borderRadius2}%`;
                        blob.style.transform = `scale(${scale})`;
                    });

                    setTimeout(morphBlobs, 3000);
                }

                // Initialize
                updateTechDots(0);
                createParticles();
                morphBlobs();

                // Animate first slide content
                const firstSlideContent = document.querySelector('.tech-slide-content');
                if (firstSlideContent) {
                    firstSlideContent.style.opacity = '1';
                }
            });
        </script>
    @else
        <div class="h-screen flex items-center justify-center p-4">
            <p class="text-neutral-400 text-center">No technology posts available at the moment.</p>
        </div>
    @endif
</div>
