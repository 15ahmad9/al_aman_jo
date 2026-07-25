<?php
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");

/*
 * Amman Stock Exchange data endpoint
 * This file returns a unified JSON format for the ticker.
 * Replace $resource_url with your licensed ASE live feed if available.
 */

$resource_url = "https://www.ase.com.jo/";

$stocks = [];

if (!empty($resource_url)) {
    $context = stream_context_create([
        "http" => ["timeout" => 5]
    ]);

    $response = @file_get_contents($resource_url, false, $context);

    if ($response !== false) {
        $json = json_decode($response, true);

        if (is_array($json)) {
            $stocks = $json;
        }
    }
}

/*
 * Fallback sample structure.
 * The ticker keeps working until a real ASE feed is connected.
 */
if (empty($stocks)) {
    $stocks = [
        [
            "symbol" => "ARBK",
            "name" => "البنك العربي",
            "price" => "5.40",
            "change" => "0.05",
            "percent" => "0.93"
        ],
        [
            "symbol" => "JTEL",
            "name" => "الاتصالات الأردنية",
            "price" => "1.85",
            "change" => "-0.02",
            "percent" => "-1.06"
        ],
        [
            "symbol" => "ABCO",
            "name" => "البنك الاستثماري",
            "price" => "2.10",
            "change" => "0.03",
            "percent" => "1.45"
        ]
    ];
}

echo json_encode($stocks, JSON_UNESCAPED_UNICODE);
?>
