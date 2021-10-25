<?php

namespace GoldbachAlgorithms\AIG\Correios;

class Constants
{
    public const SOURCE_NAME = "Correios";
    public const BASE_URL = "https://buscacepinter.correios.com.br/app/endereco/carrega-cep-endereco.php";
    public const HEADER = "Content-type: application/x-www-form-urlencoded; charset=UTF-8";
    public const METHOD = "POST";
    public const DATA = "dados";
    public const ZIP_CODE = "cep";
    public const STREET_SOURCE = "logradouroDNEC";
    public const STREET = "logradouro";
    public const COMPLEMENT = "complemento";
    public const COMPLEMENT_SOURCE = "logradouroTextoAdicional";
    public const NEIGHBORHOOD = "bairro";
    public const CITY = "localidade";
    public const STATE = "uf";
    public const SOURCE = "fonte";
    public const PAGE = "pagina";
    public const PAGE_NAME = "/app/endereco/index.php";
    public const ALL = "ALL";
    public const SOURCE_TYPE = "tipoCEP";
    public const ADDRESS = 'endereco';
}
