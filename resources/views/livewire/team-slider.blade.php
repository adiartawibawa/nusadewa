<div class="team-slider-container">
    <!-- Main Slider Structure -->
    <div class="team-slider-wrapper">
        <!-- Navigation Arrows -->
        <button class="team-slider-arrow team-slider-prev" aria-label="Previous member">
            ◀
        </button>
        <button class="team-slider-arrow team-slider-next" aria-label="Next member">
            ▶
        </button>

        <!-- Slider Content -->
        <div class="team-slider-track">
            @foreach ($teamMembers as $index => $member)
                <div class="team-slide">
                    <div class="team-slide-content">
                        <!-- Member Image -->
                        <div class="team-member-image">
                            @if ($member->avatar)
                                <img src="{{ Storage::url($member->avatar) }}" alt="{{ $member->name }}"
                                    loading="{{ $index < 2 ? 'eager' : 'lazy' }}">
                            @else
                                <div class="team-member-placeholder">
                                    <span>No Image</span>
                                </div>
                            @endif
                        </div>

                        <!-- Member Details -->
                        <div class="team-member-details">
                            <span class="team-member-counter">
                                {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }} / TEAM
                            </span>
                            <h3 class="team-member-name">{{ $member->name }}</h3>
                            <p class="team-member-position">{{ $member->position }}</p>
                            <p class="team-member-bio">{{ $member->bio }}</p>

                            <!-- Social Links -->
                            @if (is_array($member->social_links) && count($member->social_links) > 0)
                                <div class="team-member-social">
                                    @foreach ($member->social_links as $social)
                                        @if (!empty($social['url']) && !empty($social['platform']))
                                            <a href="{{ $social['url'] }}" target="_blank"
                                                aria-label="{{ $social['platform'] }}" class="social-link">
                                                <i class="{{ $this->getSocialIcon($social['platform']) }}"></i>
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                            @endif

                            <!-- Contact Button -->
                            <a href="#contact" class="team-contact-button">
                                Contact {{ explode(' ', $member->name)[0] }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Dots Navigation -->
        <div class="team-slider-dots">
            @foreach ($teamMembers as $index => $member)
                <button class="team-dot {{ $loop->first ? 'active' : '' }}" aria-label="Go to {{ $member->name }}"
                    data-index="{{ $index }}"></button>
            @endforeach
        </div>
    </div>

    <style>
        /* Base Styles */
        .team-slider-container {
            --slider-arrow-size: 2.5rem;
            --slider-arrow-bg: rgba(255, 255, 255, 0.8);
            --slider-dot-size: 10px;
            --slider-dot-active: #3b82f6;
            --slider-dot-inactive: rgba(255, 255, 255, 0.3);
            --slide-gap: 1rem;
            position: relative;
            height: 80vh;
            min-height: 600px;
            overflow: hidden;
        }

        .team-slider-wrapper {
            position: relative;
            height: 100%;
            width: 100%;
        }

        /* Slider Track */
        .team-slider-track {
            display: flex;
            height: 100%;
            width: 100%;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
        }

        .team-slider-track::-webkit-scrollbar {
            display: none;
        }

        /* Slides */
        .team-slide {
            flex: 0 0 100%;
            scroll-snap-align: start;
            position: relative;
        }

        .team-slide-content {
            display: flex;
            flex-direction: column;
            height: 100%;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            gap: 2rem;
        }

        @media (min-width: 768px) {
            .team-slide-content {
                flex-direction: row;
                align-items: center;
                gap: 4rem;
            }
        }

        /* Member Image */
        .team-member-image {
            position: relative;
            width: 100%;
            height: 300px;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        @media (min-width: 768px) {
            .team-member-image {
                flex: 0 0 45%;
                height: 400px;
            }
        }

        .team-member-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .team-member-image:hover img {
            transform: scale(1.05);
        }

        .team-member-placeholder {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            background-color: #e5e7eb;
            color: #6b7280;
            font-size: 1.5rem;
        }

        /* Member Details */
        .team-member-details {
            flex: 1;
            color: #333;
        }

        .team-member-counter {
            display: block;
            font-family: monospace;
            font-size: 0.875rem;
            color: #6b7280;
            margin-bottom: 0.5rem;
        }

        .team-member-name {
            font-size: 2rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 0.5rem;
            color: #111827;
        }

        @media (min-width: 768px) {
            .team-member-name {
                font-size: 3rem;
            }
        }

        .team-member-position {
            font-size: 1.25rem;
            color: #3b82f6;
            margin-bottom: 1.5rem;
        }

        .team-member-bio {
            font-size: 1.1rem;
            line-height: 1.6;
            color: #4b5563;
            margin-bottom: 2rem;
        }

        /* Social Links */
        .team-member-social {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .social-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            color: #6b7280;
            transition: all 0.3s ease;
        }

        .social-link:hover {
            color: #3b82f6;
            transform: translateY(-2px);
        }

        .social-link i {
            font-size: 1.25rem;
        }

        /* Contact Button */
        .team-contact-button {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background-color: #3b82f6;
            color: white;
            font-weight: 500;
            border-radius: 9999px;
            transition: all 0.3s ease;
        }

        .team-contact-button:hover {
            background-color: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
        }

        /* Navigation Arrows */
        .team-slider-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: var(--slider-arrow-size);
            height: var(--slider-arrow-size);
            border-radius: 50%;
            background-color: var(--slider-arrow-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            cursor: pointer;
            z-index: 10;
            opacity: 0;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border: none;
        }

        .team-slider-wrapper:hover .team-slider-arrow {
            opacity: 1;
        }

        .team-slider-prev {
            left: 1rem;
        }

        .team-slider-next {
            right: 1rem;
        }

        .team-slider-arrow:hover {
            background-color: white;
            transform: translateY(-50%) scale(1.1);
        }

        /* Dots Navigation */
        .team-slider-dots {
            position: absolute;
            bottom: 1.5rem;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 0.5rem;
            z-index: 10;
        }

        .team-dot {
            width: var(--slider-dot-size);
            height: var(--slider-dot-size);
            border-radius: 50%;
            background-color: var(--slider-dot-inactive);
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            padding: 0;
        }

        .team-dot:hover {
            transform: scale(1.3);
            background-color: white;
        }

        .team-dot.active {
            background-color: var(--slider-dot-active);
            transform: scale(1.3);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slider = document.querySelector('.team-slider-track');
            const slides = document.querySelectorAll('.team-slide');
            const dots = document.querySelectorAll('.team-dot');
            const prevBtn = document.querySelector('.team-slider-prev');
            const nextBtn = document.querySelector('.team-slider-next');
            let currentIndex = 0;
            let isScrolling = false;
            let scrollTimeout;

            // Scroll to specific slide
            function goToSlide(index) {
                if (isScrolling || index < 0 || index >= slides.length) return;

                isScrolling = true;
                currentIndex = index;

                slides[index].scrollIntoView({
                    behavior: 'smooth',
                    block: 'nearest',
                    inline: 'start'
                });

                updateDots();

                clearTimeout(scrollTimeout);
                scrollTimeout = setTimeout(() => {
                    isScrolling = false;
                }, 700);
            }

            // Update dot indicators
            function updateDots() {
                dots.forEach((dot, index) => {
                    dot.classList.toggle('active', index === currentIndex);
                });
            }

            // Previous slide
            function prevSlide() {
                const newIndex = currentIndex === 0 ? slides.length - 1 : currentIndex - 1;
                goToSlide(newIndex);
            }

            // Next slide
            function nextSlide() {
                const newIndex = currentIndex === slides.length - 1 ? 0 : currentIndex + 1;
                goToSlide(newIndex);
            }

            // Handle dot clicks
            dots.forEach(dot => {
                dot.addEventListener('click', () => {
                    const index = parseInt(dot.getAttribute('data-index'));
                    goToSlide(index);
                });
            });

            // Handle arrow clicks
            prevBtn.addEventListener('click', prevSlide);
            nextBtn.addEventListener('click', nextSlide);

            // Handle keyboard navigation
            document.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowLeft') prevSlide();
                if (e.key === 'ArrowRight') nextSlide();
            });

            // Detect scroll position to update dots
            slider.addEventListener('scroll', () => {
                if (!isScrolling) {
                    clearTimeout(scrollTimeout);
                    scrollTimeout = setTimeout(() => {
                        const newIndex = Math.round(slider.scrollLeft / slider.offsetWidth);
                        if (newIndex !== currentIndex) {
                            currentIndex = newIndex;
                            updateDots();
                        }
                    }, 100);
                }
            });

            // Initialize
            updateDots();
        });
    </script>
</div>
