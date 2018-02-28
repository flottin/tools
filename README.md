# Tools
A set of usefull tools for php

## Installation 

composer require flottin/tools:dev-master -vvv

## Runing tests

```{r, engine='bash', count_lines}
# remove your composer.lock
rm composer.lock

# add php unit. you need phpunit install and added to path
composer require phpunit/phpunit:^5

# run the tests
vendor\bin\phpunit.bat --bootstrap vendor/autoload.php --testdox vendor\excel\find\tests\
```

	
	

## Usage

### String

### Object

find object in a list according to a predicate
```php
<?php
use flottin\tools;

$predicate	= 
$list		= 
```
	

### Sendgrid

### Curl

### Ftp

### Excel