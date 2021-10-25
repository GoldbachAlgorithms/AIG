# AIG

Goldbach Algorithms Address Info Getter (fondly nicknamed AIG) is a PHP library developed for Symfony to collect address information.

## Installation

Use the composer to install:

```bash
composer require goldbach-algorithms/aig
```

## Usage

```php
# Add use AIG
use GoldbachAlgorithms\AIG\AIG;

# create a new AIG
$aig = new AIG();

# get address by CEP
$aig->getAddressByCep('89566410');

# get address by cep using a specific source
$aig->getAddressByCep('89304258', AIG::SOURCE_CORREIOS);
$aig->getAddressByCep('89304258', AIG::SOURCE_VIACEP);
```
## Return Json
```JSON
{
  "zipCode": "89304258",
  "street": "Rua Pioneiro Arlindo Goldbach",
  "complement": "",
  "neighborhood": "Vila Nova",
  "city": "Mafra",
  "state": "SC",
  "source": "Correios"
}
```

## License
[MIT](https://choosealicense.com/licenses/mit/)