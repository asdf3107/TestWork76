<?


// Добавляем метабокс
function cities_add_meta_box() {
    add_meta_box(
        'cities_location_meta',
        'Location Data',
        'cities_meta_box_callback',
        'cities',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'cities_add_meta_box');

// Поля для метабокса
function cities_meta_box_callback($post) {
    $latitude = get_post_meta($post->ID, '_city_latitude', true);
    $longitude = get_post_meta($post->ID, '_city_longitude', true);
    wp_nonce_field('save_city_location', 'city_location_nonce');
    
    echo '<label for="city_latitude">Latitude:</label>';
    echo '<input type="text" id="city_latitude" name="city_latitude" value="' . esc_attr($latitude) . '" size="25" />';
    
    echo '<br><br><label for="city_longitude">Longitude:</label>';
    echo '<input type="text" id="city_longitude" name="city_longitude" value="' . esc_attr($longitude) . '" size="25" />';
}

// Сохранение полей
function cities_save_meta_box($post_id) {
    if (!isset($_POST['city_location_nonce']) || !wp_verify_nonce($_POST['city_location_nonce'], 'save_city_location')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (isset($_POST['city_latitude'])) {
        update_post_meta($post_id, '_city_latitude', sanitize_text_field($_POST['city_latitude']));
    }
    if (isset($_POST['city_longitude'])) {
        update_post_meta($post_id, '_city_longitude', sanitize_text_field($_POST['city_longitude']));
    }
}
add_action('save_post', 'cities_save_meta_box');