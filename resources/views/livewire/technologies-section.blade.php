<style>
    :root {
        /* Light mode colors */
        --grid-opacity: 0.02;
        --blur-size: 40px;
        --dot-size: 12px;
        --animation-duration: 0.3s;

        /* Text colors */
        --text-color: white;
        --text-secondary: rgba(255, 255, 255, 0.7);
        --divider-primary: white;
        --divider-secondary: rgba(255, 255, 255, 0.5);
        --divider-tertiary: rgba(255, 255, 255, 0.3);

        /* UI elements */
        --dot-inactive: rgba(255, 255, 255, 0.2);
        --dot-hover: rgba(255, 255, 255, 0.5);
        --dot-active: white;
        --image-wrapper-bg: rgba(255, 255, 255, 0.1);
        --button-bg: white;
        --button-text: #0a0a0a;
        --button-hover: rgba(255, 255, 255, 0.9);

        /* Shimmer effect */
        --shimmer-light: #f0f0f0;
        --shimmer-dark: #e0e0e0;
    }

    /* Dark mode adjustments */
    @media (prefers-color-scheme: dark) {
        :root {
            --grid-opacity: 0.05;
            --text-color: #f8f9fa;
            --text-secondary: rgba(248, 249, 250, 0.8);
            --divider-primary: #f8f9fa;
            --divider-secondary: rgba(248, 249, 250, 0.6);
            --divider-tertiary: rgba(248, 249, 250, 0.4);
            --image-wrapper-bg: rgba(248, 249, 250, 0.08);
            --dot-inactive: rgba(248, 249, 250, 0.15);
            --dot-hover: rgba(248, 249, 250, 0.4);
            --shimmer-light: #1a1a1a;
            --shimmer-dark: #2a2a2a;
        }
    }

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

    @keyframes shimmer {
        0% {
            background-position: -200% 0;
        }

        100% {
            background-position: 200% 0;
        }
    }

    /* Tech Slider Container */
    .tech-slider-container {
        position: relative;
        height: auto;
        min-height: 100vh;
        overflow: hidden;
        isolation: isolate;
        background-color: var(--primary-bg);
    }

    /* Background Ornaments */
    .tech-slider__bg-ornament {
        position: absolute;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 0;
    }

    .tech-slider__bg-grid {
        background-image:
            linear-gradient(to right, rgba(255, 255, 255, var(--grid-opacity)) 1px, transparent 1px),
            linear-gradient(to bottom, rgba(255, 255, 255, var(--grid-opacity)) 1px, transparent 1px);
        background-size: 40px 40px;
        opacity: 0.5;
    }

    .tech-slider__bg-circles {
        background-image:
            radial-gradient(circle at 20% 30%, rgba(100, 217, 255, 0.05) 0%, transparent 15%),
            radial-gradient(circle at 80% 70%, rgba(255, 100, 217, 0.05) 0%, transparent 15%),
            radial-gradient(circle at 50% 20%, rgba(217, 100, 255, 0.05) 0%, transparent 15%);
        background-size: 200% 200%;
        animation: gradientMove 20s ease infinite;
    }

    /* Blob Ornaments */
    .tech-slider__blob {
        position: absolute;
        filter: blur(var(--blur-size));
        opacity: 0.15;
        border-radius: 50%;
        animation: float 15s infinite ease-in-out;
        will-change: transform;
    }

    .tech-slider__blob--1 {
        width: 400px;
        height: 400px;
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        top: 20%;
        left: 10%;
    }

    .tech-slider__blob--2 {
        width: 300px;
        height: 300px;
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        bottom: 15%;
        right: 10%;
        animation-delay: 5s;
    }

    .tech-slider__blob--3 {
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

    .tech-slider__section {
        scroll-snap-align: start;
        position: relative;
        min-height: 100vh;
        display: flex;
        align-items: center;
        will-change: transform;
    }

    /* Dots Navigation */
    .tech-slider__dots {
        position: absolute;
        right: 1.5rem;
        top: 50%;
        transform: translateY(-50%);
        z-index: 50;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .tech-slider__dot {
        width: var(--dot-size);
        height: var(--dot-size);
        border-radius: 50%;
        transition: all var(--animation-duration) ease;
        background-color: var(--dot-inactive);
        border: none;
        cursor: pointer;
        padding: 0;
    }

    .tech-slider__dot:hover,
    .tech-slider__dot:focus {
        background-color: var(--dot-hover);
        transform: scale(1.25);
        outline: 2px solid var(--dot-active);
        outline-offset: 2px;
    }

    .tech-slider__dot--active {
        background-color: var(--dot-active);
        transform: scale(1.5);
    }

    /* Content Styles */
    .tech-slider__content {
        opacity: 0;
        animation: textReveal 0.8s ease-out forwards;
        animation-delay: 0.3s;
        will-change: transform, opacity;
    }

    .tech-slider__image-container {
        position: relative;
        width: 100%;
        max-height: 500px;
        overflow: hidden;
    }

    .tech-slider__image-wrapper {
        padding: 1rem;
        background-color: var(--image-wrapper-bg);
        border-radius: 0.5rem;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        backdrop-filter: blur(4px);
    }

    .tech-slider__image {
        width: 100%;
        height: auto;
        border-radius: 0.5rem;
        background: linear-gradient(90deg, var(--shimmer-light) 25%, var(--shimmer-dark) 50%, var(--shimmer-light) 75%);
        background-size: 200% 100%;
        animation: shimmer 1.5s infinite;
    }

    .tech-slider__title {
        margin-bottom: 1rem;
        font-weight: 700;
        color: var(--text-color);
        line-height: 1.2;
        font-size: clamp(1.75rem, 5vw, 3rem);
    }

    .tech-slider__divider {
        display: flex;
        align-items: center;
        margin: 1.5rem 0;
    }

    .tech-slider__divider-line {
        height: 2px;
        border-radius: 1px;
    }

    .tech-slider__divider-line--primary {
        width: 10rem;
        background-color: var(--divider-primary);
    }

    .tech-slider__divider-line--secondary {
        width: 0.75rem;
        margin: 0 0.25rem;
        background-color: var(--divider-secondary);
    }

    .tech-slider__divider-line--tertiary {
        width: 0.25rem;
        background-color: var(--divider-tertiary);
    }

    .tech-slider__text {
        color: var(--text-secondary);
        line-height: 1.6;
        font-size: clamp(0.875rem, 2vw, 1rem);
    }

    .tech-slider__button {
        display: inline-flex;
        align-items: center;
        padding: 0.75rem 1.5rem;
        margin-top: 2rem;
        font-size: 0.875rem;
        font-weight: 500;
        color: var(--button-text);
        background-color: var(--button-bg);
        border-radius: 9999px;
        transition: all var(--animation-duration) ease;
    }

    .tech-slider__button:hover {
        background-color: var(--button-hover);
        padding-left: 2rem;
    }

    .tech-slider__button-arrow {
        margin-left: 0.5rem;
        transition: transform var(--animation-duration) ease;
    }

    .tech-slider__button:hover .tech-slider__button-arrow {
        transform: translateX(0.25rem);
    }

    /* Responsive Styles */
    @media (max-width: 767px) {
        :root {
            --blur-size: 30px;
            --dot-size: 14px;
        }

        .tech-slider-container {
            height: auto;
            min-height: 100vh;
        }

        .tech-slider__section {
            padding: 1rem;
            height: auto;
            min-height: 100vh;
            flex-direction: column;
        }

        .tech-slider__content {
            padding: 0 1rem 2rem;
            animation-delay: 0.1s;
        }

        .tech-slider__image-container {
            max-height: 300px;
            margin-bottom: 1.5rem;
        }

        .tech-slider__title {
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }

        .tech-slider__divider {
            margin: 1rem 0;
        }

        .tech-slider__divider-line--primary {
            width: 6rem;
        }

        .tech-slider__dots {
            right: 0.5rem;
            gap: 0.75rem;
        }

        .tech-slider__button {
            margin-top: 1.5rem;
            padding: 0.5rem 1.25rem;
        }
    }

    @media (min-width: 768px) and (max-width: 1023px) {
        .tech-slider__title {
            font-size: 2.5rem;
        }

        .tech-slider__content {
            padding: 0 2rem;
        }
    }

    @media (min-width: 1024px) {
        .tech-slider__title {
            font-size: 3rem;
        }
    }
</style>

<!-- Slider Container -->
<div class="tech-slider-container" id="tech-main-container">
    @if ($posts && count($posts) > 0)
        <!-- Preload first image -->
        <link rel="preload" href="{{ $posts[0]['image'] }}" as="image">

        <!-- Main scroll container -->
        <div class="tech-slider" id="tech-scroll-container" role="region"
            aria-label="{{ __('component.tech_slider.aria_label') }}">
            @foreach ($posts as $index => $post)
                <!-- Each slide section -->
                <section class="tech-slider__section" id="tech-section-{{ $index }}"
                    aria-labelledby="tech-title-{{ $index }}">
                    <div class="container h-full px-4 mx-auto sm:px-6 lg:px-8">
                        <div class="flex flex-col items-center h-full gap-6 py-8 md:flex-row lg:gap-12 md:py-12">
                            <!-- Image Column -->
                            <div class="tech-slider__image-container">
                                <div class="tech-slider__image-wrapper">
                                    <img src="{{ $post['image'] }}" alt="{{ $post['title'] }}"
                                        class="tech-slider__image" loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
                                        decoding="async" width="800" height="600">
                                </div>
                            </div>

                            <!-- Content Column -->
                            <div class="tech-slider__content">
                                <div class="max-w-2xl px-4 mx-auto sm:px-6 lg:px-0">
                                    <h2 id="tech-title-{{ $index }}" class="tech-slider__title">
                                        {{ $post['title'] }}
                                    </h2>

                                    <div class="tech-slider__divider">
                                        <span
                                            class="tech-slider__divider-line tech-slider__divider-line--primary"></span>
                                        <span
                                            class="tech-slider__divider-line tech-slider__divider-line--secondary"></span>
                                        <span
                                            class="tech-slider__divider-line tech-slider__divider-line--tertiary"></span>
                                    </div>

                                    <div class="space-y-4 tech-slider__text">
                                        <p>{{ $post['summary'] }}</p>
                                    </div>

                                    <a href="{{ route('news.show', $post['slug']) }}"
                                        class="tech-slider__button group">
                                        <span>{{ __('component.tech_slider.learn_more') }}</span>
                                        <span class="tech-slider__button-arrow">→</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endforeach
        </div>

        <!-- Navigation dots -->
        <div class="tech-slider__dots">
            @foreach ($posts as $index => $post)
                <button onclick="scrollToTechSection({{ $index }})"
                    class="tech-slider__dot {{ $index === 0 ? 'tech-slider__dot--active' : '' }}"
                    title="{{ str_replace(':number', $index + 1, __('component.tech_slider.navigation.go_to_section')) }}"
                    aria-label="{{ str_replace(':number', $index + 1, __('component.tech_slider.navigation.go_to_slide')) }}"
                    aria-controls="tech-section-{{ $index }}">
                </button>
            @endforeach
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const techMainContainer = document.getElementById('tech-main-container');
                const techSlider = document.getElementById('tech-scroll-container');
                const techDots = document.querySelectorAll('.tech-slider__dot');
                let isTechScrolling = false;
                let resizeTimeout;

                // Debounce function
                function debounce(func, wait) {
                    return function() {
                        const context = this,
                            args = arguments;
                        clearTimeout(resizeTimeout);
                        resizeTimeout = setTimeout(() => func.apply(context, args), wait);
                    };
                }

                // Set container height based on viewport
                function setContainerHeight() {
                    if (techSlider.children.length > 0) {
                        const firstSlide = techSlider.children[0];
                        if (window.innerWidth < 768) {
                            techMainContainer.style.height = 'auto';
                        } else {
                            techMainContainer.style.height = `${firstSlide.offsetHeight}px`;
                        }
                    }
                }

                // Initialize and handle resize with debounce
                setContainerHeight();
                window.addEventListener('resize', debounce(setContainerHeight, 100));
                window.addEventListener('orientationchange', debounce(setContainerHeight, 100));

                // Scroll to specific section
                function scrollToTechSection(index) {
                    if (isTechScrolling || !techSlider.children[index]) return;

                    isTechScrolling = true;
                    const targetSection = techSlider.children[index];

                    // Focus the section for keyboard/screen reader users
                    targetSection.setAttribute('tabindex', '-1');
                    targetSection.focus();

                    targetSection.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });

                    updateTechDots(index);
                    setTimeout(() => {
                        isTechScrolling = false;
                        targetSection.removeAttribute('tabindex');
                    }, 1000);
                }

                // Update active dot
                function updateTechDots(index) {
                    techDots.forEach((dot, i) => {
                        const isActive = i === index;
                        dot.classList.toggle('tech-slider__dot--active', isActive);
                        dot.setAttribute('aria-current', isActive ? 'true' : 'false');
                    });
                }

                // Detect visible section with IntersectionObserver
                const observerOptions = {
                    root: techSlider,
                    threshold: 0.5
                };

                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting && !isTechScrolling) {
                            const index = Array.from(techSlider.children).indexOf(entry.target);
                            if (index >= 0) updateTechDots(index);
                        }
                    });
                }, observerOptions);

                // Observe all sections
                Array.from(techSlider.children).forEach(section => {
                    observer.observe(section);
                });

                // Keyboard navigation
                techSlider.addEventListener('keydown', (e) => {
                    const currentIndex = Array.from(techDots).findIndex(dot =>
                        dot.classList.contains('tech-slider__dot--active'));

                    if (e.key === 'ArrowUp' && currentIndex > 0) {
                        e.preventDefault();
                        scrollToTechSection(currentIndex - 1);
                    } else if (e.key === 'ArrowDown' && currentIndex < techDots.length - 1) {
                        e.preventDefault();
                        scrollToTechSection(currentIndex + 1);
                    } else if (e.key === 'Home') {
                        e.preventDefault();
                        scrollToTechSection(0);
                    } else if (e.key === 'End') {
                        e.preventDefault();
                        scrollToTechSection(techDots.length - 1);
                    }
                });

                // Initialize first dot as active
                updateTechDots(0);
            });
        </script>
    @else
        <div class="flex items-center justify-center h-screen p-4">
            <p class="text-center text-neutral-400">{{ __('component.tech_slider.no_posts') }}</p>
        </div>
    @endif
</div>
