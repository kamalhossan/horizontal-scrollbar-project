<?php

add_action('wp_enqueue_scripts', 'salient_child_enqueue_styles', 100);
function salient_child_enqueue_styles()
{
    $nectar_theme_version = nectar_get_theme_version();
    wp_enqueue_style('slick', get_stylesheet_directory_uri() . '/css/slick.css');
    wp_enqueue_style('salient-child-style', get_stylesheet_directory_uri() . '/style.css', '', $nectar_theme_version);
    wp_enqueue_style('font-abs', get_stylesheet_directory_uri() . '/fonts/abc/stylesheet.css', array(), $nectar_theme_version, 'all');
    if (is_rtl()) {
        wp_enqueue_style('salient-rtl',  get_template_directory_uri() . '/rtl.css', array(), '1', 'screen');
    }

    // scrolling effect library
    wp_register_script('gsap', 'https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/gsap.min.js', array(), null, true);
    wp_register_script('scrollTrigger', 'https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/ScrollTrigger.min.js', array(), null, true);
    wp_register_script('scrollSmoother', 'https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/ScrollSmoother.min.js', array(), null, true);


    wp_enqueue_script('slick', get_stylesheet_directory_uri() . '/js/slick.js', array('jquery'), true);
    wp_enqueue_script('custom-script', get_stylesheet_directory_uri() . '/js/custom-script.js', array('jquery'), true);

    $wp_ajx_array = array('wp_ajax_url' => admin_url('admin-ajax.php'));
    wp_localize_script('custom-script', 'admin_ajax', $wp_ajx_array); // localize ajax url in script


    

}

require_once(get_stylesheet_directory() . "/includes/custom-function.php");
require_once(get_stylesheet_directory() . "/includes/api-function.php");

//add SVG to allowed file uploads
add_action('upload_mimes', 'add_file_types_to_uploads');
function add_file_types_to_uploads($file_types)
{
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes);
    return $file_types;
}

add_filter("redux/salient_redux/field/typography/custom_fonts", "salient_redux_custom_fonts");
function salient_redux_custom_fonts()
{
    return array(
        'Custom Fonts' => array(
            'Rockness' => 'Rockness',
            'Product Sans' => 'Product Sans',
        )
    );
}

