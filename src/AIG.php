<?php

namespace GoldbachAlgorithms\AIG;

use GoldbachAlgorithms\Mask\Mask;
use GoldbachAlgorithms\AIG\Correios\Correios;
use GoldbachAlgorithms\AIG\ViaCEP\ViaCEP;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Goldbach Algorithms
 *
 * A.I.G. - Address Info Getter
 */
class AIG
{
    public const ERRORS =
    [
        "CEP_EMPTY" => "É necessário fornecer o valor de 'cep'",
        "CEP_NOT_FOUND" => "Cep não encontrado!",
        "CEP_INVALID_API" => "API inválida",
        "INVALID_SOURCE" => "Fonte de busca inválida. (Tente ViaCep ou Correios)"
    ];

    public const SOURCE_VIACEP = 'VIACEP';
    public const SOURCE_CORREIOS = 'CORREIOS';


    public function getAddressByCep(
        string $cep,
        string $source = null
    ): JsonResponse {
        if (empty($cep)) {
            return new JsonResponse(
                [
                    'error' => self::ERRORS['CEP_EMPTY']
                ],
                Response::HTTP_BAD_REQUEST
            );
        }

        $cep = $this->format($cep);

        switch ($source) {
            case self::SOURCE_CORREIOS:
                return $this->byCorreios($cep);
                break;
            case self::SOURCE_VIACEP:
                return $this->byViaCep($cep);
                break;
            case null:
                return $this->main($cep);
                break;
            default:
                return new JsonResponse(
                    [
                        'error' => self::ERRORS['INVALID_SOURCE']
                    ],
                    Response::HTTP_BAD_REQUEST
                );
                break;
        }
    }

    public function main($cep)
    {
        $viaCEP = new ViaCEP();

        $return = $viaCEP
            ->findByZipCode($cep)
            ->toArray();

        if (is_null($return['zipCode'])) {
            $correios = new Correios();

            $return = $correios
                ->findByZipCode($cep)
                ->toArray();

            if (is_null($return['zipCode'])) {
                return new JsonResponse(
                    [
                        'error' => self::ERRORS['CEP_NOT_FOUND']
                    ],
                    Response::HTTP_NOT_FOUND
                );
            }
        }

        return new JsonResponse(
            $return,
            Response::HTTP_OK
        );
    }

    public function byViaCep($cep)
    {
        $viaCEP = new ViaCEP();

        $return = $viaCEP
            ->findByZipCode($cep)
            ->toArray();

        if (is_null($return['zipCode'])) {
            return new JsonResponse(
                [
                    'error' => self::ERRORS['CEP_NOT_FOUND']
                ],
                Response::HTTP_NOT_FOUND
            );
        }

        return new JsonResponse(
            $return,
            Response::HTTP_OK
        );
    }

    public function byCorreios($cep)
    {
        $correios = new Correios();

        $return = $correios
            ->findByZipCode($cep)
            ->toArray();

        if (is_null($return['zipCode'])) {
            return new JsonResponse(
                [
                    'error' => self::ERRORS['CEP_NOT_FOUND']
                ],
                Response::HTTP_NOT_FOUND
            );
        }

        return new JsonResponse(
            $return,
            Response::HTTP_OK
        );
    }

    public function format($cep)
    {
        $mask = new Mask();

        return $mask
            ->transform(Mask::CEP, $cep);
    }
}
