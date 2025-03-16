<?

class Cities_Weather_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct('cities_weather_widget', 'City Weather Widget');
    }

    public function widget($args, $instance) {
// exit(var_dump($args));
        $city_id = $instance['city'];
        $city_name = get_the_title($city_id);
        $latitude = get_post_meta($city_id, '_city_latitude', true);
        $longitude = get_post_meta($city_id, '_city_longitude', true);
        
        // API OpenWeatherMap
        $api_key = defined('OPENWEATHER_API_KEY') ? OPENWEATHER_API_KEY : '';
        $api_url = "https://api.openweathermap.org/data/2.5/weather?lat={$latitude}&lon={$longitude}&units=metric&appid={$api_key}";
        
        $response = wp_remote_get($api_url);
        $weather_data = json_decode(wp_remote_retrieve_body($response));

        if (!empty($weather_data)) {
            $temperature = $weather_data->main->temp . '°C';
            echo "<p><strong>{$city_name}</strong>: {$temperature}</p>";
        }
    }

    public function form($instance) {
        $cities = get_posts(['post_type' => 'cities', 'numberposts' => -1]);
        $selected_city = !empty($instance['city']) ? $instance['city'] : '';

        echo '<label for="' . esc_attr($this->get_field_id('city')) . '">Выберите город:</label>';
        echo '<select name="' . esc_attr($this->get_field_name('city')) . '" id="' . esc_attr($this->get_field_id('city')) . '">';
        foreach ($cities as $city) {
            echo '<option value="' . $city->ID . '" ' . selected($selected_city, $city->ID, false) . '>' . esc_html($city->post_title) . '</option>';
        }
        echo '</select>';
    }

    public function update($new_instance, $old_instance) {
        $instance = [];
        $instance['city'] = !empty($new_instance['city']) ? strip_tags($new_instance['city']) : '';
        return $instance;
    }
}
function register_cities_weather_widget() {
    register_widget('Cities_Weather_Widget');
}
add_action('widgets_init', 'register_cities_weather_widget');