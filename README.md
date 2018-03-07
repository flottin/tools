# Tools
A set of usefull tools for php

## Installation

composer require flottin/tools:dev-master -vvv

## Runing tests

```bash
# remove your composer.lock
rm composer.lock

# add php unit. you need phpunit install and added to path
composer require phpunit/phpunit:^5

# run the tests
vendor\bin\phpunit.bat --bootstrap vendor/autoload.php --testdox vendor\excel\find\tests\

#  generate code coverage report
./vendor/bin/phpunit --bootstrap vendor/autoload.php  tests --coverage-html code-coverage --whitelist src
```


## Usage

### Text

### Report

### Object

find object in a list according to a predicate

```php

<?php
use Tools\;

$obj = new stdClass;

$predicate	= ['name' => 'bob', 'mail' => 'bob@yopmail.com'];
$list		= '';
?>

```




### Sendgrid

### Curl

### Excel

- parse a large excel file (thanks to use akeano excel)
- check its integrity and provide a report on integrity errors
- use of anonymous function
- tested
- code coverage
- add efficient reader for parsing big files

```php
<?php

use Excel;

// apply regexp to columns
$config = [
    'A' => ['columnA', 'regexp', 'error message to set'],
    'B' => ['columnB', 'regexp', 'error message to set'],
];

// apply functions to columns
$valid = function ($col)
{
    return true;
}

$functions = [
    'A' => $valid
];

// check unicity on columns
$uniqs = [
    ['A'],
    ['A', 'C']
];

$filename = 'data.xlsx';
Excel::setFile($filename);
Excel::setSheet($sheet);
$datas = Excel::getData();
Excel::integrity($datas, $config, $uniqs, $function);

?>
```

### Ftp

### Curl
