<?php

class Work_Shortcode
{
    static $add_script;

    static function init()
    {
        add_shortcode('work-reviews', array(__CLASS__, 'work_func'));
        add_action('init', array(__CLASS__, 'register_script'));
        add_action('wp_footer', array(__CLASS__, 'js_variables'));
        add_action('wp_footer', array(__CLASS__, 'print_script'));
    }

    static function work_func($atts)
    {
        self::$add_script = true;

        $html = "";

        global $post;

        $myposts = get_posts([
//            'numberposts' => 10,
            'orderby' => 'date',
            'order' => 'DESC',
            'post_type' => 'work_reviews'
        ]);

        if ($myposts) {
            $html = "<div id='work-reviews' class='work'>
            <div class='work__box'>
                <div class='work__container'>
                    <div class='work__title'>Отзывы о <span class='work__textcolor'>нашей работе</span></div>
                    <div class='work__holder swiper-container'>
                        <div class='work__btn-slider'>
                            <div class='work__slider-btn' id='work__slider--prev'>
                               <svg aria-hidden=\"true\" focusable=\"false\" data-prefix=\"fas\" data-icon=\"angle-left\" class=\"svg-inline--fa fa-angle-left fa-w-8\" role=\"img\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 256 512\"><path fill=\"currentColor\" d=\"M31.7 239l136-136c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9L127.9 256l96.4 96.4c9.4 9.4 9.4 24.6 0 33.9L201.7 409c-9.4 9.4-24.6 9.4-33.9 0l-136-136c-9.5-9.4-9.5-24.6-.1-34z\"></path></svg> 
                            </div>
                            <div class='work__slider-btn' id='work__slider--next'>
                                <svg aria-hidden=\"true\" focusable=\"false\" data-prefix=\"fas\" data-icon=\"angle-right\" class=\"svg-inline--fa fa-angle-right fa-w-8\" role=\"img\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 256 512\"><path fill=\"currentColor\" d=\"M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34z\"></path></svg>
                            </div>
                        </div>                         
                        <div class='work__slider swiper-wrapper'>";
            foreach ($myposts as $post) {
                setup_postdata($post);

                $title = get_the_title();
                $content = get_the_content();
                $content = apply_filters('the_content', $content);

                $html .= "
                        <div class='work__item swiper-slide'>
                            <div class='work__text'>
                            <svg aria-hidden=\"true\" focusable=\"false\" data-prefix=\"fas\" data-icon=\"quote-left\" class=\"svg-inline--fa fa-quote-left fa-w-16\" role=\"img\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 512 512\"><path fill=\"currentColor\" d=\"M464 256h-80v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8c-88.4 0-160 71.6-160 160v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48zm-288 0H96v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8C71.6 32 0 103.6 0 192v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48z\"></path></svg>                                                                
                                <span class='work__paragraph'>$content</span>
                            </div>
                            <div class='work__name'>$title</div>
                        </div>";
            }
            $html .= "                    
                    </div>                        
                    </div>
                    <div class='work__btn'>
                        <button type='button' class='btn btn--result hvr-pop' id='btnFeedback'>Оставьте свой отзыв</button>
                    </div>                    
                </div>                
            </div>
        </div>";

        }

        wp_reset_postdata();

        return $html;
    }

    static function register_script()
    {
        $url = plugin_dir_url(__FILE__);
        wp_register_style('swiper', plugin_dir_url(__FILE__) . 'swiper/swiper.min.css', array(), null, 'all');
        wp_register_style('work-css', plugin_dir_url(__FILE__) . 'assets/css/main.min.css', array(), time(), 'all');
        wp_register_script('swiper', plugin_dir_url(__FILE__) . 'swiper/swiper.min.js', array('jquery'), null, true);
        wp_register_script('work-js', plugin_dir_url(__FILE__) . 'assets/js/main.min.js', array('jquery'), time(), true);
    }

    static function print_script()
    {
        if (!self::$add_script) {
            return;
        }
        wp_enqueue_style('swiper');
        wp_enqueue_style('work-css');
        wp_print_scripts('swiper');
        wp_print_scripts('work-js');
    }

    static function js_variables()
    {
        if (!self::$add_script) {
            return;
        }

        /* $variables = array(
             'plugin_dir_url' => plugin_dir_url(__FILE__),
             'url_ajax' => admin_url('admin-ajax.php'),
             'nonce' => wp_create_nonce('myajax-nonce123')
         );
         echo('<script type="text/javascript">window.wp_data=' . json_encode($variables) . ';</script>');*/
    }
}