add_shortcode("ace_homepage_slider", "ace_homepage_slider_callback");
function ace_homepage_slider_callback()
{
    ob_start();
    ?>
    <div class="ace-home-slider-wrapper">
        <div class="ace-home-slider-container">
            <div class="ace-home-slider-item">
                <div class="ace-home-slider-item-container" style="background-image: url(<?php echo get_stylesheet_directory_uri() ?>/images/slider-bg.png);">
                    <div class="ace-home-slider-content">
                    <div class="project-highlight">
                            <h2 class="slider-title">We design the
                            places where people
                            love to be together.
                            </h2>
                        </div>
                        <div class="project-meta">
                            <h4 class="ace-slider-title">
                                Project name title
                            </h4>
                            <a href="#" class="project-link">View Project</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ace-home-slider-item">
                <div class="ace-home-slider-item-container" style="background-image: url(<?php echo get_stylesheet_directory_uri() ?>/images/slider-bg.png);">
                    <div class="ace-home-slider-content">
                    <div class="project-highlight">
                            <h2 class="slider-title">We design the
                            places where people
                            love to be together.
                            </h2>
                        </div>
                        <div class="project-meta">
                            <h4 class="ace-slider-title">
                                Project name title
                            </h4>
                            <a href="#" class="project-link">View Project</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ace-home-slider-item">
                <div class="ace-home-slider-item-container" style="background-image: url(<?php echo get_stylesheet_directory_uri() ?>/images/slider-bg.png);">
                    <div class="ace-home-slider-content">
                    <div class="project-highlight">
                            <h2 class="slider-title">We design the
                            places where people
                            love to be together.
                            </h2>
                        </div>
                        <div class="project-meta">
                            <h4 class="ace-slider-title">
                                Project name title
                            </h4>
                            <a href="#" class="project-link">View Project</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

// register ace career post type

add_action("init", "ace_studio_post_type");

function ace_studio_post_type() {

    /**
     * Career Post Type
     */
    register_post_type("career", array(
        "labels" => array(
            "name"          => "Careers",
            "singular_name" => "Career",
            "menu_name"     => "Careers",
            "add_new"       => "Add New Position",
            "add_new_item"  => "Add New Position",
            "edit_item"     => "Edit Career",
            "new_item"      => "New Position",
            "view_item"     => "View Position",
        ),
        "public"      => true,
        "supports"    => array("title", "thumbnail"),
        "has_archive" => false,
        "menu_icon"   => "dashicons-admin-users",
        "show_in_rest"=> true,
    ));


    /**
     * Portfolio Post Type
     */
    register_post_type("portfolio", array(
        "labels" => array(
            "name"          => "Portfolios",
            "singular_name" => "Portfolio",
            "menu_name"     => "Portfolios",
            "add_new"       => "Add New Project",
            "add_new_item"  => "Add New Project",
            "edit_item"     => "Edit Project",
            "new_item"      => "New Project",
            "view_item"     => "View Project",
        ),
        "supports"    => array("title", "thumbnail"),
        "menu_icon"   => "dashicons-portfolio",
        "has_archive" => false,
        "public"      => true,
        // "show_in_rest"=> true, 
        "taxonomies"  => array("project_type", "disciplines"), 
    ));


    /**
     * Project Types Taxonomy
     */
    register_taxonomy("project_type", "portfolio", array(
        "labels" => array(
            "name"          => "Project Types",
            "singular_name" => "Project Type",
            "menu_name"     => "Project Types",
            "add_new_item"  => "Add New Project Type",
            "new_item_name" => "New Project Type",
            "parent_item"   => "Parent Project Type",
            "parent_item_colon" => "Parent Project Type:",
            "search_items" => "Search Project Types",
            "all_items" => "All Project Types",
            "edit_item" => "Edit Project Type",
        ),
        "public"       => true,
        "show_ui"      => true,
        "show_in_rest" => true,
        "hierarchical" => true, // behaves like categories
    ));


    /**
     * Disciplines Taxonomy
     */
    register_taxonomy("disciplines", "portfolio", array(
        "labels" => array(
            "name"          => "Disciplines",
            "singular_name" => "Discipline",
            "menu_name"     => "Disciplines",
            "add_new_item"  => "Add New Discipline",
            "new_item_name" => "New Discipline",
            "parent_item"   => "Parent Discipline",
            "parent_item_colon" => "Parent Discipline:",
            "search_items" => "Search Disciplines",
            "all_items" => "All Disciplines",
            "edit_item" => "Edit Discipline",
        ),
        "public"       => true,
        "show_ui"      => true,
        "show_in_rest" => true,
        "hierarchical" => true, // behaves like tags
    ));

    /**
     * Ensure default Category/Tag taxonomies are removed
     */
    unregister_taxonomy_for_object_type("category", "portfolio");
    unregister_taxonomy_for_object_type("project-type", "portfolio");
    unregister_taxonomy_for_object_type("project-attributes", "portfolio");
    unregister_taxonomy_for_object_type("post_tag", "portfolio");
}



add_shortcode("ace_careers_post_list", "ace_careers_post_list_callback");
function ace_careers_post_list_callback()
{
    ob_start();

    $args = array(
        'post_type' => 'career',
        'posts_per_page' => -1,
    );

    $query = new WP_Query($args);

    $count = 0;
 
    if($query->have_posts()){
        echo '<div class="ace-careers-position-list-wrapper">';
        while($query->have_posts()){
            $query->the_post();
            $position = get_field('position');
            $objective = get_field('objective');
            $qualifications = get_field('qualifications');
            $email = get_field('hm_email');
            $count++;
        ?>
        <div class="career-post-item-wrapper <?php echo $count == 1 ? 'open' : ' '; ?>">
            <div class="career-post-item-header">
                <h2 class="position-title"><?php the_title(); ?></h2>
                <h4 class="position"><?php echo $position; ?></h4>
                <a class="toggle-button">
                   <span class="toggle-button-text"><?php echo $count == 1 ? 'Close Details' : 'View Details'; ?></span>
                    <img src="<?php echo get_stylesheet_directory_uri() ?>/images/arrow-down.png" alt="" class="arrow-icon">
                </a>
            </div>
            <div class="career-post-item-content">
                <div class="career-post-item-description">
                    <div class="jobs-description objective">
                        <h3>Who we are looking for;</h3>
                        <div class="jobs-description-content"><?php echo $objective; ?></div>
                    </div>
                    <div class="jobs-description qualifications">
                        <h3>Essential Qualifications:</h3>
                        <div class="jobs-description-content"><?php echo $qualifications; ?></div>
                    </div>
                    <div class="jobs-description apply-details">
                        <h3>Apply by sending your cover letter and portfolio to:</h3>
                        <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
                    </div>
                </div>
            </div>
            </div>
        <?php
        }
        echo '</div>';
    } else {
        echo '<div class="no-career-post">No career post found</div>';
    }
   
    ?>
    <?php
    return ob_get_clean();
}

add_shortcode("ace_projects_with_category_details", "ace_projects_with_category_details_callback");

function ace_projects_with_category_details_callback($atts){
    ob_start();

    ?>
    <div class="ace-projects-with-category-details-wrapper">
    <?php 
    for($i = 0; $i < 4; $i++){
        ?>
        <div class="ace-projects-category-item-wrapper">
            <div class="ace-project-category-details">
                <div class="ace-projects-category-details-content">
                    <div class="ace-project-category-title">
                        <h2 class="category-title">Architectural Design</h2>
                    </div>
                    <div class="ace-project-category-description">
                        <div class="category-description">
                            <p>At BAT, we understand that the success of any project begins with a solid strategy. Our consultancy services provide you with expert guidance, helping you define your vision, set realistic goals, and the tools to help you navigate the complexities of your project. Whether you need advice on zoning regulations, budgeting, or project feasibility, we are here to assist you at every step of the way. We firmly believe that design has a major impact on our society, the values of ethical and sustainable responsibility and social commitment. We put innovation at the service of social prosperity and progress.</p>
                        </div>
                        <a href="#" class="view-category-projects">View Architectural design projects</a>
                    </div>
                </div>
            </div>
            <div class="ace-category-projects-items-wrapper">
                <div class="ace-cateogry-projects-item-container">
                    <div class="ace-project-item">
                        <img src="<?php echo get_stylesheet_directory_uri() ?>/images/project-1.jpg" alt="">
                        <h4 class="project-title">Project Title Name - Residential</h4>
                        <a href="#" class="project-url"></a>
                    </div>
                </div>
                <div class="ace-cateogry-projects-item-container">
                    <div class="ace-project-item">
                        <img src="<?php echo get_stylesheet_directory_uri() ?>/images/project-2.jpg" alt="">
                        <h4 class="project-title">Project Title Name - Residential</h4>
                        <a href="#" class="project-url"></a>
                    </div>
                </div>
                <div class="ace-cateogry-projects-item-container">
                    <div class="ace-project-item">
                        <img src="<?php echo get_stylesheet_directory_uri() ?>/images/project-3.jpg" alt="">
                        <h4 class="project-title">Project Title Name - Residential</h4>
                        <a href="#" class="project-url"></a>
                    </div>
                </div>
                <div class="ace-cateogry-projects-item-container">
                    <div class="ace-project-item">
                        <img src="<?php echo get_stylesheet_directory_uri() ?>/images/project-4.jpg" alt="">
                        <h4 class="project-title">Project Title Name - Residential</h4>
                        <a href="#" class="project-url"></a>
                    </div>
                </div>
            </div>
        </div>
        <?php 
        }
        ?>
    </div>

    <?php

    return ob_get_clean();
}

function ace_portfolio_grid_item($post_id = 0, $slider_layout = false){

    $post_title = get_the_title($post_id);
    $post_thumbnail = get_the_post_thumbnail_url($post_id);
    $post_type = get_the_terms($post_id, 'project_type')[0]->name;
    $post_permalink = get_the_permalink($post_id);
    ?>
        <div class="ace-portfolio-grid-item <?php echo $slider_layout == true ? 'slide' : ''; ?>">
            <img src="<?php echo $post_thumbnail; ?>" alt="">
            <div class="ace-portfolio-grid-item-content">
                <h2 class="title"><?php echo $post_title; ?></h2>
                <div class="meta">
                    <span class="category"><?php echo $post_type; ?></span>
                </div>
            </div>
            <a href="<?php echo $post_permalink; ?>" class="portfolio-hyperlink"></a>
        </div>
    <?php
}


add_action('wp_ajax_ace_portfolio_grid_and_slider_item', 'ace_portfolio_grid_and_slider_item_callback');
add_action('wp_ajax_nopriv_ace_portfolio_grid_and_slider_item', 'ace_portfolio_grid_and_slider_item_callback');

function ace_portfolio_grid_and_slider_item_callback(){
    $project_type = $_POST['project_type'];
    $discipline = $_POST['discipline'];

    $args = array(
        'post_type' => 'portfolio',
        'posts_per_page' => -1,
    );

    if($project_type && $project_type !== 'all-project-types'){
        $args['tax_query'][] = array(
            'taxonomy' => 'project_type',
            'field' => 'slug',
            'terms' => $project_type
        );
    }
    if($discipline && $discipline !== 'all-disciplines'){
        $args['tax_query'][] = array(
            'taxonomy' => 'disciplines',
            'field' => 'slug',
            'terms' => $discipline
        );
    }

    $query = new WP_Query($args);

    $no_posts_found = !$query->have_posts(); // ✅ check right away
    
    // Grid layout
    ob_start();
    if(!$no_posts_found){
        while($query->have_posts()){
            $query->the_post();
            ace_portfolio_grid_item(get_the_ID(), false);
        }
    }
    $grid_layout = ob_get_clean();
    
    // Slider layout
    $query->rewind_posts();
    ob_start();
    if(!$no_posts_found){
        while($query->have_posts()){
            $query->the_post();
            ace_portfolio_grid_item(get_the_ID(), true);
        }
    }
    $slider_layout = ob_get_clean();
    
    wp_reset_postdata();
    
    $response = array(
        'no_posts_found' => $no_posts_found,
        'data' => array(
            'grid_layout'   => $grid_layout,
            'slider_layout' => $slider_layout
        )
    );
    
    wp_send_json($response);
    
}
