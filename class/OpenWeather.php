<?php
class OpenWeather{

    private $apikey;

    public function __construct(string $apikey)
    {
        $this->apikey = $apikey;
    }

    public function getForecast(string $city): ?array
    {
        $curl = curl_init("http://api.openweathermap.org/data/2.5/forecast/?q={$city}&appid={$this->apikey}&units=metric&lang=fr");
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CAINFO => dirname(__DIR__) . DIRECTORY_SEPARATOR . 'cert.cer',
            CURLOPT_TIMEOUT => 20
        ]);
        $data = curl_exec($curl);
        if($data === false || curl_getinfo($curl, CURLINFO_HTTP_CODE) !== 200){
            return null;
        }
        $results = [];
        $data = json_encode($data, true);
        foreach($data["list"] as $day){
            $results[] = [
                'temp' => $day['temp']['day'],
                'description' => $day['weather'][0]['description'],
                'date' => new DateTime('@' . $day['dt'])
            ];
        }
        return $results;
    }
}