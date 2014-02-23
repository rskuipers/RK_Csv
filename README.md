# RK_Csv

## What is it

This is a CSV library tailored for Magento, it's made to give you an easy start on reading CSV files.
My favorite functionality of this library is being able to set a row as the column titles and use those to access the data.

## Installation

Extract the contents of the **src/** folder into the **lib/** folder in your Magento installation.

## Examples

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
    'First Name',
    'Age',
));
$row = $file->fetch();
echo $row['First Name'];
```

## Tests

Run Phing to execute PHPLint and PHPUnit

```sh
$ phing
```