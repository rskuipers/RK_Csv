<?php

namespace RK\Csv;

require_once __DIR__ . '/../vendor/autoload.php';

class FormatterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Write example CSV data to a temporary file
     * @return string
     */
    protected function getCsvFile()
    {
        $csv = <<< CSV
ID,Name,Price
1,Lighter,"€ 15,95"
2,Chair,"€ 17"
3,Table,"€ 19,91"
4,Book,€1
CSV;
        $tmpFile = tempnam(sys_get_temp_dir(), 'csvtest');
        file_put_contents($tmpFile, $csv);
        return $tmpFile;
    }

    /**
     * @test
     */
    public function itShouldParseColumnAsFloat()
    {
        /** @var \RK_Csv_Formatter_Interface $fooFormatter */
        $fooFormatter = $this->getMock('RK_Csv_Formatter_Interface', array('parse'));
        $fooFormatter->expects($this->atLeastOnce())
            ->method('parse')
            ->will($this->returnValue('Foo'));
        $csv = new \RK_Csv_File($this->getCsvFile(), 0);
        $csv->setMappingMode(\RK_Csv_File::COLUMN_TITLES);
        $csv->setFormatter('Name', $fooFormatter);
        $row = $csv->fetch();
        $this->assertEquals('Foo', $row['Name']);
    }
}
