<?php
function cptui_register_my_cpts_work_reviews()
{
    $labels = array(
        "name" => __("Отзывы", "polclean"),
        "singular_name" => __("Отзыв", "polclean"),
        "menu_name" => __("Отзывы", "polclean"),
        "all_items" => __("Все отзывы", "polclean"),
        "add_new" => __("Добавить отзыв", "polclean"),
        "add_new_item" => __("Добавить новый отзыв", "polclean"),
        "edit_item" => __("Редактировать отзыв", "polclean"),
        "new_item" => __("Новый отзыв", "polclean"),
        "view_item" => __("Просмотр отзыва", "polclean"),
        "view_items" => __("Просмотр отзывов", "polclean"),
        "search_items" => __("Поиск отзыва", "polclean"),
        "not_found" => __("Не найден отзыв", "polclean"),
        "not_found_in_trash" => __("Не найден отзыв в корзине", "polclean"),
        "archives" => __("Архивы", "polclean"),
    );

    $args = array(
        "label" => __("Отзывы", "polclean"),
        "labels" => $labels,
        "description" => "Отзывы о нашей работе",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "delete_with_user" => false,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => false,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array("slug" => "work_reviews", "with_front" => true),
        "query_var" => true,
        "menu_icon" => "dashicons-admin-comments",
        "supports" => array("title", "editor"),
    );

    register_post_type("work_reviews", $args);
}

add_action('init', 'cptui_register_my_cpts_work_reviews');


