# RK_Csv

[![Build Status](https://travis-ci.org/rskuipers/RK_Csv.png?branch=master)](https://travis-ci.org/rskuipers/RK_Csv)

## What is it

This is a CSV library tailored for Magento, it's made to give you an easy start on reading CSV files.
My favorite functionality of this library is being able to set a row as the column titles and use those to access the data,
as well as set column formatters to properly parse columns that contain (localized) currencies or decimals.

## Installation

Extract the contents of the **src/** folder into the **lib/** folder in your Magento installation.

## Examples

### Mapping Modes

```csv
ID,Name,Age
1,John,19
2,Doe,21
3,Foo,31
4,Bar,52
```

```php
$file = new RK_Csv_File($this->getCsvFile(), 0);
$file->setMappingMode(RK_Csv_File::COLUMN_TITLES);
$row = $file->fetch();
echo $row['Name'];
```

```php
$file = new RK_Csv_File($this->getCsvFile(), 0);
$file->setMappingMode(RK_Csv_File::INDEX);
$row = $file->fetch();
echo $row[1];
```

```php
$file = new RK_Csv_File($this->getCsvFile(), 0);
$file->setMappingMode(RK_Csv_File::CUSTOM);
$file->setMapping(array(
    'ID',
    'Product Name',
    'Price',
));
$row = $file->fetch();
echo $row['Product Name'];
```

### Column Formatters

```csv
ID,Name,Price,Stock
1,Lighter,"€ 15,95","2.093.230"
2,Chair,"€ 17","3.230"
3,Table,"€ 19,91","530",
4,Book,"€ 1","76.126"
```

```php
$priceFormatter = new RK_Csv_Formatter_Currency('nl_NL');
$decimalFormatter = new RK_Csv_Formatter_Decimal('nl_NL');
$csv = new RK_Csv_File($this->getCsvFile(), 0);
$csv->setMappingMode(RK_Csv_File::COLUMN_TITLES);
$csv->setFormatter('Price', $priceFormatter);
$csv->setFormatter('Stock', $decimalFormatter);
$row = $csv->fetch();
echo $row['Price']; // 15.95
echo $row['Stock']; // 2093230
```


## Tests

Run Phing to execute PHPLint and PHPUnit

```sh
$ phing
```