<?php

namespace App\Http\Controllers;

use App\Events\PlateNumberDetectedEvent;
use App\Models\Camera;
use App\Models\Pos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;

class AnprController extends Controller
{
    public function index(Request $request)
    {
        try {
            $xmlString = $request->file('anpr_xml')->getContent();
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            return response('Input error', 400);
        }

        $xml = simplexml_load_string($xmlString);
        $json = json_encode($xml);
        // Log::info($json);
        $jsonObject = json_decode($json);
        $licensePlate = $jsonObject->ANPR->licensePlate;
        // Log::info('Plat nomor terdeteksi: ' . $licensePlate);
        // kirim ke express : ip & plat nomor
        $data = ['licensePlate' => $licensePlate, 'ip' => $request->ip()];

        $client = new Client(['timeout' => 1]);

        try {
            $client->request('GET', 'http://localhost:3000/anpr', ['query' => $data]);
        } catch (\Throwable $th) {
            // Nothing todo
        }


        return response($data);
    }
}
