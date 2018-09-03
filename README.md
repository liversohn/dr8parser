# dr8parser
DR-8 Validator, Parser and Database Saver test

## Installation

### clone from repository
```
git clone https://github.com/liversohn/dr8parser
cd dr8parser
```

### setup composer
if there is no copy of composer in your bash, please follow these instructions: https://getcomposer.org/download/ or install composer via this curl command (will be installed in usr/local/bin):
```
curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer
```
then proceed to autoload and dependant libraries installation:
```
composer update
```

### filesystem rights
it is necessary to set proper write rights for log file:
```
chmod 664 log/*

```

### database setup
run sql/parser.sql file as a database root

## Testing

parser runs from commandline - common usage: parse.php <filename>
examples included:
```
php -f parse.php ./data/test-small.xml
php -f parse.php ./data/test-small-err.xml (will generate errors into log)
php -f parse.php ./data/test-medium.xml
php -f parse.php ./data/test-big.xml

```
