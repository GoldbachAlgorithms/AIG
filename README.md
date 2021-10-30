# AIG - Address Info Getter

[<img src="https://badgen.net/badge/Powered%20by/Goldbach/yellow" />](https://github.com/Goldbach07/)
[<img src="https://badgen.net/badge/Developed%20for/Symfony/black" />](https://symfony.com/)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

Goldbach Algorithms Address Info Getter (fondly nicknamed AIG) is a PHP library developed for Symfony to collect address information.

## Installation

Use the composer to install:

```bash
composer require goldbach-algorithms/aig
```

## Usage
Create an AIG instance and look for the address indicating or not the source of access.

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
## Return
Look at an example of a JSON return displaying the source of the information.
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

Copyright © 2021 [Goldbach Algorithms](https://github.com/GoldbachAlgorithms/Mask/blob/main/LICENSE)
