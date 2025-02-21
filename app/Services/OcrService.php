<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class OcrService
{
    public function procesar_ine(Request $request)
    {
        $api_url = 'http://127.0.0.1:8080/api/process'; // URL del endpoint
        $base64File = $request->input('ine');

        // Crear el array de datos
        $postData = [
            'processParam' => [
                'scenario' => 'FullProcess'
            ],
            'List' => [
                [
                    'ImageData' => [
                        'image' => $base64File
                    ]
                ]
            ]
        ];

        // Inicializar el cliente Guzzle
        $client = new Client();

        try {
            // Realizar la solicitud POST usando Guzzle
            $response = $client->post($api_url, [
                'json' => $postData,
                'headers' => [
                    'Content-Type' => 'application/json'
                ]
            ]);

            // Obtener el cuerpo de la respuesta
            $responseBody = $response->getBody()->getContents();

            // Decodificar la respuesta JSON
            $decodedResponse = json_decode($responseBody, true);

            // Manejar la respuesta
            $data = $decodedResponse ? $decodedResponse : ['code' => 500, 'msg' => 'Error decoding the response.'];

            if (json_last_error() === JSON_ERROR_NONE) {
                // Procesar los campos necesarios
                $pArrayFields = $data['ContainerList']['List'][3]['DocVisualExtendedInfo']['pArrayFields'];

                $ocr_result = [];

                foreach ($pArrayFields as $field) {
                    if ($field['FieldName'] === 'Address') {
                        $ocr_result['address'] = $field['Buf_Text'];
                    }
                    if ($field['FieldName'] === 'Section') {
                        $ocr_result['section'] = $field['Buf_Text'];
                    }
                    if ($field['FieldName'] === 'Surname And Given Names') {
                        $ocr_result['name'] = $field['Buf_Text'];
                    }
                    if ($field['FieldName'] === 'Surname') {
                        $ocr_result['surname'] = $field['Buf_Text'];
                    }
                    if ($field['FieldName'] === 'Second Surname') {
                        $ocr_result['second_surname'] = $field['Buf_Text'];
                    }
                    if ($field['FieldName'] === 'Given Names') {
                        $ocr_result['given_names'] = $field['Buf_Text'];
                    }
                    if ($field['FieldName'] === 'Voter Key') {
                        $ocr_result['voter_key'] = $field['Buf_Text'];
                    }
                    if ($field['FieldName'] === 'Personal Number') {
                        $ocr_result['personal_number'] = $field['Buf_Text'];
                    }
                    if ($field['FieldName'] === 'Address Municipality') {
                        $ocr_result['address_municipality'] = $field['Buf_Text'];
                    }
                    if ($field['FieldName'] === 'Sex') {
                        $ocr_result['sex'] = $field['Buf_Text'];
                    }
                    if ($field['FieldName'] === 'Date of Birth') {
                        $ocr_result['date_of_birth'] = $field['Buf_Text'];
                    }
                    if ($field['FieldName'] === 'Date of Expiry') {
                        $ocr_result['date_of_expiry'] = $field['Buf_Text'];
                    }
                    if ($field['FieldName'] === 'Date of Issue') {
                        $ocr_result['date_of_issue'] = $field['Buf_Text'];
                    }
                    if ($field['FieldName'] === 'Date of Registration') {
                        $ocr_result['date_of_registration'] = $field['Buf_Text'];
                    }
                }

                $pArrayFields = $data['ContainerList']['List'][4]['DocGraphicsInfo']['pArrayFields'];

                foreach ($pArrayFields as $field) {
                    if ($field['FieldName'] === 'Portrait') {
                        $ocr_result['portrait_imageDataUrl'] = 'data:image/' . str_replace('.', '', $field['image']['format']) . ';base64,' . $field['image']['image'];
                    }
                    if ($field['FieldName'] === 'Ghost portrait') {
                        $ocr_result['ghost_imageDataUrl'] = 'data:image/' . str_replace('.', '', $field['image']['format']) . ';base64,' . $field['image']['image'];
                    }
                    if ($field['FieldName'] === 'Signature') {
                        $ocr_result['signature_imageDataUrl'] = 'data:image/' . str_replace('.', '', $field['image']['format']) . ';base64,' . $field['image']['image'];
                    }
                }

                return $ocr_result;
            }
        } catch (\Exception $e) {
            return ['code' => 500, 'msg' => "Guzzle Error: " . $e->getMessage()];
        }
    }
}
