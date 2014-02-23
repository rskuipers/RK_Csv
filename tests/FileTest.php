<?php

require_once __DIR__ . '/../vendor/autoload.php';

/**
 * Class FileTest
 * @author Rick Kuipers <io@rskuipers.com>
 */
class FileTest extends PHPUnit_Framework_TestCase
{

    /**
     * Write example CSV data to a temporary file
     * @return string
     */
    protected function getCsvFile()
    {
        $csv = <<< CSV
ID,Name,Age
1,John,19
2,Doe,21
3,Foo,31
4,Bar,52
CSV;
        $tmpFile = tempnam(sys_get_temp_dir(), 'csvtest');
        file_put_contents($tmpFile, $csv);
        return $tmpFile;
    }

    /**
     * Test the fetch method with the RK_Csv_File::COLUMN_TITLES mode
     */
    public function testFetchColumnTitles()
    {
$file = new RK_Csv_File($this->getCsvFile(), 0);
$file->setMappingMode(RK_Csv_File::COLUMN_TITLES);
$row = $file->fetch();
$this->assertEquals('John', $row['Name']);
    }

    /**
     * Test the fetch method with the RK_Csv_File::INDEX mode
     */
    public function testFetchIndex()
    {
        $file = new RK_Csv_File($this->getCsvFile(), 0);
        $file->setMappingMode(RK_Csv_File::INDEX);
        $row = $file->fetch();
        $this->assertEquals('John', $row[1]);
    }

    /**
     * Test the fetch method with the RK_Csv_File::CUSTOM mode
     */
    public function testFetchCustom()
    {
        $file = new RK_Csv_File($this->getCsvFile(), 0);
        $file->setMappingMode(RK_Csv_File::CUSTOM);
        $file->setMapping(array(
            'ID',
            'First Name',
            'Age',
        ));
        $row = $file->fetch();
        $this->assertEquals('John', $row['First Name']);
    }
}
