<?php

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://transfermarket.p.rapidapi.com/matches/get-game-information?id=3368&domain=es",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"x-rapidapi-host: transfermarket.p.rapidapi.com",
		"x-rapidapi-key: bbfe6e3f32msh08adf6704935149p1075f8jsn0fa22b3adf89"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}