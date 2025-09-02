var $ = jQuery.noConflict();

jQuery(document).ready(function(){
    $(".ace-home-slider-container").slick({
        dots: true,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        arrows: false,
    });

    $(".career-post-item-wrapper .toggle-button").click(function(){
        $(this).parent().parent().toggleClass("open");
        let parent = $(this).parent().parent();
        if(parent.hasClass("open")){
            $(this).find(".toggle-button-text").text("Close Details");
        }else{
            $(this).find(".toggle-button-text").text("View Details");
        }
    });

    $('.ace-portfolio-slider-wrapper').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 3,
        arrows: false,
        slidesToScroll: 1,
        centerMode: false,
        centerPadding: '0px',
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
    
    $('.ace-portfolio-slider-wrapper').on('wheel', function(e) {
        e.preventDefault();
        if (e.originalEvent.deltaY < 0) {
            $(this).slick('slickPrev');
        } else {
            $(this).slick('slickNext');
        }
    });

    $('#view-switcher').on('change', function(){
        let view = $(this).val();
        if(view == 'grid-view'){
            $('.ace-portfolio-grid-items').show();
            $('.ace-portfolio-slider-items').hide();
            $('.ace-portfolio-slider-layout-wrapper').hide();
            $('.ace-portfolio-grid-layout-wrapper').show();
        }else{
            $('.ace-portfolio-grid-items').hide();
            $('.ace-portfolio-slider-items').show();
            $('.ace-portfolio-grid-layout-wrapper').hide();
            $('.ace-portfolio-slider-layout-wrapper').show();
            setTimeout(function(){
                $('.ace-portfolio-slider-wrapper').slick('setPosition');
            }, 100);
        }
    })

    // $('.ace-single-project-content-slider-wrapper').slick({
    //     dots: false,
    //     arrows: false,
    //     slidesToShow: 1,
    //     slidesToScroll: 1,
    //     infinite: false
    // })

    // $('.ace-single-project-content-slider-wrapper').on('wheel', function(e) {
    //     e.preventDefault();
    //     if (e.originalEvent.deltaY < 0) {
    //         $(this).slick('slickPrev');
    //     } else {
    //         $(this).slick('slickNext');
    //     }
    // });


    // $('.ace-single-project-content-slider-wrapper').on('wheel', function(e) {
    //     e.preventDefault(); // stop default vertical scroll
    
    //     let delta = e.originalEvent.deltaY;

    //     this.scrollLeft += delta;
    // });

    // $('.ace-single-project-content-slider-wrapper').on('wheel', function(e) {
    //     e.preventDefault();
    //     this.scrollLeft += e.originalEvent.deltaY * 3; // multiplier = scroll speed
    // });


    

        // // Initialize Smooth Scrollbar
        // const scrollbar = Scrollbar.init(document.querySelector('.ace-single-project-content-slider-wrapper'), {
        //     damping: 0.07,
        //     alwaysShowTracks: true,
        //     renderByPixels: true,
        //     continuousScrolling: true
        // });

        // // Convert vertical wheel to horizontal
        // scrollbar.addListener((status) => {
        //     // nothing needed here for basic horizontal scrolling
        // });

        // // Override default wheel behavior
        // scrollbar.track.x.element.remove(); // optional, hides horizontal track if needed

        // // Add custom wheel event
        // scrollbar.contentEl.addEventListener('wheel', (e) => {
        //     e.preventDefault(); // stop vertical scrolling

        //     // Apply vertical delta to horizontal scroll
        //     scrollbar.scrollLeft += e.deltaY;
        // });


    $("#project-type, #discipline").on('change', function(e){
        let projectType = $("#project-type").val();
        let discipline = $("#discipline").val();
    
        $.ajax({
            url: admin_ajax.wp_ajax_url,
            type: 'POST',
            data: {
                action: 'ace_portfolio_grid_and_slider_item',
                project_type: projectType,
                discipline: discipline
            },
            success: function(response){

                console.log(response);
    

                let $old_slider = $('.ace-portfolio-slider-wrapper');

                if(response.no_posts_found){
                    $('.ace-portfolio-grid-items').html('<p>No portfolio posts found</p>');
                    if($old_slider.hasClass('slick-initialized')){
                        $old_slider.slick('unslick'); 
                    }
                    $old_slider.empty().html('<p>No portfolio posts found</p>');
                    return;
                }
    
                // update grid
                if(response.data.grid_layout){
                    $('.ace-portfolio-grid-items').html(response.data.grid_layout);
                }

                if(response.data.slider_layout){
                    $old_slider.slick('unslick'); // Remove existing slider
                    $old_slider.html(response.data.slider_layout);
                    
                    // Reinitialize the slider with the new HTML content
                    $('.ace-portfolio-slider-wrapper').slick({
                        dots: false,
                        arrows: false,
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        infinite: false,
                        adaptiveHeight: true,
                        responsive: [
                            {
                                breakpoint: 1024,
                                settings: {
                                    slidesToShow: 2,
                                    slidesToScroll: 1
                                }
                            },
                            {
                                breakpoint: 768,
                                settings: {
                                    slidesToShow: 1,
                                    slidesToScroll: 1
                                }
                            }
                        ]
                    });


                }

            },
            error: function(error){
                console.log(error);
            }
        });
    });


});



// animations

document.addEventListener("DOMContentLoaded", (event) => {
    gsap.registerPlugin(ScrollTrigger,ScrollSmoother)
    // gsap code here!

    window.addEventListener('load', () => {
        ScrollSmoother.create({
            content: "#ace-scroll-content",
            wrapper: "#ace-scroll-wrapper",
            smooth: 1.2,
            effects: true,
            smoothTouch: 0.1,
        });
    });

    const cards = gsap.utils.toArray(".ace-single-project-slider-item");
    const cardsContainer = document.querySelector(".cards-container");

    gsap.set(cards[0], {opacity: 1});

    const totalScrollWidth = cardsContainer.scrollWidth - window.innerWidth + 50;
    
    const scrollTrack = gsap.to(cardsContainer, {
        x: -totalScrollWidth,
        ease: "none",
        duration: cards.length,
        scrollTrigger: {
            trigger: ".scroll-section",
            start: "top top",
            end: `+=${totalScrollWidth}`,
            scrub: true,
            pin: true,
        },
    });

    cards.forEach((card, index) => {
        gsap.to(card, {
            opacity: 1,
            scrollTrigger: {
                trigger: card,
                start: "left 95%",
                end: "center 95%",
                scrub: true,
                containerAnimation: scrollTrack,
            },
        })
    });
    

});
