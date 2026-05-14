<?php
/**
 * SMART MUSEUM CONTROLLER
 * Developer: Edward Piris
 */

// 1. Konfigurasi User & Museum
$user_name   = "Edward Piris";
$museum_name = "Majapahit National Museum";

// 2. Konfigurasi Bluetooth (ESP32)
$service_uuid        = "4fafc201-1fb5-459e-8fcc-c5c9c331914b";
$characteristic_uuid = "beb5483e-36e1-4688-b7f5-ea07361b26a8";

// 3. Konfigurasi Endpoint API
$api_url = "api.php";

// Load Tampilan
include 'layout.php';
?>