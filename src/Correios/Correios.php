<?php

namespace GoldbachAlgorithms\AIG\Correios;

use GoldbachAlgorithms\AIG\Address;
use GoldbachAlgorithms\AIG\Correios\Constants;

class Correios
{
    public function findByZipCode(string $cep): Address
    {
        $response = $this->request($cep);

        if (array_key_exists(0, $response[Constants::DATA])) {
            $attributes = $this->transform($response);

            return new Address($attributes);
        }

        return new Address();
    }

    public function getPostData(string $cep): string
    {
        return http_build_query(
            [
                Constants::PAGE => Constants::PAGE_NAME,
                Constants::ADDRESS => $cep,
                Constants::SOURCE_TYPE => Constants::ALL,
            ]
        );
    }

    public function request(string $cep): array
    {
        $httpOptions = [
            "http" => [
                "method" => Constants::METHOD,
                "header" => Constants::HEADER,
                'content' => $this->getPostData($cep)
            ]
        ];

        $streamContext = stream_context_create($httpOptions);
        $data = file_get_contents(Constants::BASE_URL, false, $streamContext);
        $json = json_decode($data, true);

        return $json;
    }

    public function transform(array $response): array
    {
        $dataAttr = $response[Constants::DATA][0];

        $attributes = [
            Constants::ZIP_CODE => $dataAttr[Constants::ZIP_CODE],
            Constants::STREET => $dataAttr[Constants::STREET_SOURCE],
            Constants::COMPLEMENT => $dataAttr[Constants::COMPLEMENT_SOURCE],
            Constants::NEIGHBORHOOD => $dataAttr[Constants::NEIGHBORHOOD],
            Constants::CITY => $dataAttr[Constants::CITY],
            Constants::STATE => $dataAttr[Constants::STATE],
            Constants::SOURCE => Constants::SOURCE_NAME
        ];

        return $attributes;
    }
}
