<?php
function megamenu_override_default_theme($value) {
    // change 'primary' to your menu location ID
    if (!isset($value['mega_menu']['theme'])) {
        $value['mega_menu']['theme'] = 'my_custom_theme_key'; // change kharidpack to the ID of your exported theme
    }

    return $value;
}
add_filter('default_option_megamenu_settings', 'megamenu_override_default_theme');
