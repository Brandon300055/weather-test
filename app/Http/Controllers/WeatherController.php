<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WeatherController extends Controller
{
    /**
     * Returns the clients zip code.
     *
     * @return string
     */
    protected function getUserZipCode() : string
    {
        $query = @unserialize (file_get_contents('http://ip-api.com/php/'));
        if ($query && $query['status'] == 'success') {
            return $query['zip'];
        }

        // return default case
        return "10065";
    }


    /**
     * Returns the weather data from the API.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getWeatherData(Request $request) //: JsonResponse
    {
        $request->validate([
            'zip' => '|max:5|string',
        ]);

        // Get the zip code
        $zip = ( $request->zip) ? $request->zip : $this->getUserZipCode();

        // Construct the url
        $url = "https://api.openweathermap.org/data/2.5/weather?zip=".$zip."&appid=" . env('OPEN_WEATHER_KEY');

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_FAILONERROR, true);
        // Required for HTTP error codes to be reported via our call to curl_error($curl)
        curl_exec($curl);

        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
        }

        // handle cURL error
        if (isset($error_msg)) {
            return response()->json(["Zip code not found"], 401);
        }
        curl_close($curl);
    }

}
