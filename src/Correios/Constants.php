<?php

namespace GoldbachAlgorithms\AIG\Correios;

class Constants
{
    const SOURCE_NAME = "Correios";
    const BASE_URL = "https://buscacepinter.correios.com.br/app/endereco/carrega-cep-endereco.php";
    const HEADER = "Content-type: application/x-www-form-urlencoded; charset=UTF-8";
    const METHOD = "POST";
    const DATA = "dados";
    const ZIP_CODE = "cep";
    const STREET_SOURCE = "logradouroDNEC";
    const STREET = "logradouro";
    const COMPLEMENT = "complemento";
    const COMPLEMENT_SOURCE = "logradouroTextoAdicional";
    const NEIGHBORHOOD = "bairro";
    const CITY = "localidade";
    const STATE = "uf";
    const SOURCE = "fonte";
    const PAGE = "pagina";
    const PAGE_NAME = "/app/endereco/index.php";
    const ALL = "ALL";
    const SOURCE_TYPE = "tipoCEP";
    const ADDRESS = 'endereco';
}