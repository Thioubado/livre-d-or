<?php
$curl = curl_init('https://samples.openweathermap.org/data/2.5/weather?q=Montpellier,fr&appid=fcf880fc534b21590eaf80b614e67197');
curl_setopt_array($curl, [
    CURLOPT_CAINFO => __DIR__ . DIRECTORY_SEPARATOR . 'cert.cer',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 20
]);
// la fonction curl_setpot_array peut remplacer les deux lignes de code en-dessous
/*
curl_setopt($curl, CURLOPT_CAINFO, __DIR__ . DIRECTORY_SEPARATOR . 'cert.cer');
curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);*/
$data = curl_exec($curl);
if($data === false){
    var_dump(curl_error($curl));
}else{
    if(curl_getinfo($curl, CURLINFO_HTTP_CODE) === 200){
    $data = json_decode($data, true);
    echo 'Il fait ' .$data['main']['temp'] . ' °C';
    }
}
curl_close($curl);