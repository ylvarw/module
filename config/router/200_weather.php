<?php
/**
 * Load the Ylvan/controller for Weather
 */

return [

    // All routes in order
    "routes" => [
        [
            "info" => "check weather by ip location or position.",
            "mount" => "weather",
            // "mount" => "weather/weather",
            "handler" => "\Ylvan\Controller\WeatherController",
        ],
    ]
];
