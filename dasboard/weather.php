<?php
$apiKey = "ed74b9f8b107607666e6e7a849dc41c8";

$lat = $_GET['lat'] ; // default Jakarta
$lon = $_GET['lon'] ;

$url = "https://api.openweathermap.org/data/2.5/weather?lat=$lat&lon=$lon&appid=$apiKey&units=metric";
$response = file_get_contents($url);
$data = json_decode($response, true);

echo json_encode([
  "temp" => round($data['main']['temp']),
  "feels_like" => round($data['main']['feels_like']),
  "humidity" => $data['main']['humidity'],
  "wind" => $data['wind']['speed'],
  "weather" => ucwords($data['weather'][0]['description']),
  "location" => $data['name']
]);
?>
