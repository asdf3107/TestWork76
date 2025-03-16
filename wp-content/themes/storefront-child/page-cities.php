<?
/*
Template Name: Cities Table
*/


get_header();

// Подключение глобальной переменной $wpdb
global $wpdb;
$api_key = defined('OPENWEATHER_API_KEY') ? OPENWEATHER_API_KEY : '';

// Получаем города с привязанными странами
$cities = $wpdb->get_results("
    SELECT p.ID, p.post_title AS city_name, t.name AS country_name, pm1.meta_value AS latitude, pm2.meta_value AS longitude
    FROM {$wpdb->posts} p
    LEFT JOIN {$wpdb->term_relationships} tr ON (p.ID = tr.object_id)
    LEFT JOIN {$wpdb->term_taxonomy} tt ON (tr.term_taxonomy_id = tt.term_taxonomy_id AND tt.taxonomy = 'countries')
    LEFT JOIN {$wpdb->terms} t ON (tt.term_id = t.term_id)
    LEFT JOIN {$wpdb->postmeta} pm1 ON (p.ID = pm1.post_id AND pm1.meta_key = '_city_latitude')
    LEFT JOIN {$wpdb->postmeta} pm2 ON (p.ID = pm2.post_id AND pm2.meta_key = '_city_longitude')
    WHERE p.post_type = 'cities' AND p.post_status = 'publish'
");

// exit(var_dump($cities));


?>
<? do_action('before_cities_table'); // Кастомный хук ?>
<div class="container">
    <h2>Список стран, городов и температуры</h2>
    
    <input type="text" id="citySearch" placeholder="Введите город..." onkeyup="searchCity()">

    <table id="citiesTable" border="1">
        <thead>
            <tr>
                <th>Страна</th>
                <th>Город</th>
                <th>Температура (°C)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cities as $city): ?>
                <?php
                // Формируем запрос к OpenWeatherMap
                $weather_url = "https://api.openweathermap.org/data/2.5/weather?lat={$city->latitude}&lon={$city->longitude}&appid={$api_key}&units=metric";
                $weather_response = wp_remote_get($weather_url);
                // Декодируем JSON-ответ
                $weather_data = json_decode(wp_remote_retrieve_body($weather_response), true);
                $temperature = isset($weather_data['main']['temp']) ? $weather_data['main']['temp'] : 'N/A';
                ?>
                
                <tr>
                    <td><?php echo esc_html($city->country_name); ?></td>
                    <td><?php echo esc_html($city->city_name); ?></td>
                    <td><?php echo esc_html($temperature); ?> °C</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php do_action('after_cities_table'); // Кастомный хук ?>

<script>
function searchCity() {
    let input = document.getElementById("citySearch").value.toLowerCase();
    let rows = document.querySelectorAll("#citiesTable tbody tr");

    rows.forEach(row => {
        let city = row.cells[1].textContent.toLowerCase();
        if (city.includes(input)) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
}
</script>

<style>
.container {
    width: 80%;
    margin: 20px auto;
}
table {
    width: 100%;
    border-collapse: collapse;
}
th, td {
    padding: 10px;
    text-align: left;
    border: 1px solid #ccc;
}
input {
    margin-bottom: 10px;
    padding: 5px;
    width: 100%;
}
</style>

<?php get_footer(); ?>