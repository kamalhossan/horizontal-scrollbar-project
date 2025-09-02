<?php

/*Template name: Single Project*/

get_header();

?>

<div class="ace-single-project-wrapper" id="ace-scroll-wrapper">
    <div class="ace-single-project-content-slider-wrapper" id="ace-scroll-content">
        <div class="scroll-section">
            <div class="cards-container">
                <div class="heading ace-single-project-left-content">
                    <h6 class="ace-single-project-type">Residential</h6>
                    <h1 class="ace-single-project-title">Generic title of project Stella Maris</h1>
                    <p class="ace-single-project-description">
                    Our collaborative team of architects, interior designers, and technologists ensures every project is cohesive. We create efficient buildings and functional layouts informed by their context, all while shaping a unified vision for the future of architecture.
                    </p>
                </div>
                <div class="ace-single-project-slider-item">
                    <div class="ace-single-slider-hero-wrapper ace-container">
                        <div class="ace-features-image-full-width">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/single-project.jpg" alt="Signle Project">
                        </div>
                    </div>
                </div>
                <div class="ace-single-project-slider-item">
                    <div class="ace-single-slider-section-two">
                        <div class="ace-single-section-two-content ace-container">
                            <div class="section-two-content">
                                <p>Our collaborative team of architects, interior designers, and technologists ensures every project is cohesive. We create efficient buildings and functional layouts informed by their context, all while shaping a unified vision for the future of architecture. Our collaborative team of architects, interior designers, and technologists ensures every project is cohesive. We create efficient buildings and functional layouts informed by their context, all while shaping a unified vision for the future of architecture.Our collaborative team of architects, interior designers, and technologists ensures every project is cohesive. We create efficient buildings and functional layouts informed by their context, all while shaping a unified vision for the future of architecture.</p>
                            </div>
                            <div class="section-two-image">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/single-project.jpg" alt="Signle Project">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ace-single-project-slider-item">
                    <div class="ace-single-slider-section-three">
                        <div class="ace-single-sectino-three-content ace-container">
                            <div class="section-three-left-images">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/single-project.jpg" alt="Signle Project">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/single-project.jpg" alt="Signle Project">
                            </div>
                            <div class="section-three-right-images">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/single-project.jpg" alt="Signle Project">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ace-single-project-slider-item">
                    <div class="ace-single-slider-section-four section-four">
                        <div class="ace-single-section-two-content ace-container">
                            <div class="section-two-content">
                                <p>Our collaborative team of architects, interior designers, and technologists ensures every project is cohesive. We create efficient buildings and functional layouts informed by their context, all while shaping a unified vision for the future of architecture. Our collaborative team of architects, interior designers, and technologists ensures every project is cohesive. We create efficient buildings and functional layouts informed by their context, all while shaping a unified vision for the future of architecture.Our collaborative team of architects, interior designers, and technologists ensures every project is cohesive. We create efficient buildings and functional layouts informed by their context, all while shaping a unified vision for the future of architecture.</p>
                            </div>
                            <div class="section-two-image">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/single-project.jpg" alt="Signle Project">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ace-single-project-slider-item">
                    <div class="ace-single-slider-section-four section-four section-five">
                        <div class="ace-single-section-two-content ace-container">
                            <div class="section-two-content">
                                <p>Our collaborative team of architects, interior designers, and technologists ensures every project is cohesive. We create efficient buildings and functional layouts informed by their context, all while shaping a unified vision for the future of architecture. Our collaborative team of architects, interior designers, and technologists ensures every project is cohesive. We create efficient buildings and functional layouts informed by their context, all while shaping a unified vision for the future of architecture.Our collaborative team of architects, interior designers, and technologists ensures every project is cohesive. We create efficient buildings and functional layouts informed by their context, all while shaping a unified vision for the future of architecture.</p>
                            </div>
                            <div class="section-two-image">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/single-project.jpg" alt="Signle Project">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ace-single-project-slider-item">
                    <div class="ace-single-slider-section-final">
                        <div class="ace-single-section-final ace-container">
                            <div class="section-final-image">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/single-project.jpg" alt="Signle Project">
                            </div>
                            <div class="section-final-next-project-content">
                                <div class="next-project-wrapper">
                                    <a href="#" class="next-project-permalink">Next Project</a>
                                    <h2 class="next-project-title">Title for Next Project</h2>
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/single-project.jpg" alt="Next Project Image" class="next-project-features-image">
                                    <a href="/portfolio" class="back-to-project-view">Back to projects view</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<?php

// scrolling effect library
wp_enqueue_script('gsap');
wp_enqueue_script('scrollTrigger');
wp_enqueue_script('scrollSmoother');

get_footer();
