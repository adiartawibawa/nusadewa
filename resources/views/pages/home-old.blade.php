@extends('layouts.app')

@section('title', 'Nusa Dewa - Aquaculture Innovation')

@section('content')
    <!-- Hero Section -->
    <section class="home-one bg-home1"
        style="background-image: url('https://images.unsplash.com/photo-1519122295308-bdb40916b529?q=80&w=1374&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
        <div class="container">
            <div class="row posr">
                <div class="m-auto col-lg-10">
                    <div class="home_content home1_style">
                        <div class="text-center home-text mb30">
                            <h2 class="title">
                                {{-- <span class="aminated-object1"><img class="objects"
                                        src="assets/images/home/title-bottom-border.svg" alt="">
                                </span> --}}
                                INNOVATION MEETS AQUACULTURE
                            </h2>
                            <p class="para">Advanced shrimp broodstock breeding combining biotechnology with decades of
                                expertise</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Innovation Section -->
    <section class="car-category mobile_space bgc-f9 z-2 pb100 pt80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center main-title">
                        <h2>Our Innovation</h2>
                        <p class="para">State-of-the-art biotechnology for superior shrimp broodstock</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s">
                    <div class="text-center category_item">
                        <div class="thumb mb20">
                            <img src="https://images.unsplash.com/photo-1721189438751-1026d27b1f78?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                alt="Genomic Selection">
                        </div>
                        <div class="details">
                            <h4 class="title">Genomic Selection</h4>
                            <p>Advanced genetic screening for optimal traits</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
                    <div class="text-center category_item">
                        <div class="thumb mb20">
                            <img src="https://images.unsplash.com/photo-1518471663599-b686196bdab8?q=80&w=1632&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                alt="Disease Resistance">
                        </div>
                        <div class="details">
                            <h4 class="title">Disease Resistance</h4>
                            <p>Rigorous profiling for enhanced survivability</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                    <div class="text-center category_item">
                        <div class="thumb mb20">
                            <img src="https://images.unsplash.com/photo-1565926670755-88c340527be2?q=80&w=1418&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                alt="Environmental Conditioning">
                        </div>
                        <div class="details">
                            <h4 class="title">Precision Conditioning</h4>
                            <p>Optimized environments for broodstock development</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Technology Section -->
    <section class="why-chose pt0 pb90 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="why_chose_us">
                        <h2>MOLECULAR PRECISION</h2>
                        <p>At the heart of <strong>Induk Udang Nusa Dewa</strong> lies cutting-edge molecular technology
                            that ensures precision in every broodstock. Through advanced genetic screening and selective
                            breeding, we deliver shrimp broodstock with superior health, growth performance, and disease
                            resistance.</p>
                        <p>This scientific approach eliminates guesswork, guaranteeing consistent quality and performance
                            that meets global aquaculture standards. With <strong>Nusa Dewa</strong>, you're not just
                            farming shrimp — you're cultivating a future of reliability, traceability, and profitability.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1668243304603-7ecf4eefba6e?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8bGFiJTIwTW9sZWN1bGFyJTIwVGVjaG5vbG9neXxlbnwwfDB8MHx8fDI%3D"
                        alt="Molecular Technology" class="rounded img-fluid">
                </div>
            </div>
        </div>
    </section>

    <!-- Performance Testing -->
    <section class="featured-product pt80 pb80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center main-title">
                        <h2>MULTILOCATION PERFORMANCE TEST</h2>
                        <p>Proven adaptability across diverse farming conditions</p>
                    </div>
                </div>
            </div>
            <div class="row mt50">
                <div class="col-lg-12">
                    <div class="text-center">
                        <p>At <strong>NUSA DEWA</strong>, we go beyond the lab to ensure real-world success. Our vannamei
                            broodstock is tested across multiple farming locations—spanning various climates, salinities,
                            and systems—to guarantee consistent performance wherever they're cultivated.</p>
                        <p>This <strong>Multilocation Performance Test</strong> validates key traits like fast growth, high
                            survival, and disease resistance under practical conditions. The result? Proven adaptability,
                            lower production risks, and peace of mind for farmers around the world. With <strong>NUSA
                                DEWA</strong>, field-tested performance isn't just a promise—it's a proven standard.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Global Reach -->
    <section class="deliver-divider bg-img1"
        style="background-image: url('https://images.unsplash.com/photo-1572015242290-d9132e2b6d52?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-xl-6">
                    <div class="text-white home1_divider_content">
                        <h2 class="title">WORLDWIDE ACCESS</h2>
                        <p class="para">Strategically located in Bali, our vannamei broodstock breeding program is
                            designed with global reach in mind. With international-standard biosecurity, advanced genetics,
                            and streamlined export capabilities, we offer premium broodstock to aquaculture markets around
                            the world.</p>
                        <p class="para">From Southeast Asia to the Americas, <strong>Bali-bred</strong> vannamei shrimp
                            deliver consistent quality, disease resistance, and performance that meets the demands of modern
                            shrimp farming. Wherever you farm, <strong>Nusa Dewa broodstock</strong> brings Bali's
                            innovation to your pond — reliably, efficiently, and sustainably.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Expertise Section -->
    <section class="our-team pt80 pb80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center main-title">
                        <h2>SOLID EXPERTISE</h2>
                        <p class="para">Our multidisciplinary team of aquaculture specialists</p>
                    </div>
                </div>
            </div>

            <div class="row mt50">
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s">
                    <div class="team_member">
                        <div class="thumb">
                            <img class="img-fluid"
                                src="https://images.unsplash.com/photo-1566753323558-f4e0952af115?q=80&w=1442&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                alt="Wendy Tri Prabowo">
                        </div>
                        <div class="details">
                            <h4>Wendy Tri Prabowo</h4>
                            <p>Director of Shrimp Breeding Center</p>
                            <p>20+ years expertise in shrimp breeding, focusing on high-performance strains through
                                selective breeding and genome editing analysis.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
                    <div class="team_member">
                        <div class="thumb">
                            <img class="img-fluid"
                                src="https://images.unsplash.com/photo-1557862921-37829c790f19?q=80&w=1471&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                alt="Bagus Rahmat Basuki">
                        </div>
                        <div class="details">
                            <h4>Bagus Rahmat Basuki</h4>
                            <p>Molecular and Biotechnology Lab Coordinator</p>
                            <p>16+ years in genetic research, specializing in disease-resistant shrimp strains and WSSV
                                resistance markers.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                    <div class="team_member">
                        <div class="thumb">
                            <img class="img-fluid" src=" " alt="M. Suyuti">
                        </div>
                        <div class="details">
                            <h4>M. Suyuti</h4>
                            <p>Broodstock Center Coordinator</p>
                            <p>23+ years in hatchery management, specializing in broodstock conditioning and sustainable
                                aquaculture systems.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt30">
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s">
                    <div class="team_member">
                        <div class="thumb">
                            <img class="img-fluid"
                                src="https://images.unsplash.com/photo-1589386417686-0d34b5903d23?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                alt="Faisal Ramadhan">
                        </div>
                        <div class="details">
                            <h4>Faisal Ramadhan</h4>
                            <p>Public Services and Quality Control</p>
                            <p>17+ years bridging technical excellence with community engagement and farmer partnerships.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
                    <div class="team_member">
                        <div class="thumb">
                            <img class="img-fluid"
                                src="https://images.unsplash.com/photo-1604364721460-0cbc5866219d?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                alt="Ni Luh Eka S.J.W">
                        </div>
                        <div class="details">
                            <h4>Ni Luh Eka S.J.W</h4>
                            <p>Human Resources Coordinator</p>
                            <p>17+ years in HR management, aligning human capital with technical aquaculture demands.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                    <div class="team_member">
                        <div class="details">
                            <h4>Our Commitment</h4>
                            <p>At <strong>NUSA DEWA</strong>, our strength lies in experience. Our breeding program is led
                                by a multidisciplinary team who have spent years perfecting the science of vannamei
                                broodstock.</p>
                            <p>Every decision—from genetic selection to performance evaluation—is grounded in proven
                                research and real-world insight. With a commitment to continuous improvement and data-driven
                                practices, we don't just follow standards — we set them.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="popular-listing pb80 pt80 bg-ptrn1 bgc-heading-color">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="text-center main-title">
                        <h2 class="text-white">Our Products</h2>
                        <p class="text-white">Specialized shrimp strains for diverse aquaculture needs</p>
                    </div>
                </div>
            </div>

            <div class="row mt50">
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s">
                    <div class="product-card">
                        <div class="thumb">
                            <img src="https://images.unsplash.com/photo-1654346713140-e78bda148084?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                alt="FAST GROWTH strain">
                        </div>
                        <div class="details">
                            <h4>FAST GROWTH STRAIN</h4>
                            <p>Superior growth rates under commercial farming conditions, selectively bred for rapid weight
                                gain and efficient feed conversion.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
                    <div class="product-card">
                        <div class="thumb">
                            <img src="assets/images/products/wssv-resistant.jpg" alt="WSSV-Resistant strain">
                        </div>
                        <div class="details">
                            <h4>WSSV-RESISTANT STRAIN</h4>
                            <p>Genetically improved to combat White Spot Syndrome Virus, demonstrating enhanced survival
                                rates under virus exposure.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                    <div class="product-card">
                        <div class="thumb">
                            <img src="assets/images/products/ehp-resistant.jpg" alt="EHP-Resistant strain">
                        </div>
                        <div class="details">
                            <h4>EHP-RESISTANT STRAIN</h4>
                            <p>Specialized to address Enterocytozoon hepatopenaei, reducing growth retardation in infected
                                environments.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s">
                    <div class="product-card">
                        <div class="thumb">
                            <img src="assets/images/products/plant-based.jpg" alt="Plant-Based Protein strain">
                        </div>
                        <div class="details">
                            <h4>PLANT-BASED PROTEIN STRAIN</h4>
                            <p>Optimized for high performance on plant-based diets, supporting sustainable and
                                cost-efficient aquaculture.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
                    <div class="product-card">
                        <div class="thumb">
                            <img src="assets/images/products/gajah-mada.jpg" alt="GAJAH MADA strain">
                        </div>
                        <div class="details">
                            <h4>GAJAH MADA STRAIN</h4>
                            <p>Regionally adaptive line designed for diverse environments, excelling under varying water
                                qualities and disease pressures.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section class="our-blog pb90 pt80">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="text-center main-title">
                        <h2>Shared News</h2>
                        <p>Latest research and developments from Nusa Dewa</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s">
                    <div class="news-card">
                        <div class="thumb">
                            <img class="img-whp" src="assets/images/news/genome-editing.jpg" alt="Genome Editing">
                        </div>
                        <div class="details">
                            <h4 class="title">Genome Editing: Osteocrin</h4>
                            <p>Advances in genetic modification for improved shrimp traits</p>
                            <a href="#" class="more_listing">Read More <span class="icon"><span
                                        class="fas fa-plus"></span></span></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
                    <div class="news-card">
                        <div class="thumb">
                            <img class="img-whp" src="assets/images/news/snp-resistance.jpg" alt="SNP Resistance">
                        </div>
                        <div class="details">
                            <h4 class="title">SNP Resistance WSSV</h4>
                            <p>Identifying genetic markers for White Spot Syndrome resistance</p>
                            <a href="#" class="more_listing">Read More <span class="icon"><span
                                        class="fas fa-plus"></span></span></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                    <div class="news-card">
                        <div class="thumb">
                            <img class="img-whp" src="assets/images/news/bamboo-disease.jpg" alt="Bamboo Disease">
                        </div>
                        <div class="details">
                            <h4 class="title">Bamboo Disease Analysis</h4>
                            <p>Research on emerging pathogens in aquaculture systems</p>
                            <a href="#" class="more_listing">Read More <span class="icon"><span
                                        class="fas fa-plus"></span></span></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.7s">
                    <div class="news-card">
                        <div class="thumb">
                            <img class="img-whp" src="assets/images/news/multilocation-test.jpg"
                                alt="Multilocation Test">
                        </div>
                        <div class="details">
                            <h4 class="title">Multilocation Test: Progress Report</h4>
                            <p>Field performance of our OI strain across diverse environments</p>
                            <a href="#" class="more_listing">Read More <span class="icon"><span
                                        class="fas fa-plus"></span></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section pt80 pb80 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="contact-info">
                        <h2>Contact Us</h2>
                        <p>Get in touch with our aquaculture experts</p>

                        <div class="contact-method">
                            <h4><i class="fa fa-envelope"></i> Email</h4>
                            <p>info@nusadewa.com</p>
                        </div>

                        <div class="contact-method">
                            <h4><i class="fa fa-phone"></i> Phone</h4>
                            <p>+62 361 1234567</p>
                        </div>

                        <div class="contact-method">
                            <h4><i class="fa fa-comments"></i> Live Chat</h4>
                            <p>Available during business hours</p>
                            <button class="btn btn-primary">Start Chat</button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="contact-form">
                        <h3>Send Us a Message</h3>
                        <form>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Your Name">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Your Email">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Subject">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows="5" placeholder="Your Message"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
