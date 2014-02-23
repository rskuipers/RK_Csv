<?php

/**
 * Class RK_Csv_File
 * @author Rick Kuipers <io@rskuipers.com>
 */
class RK_Csv_File extends SplFileObject
{

    /**
     * Use a row in the CSV as the key for the value
     */
    const COLUMN_TITLES = 1;

    /**
     * Use a custom mapping array as the key for the value
     */
    const CUSTOM = 2;

    /**
     * Use the default index based key for the value
     */
    const INDEX = 3;

    /**
     * @var SplFileObject
     */
    protected $file;

    /**
     * @var int
     */
    protected $columnTitlesIndex = -1;

    /**
     * @var self::COLUMN_TITLES|self::CUSTOM|self::INDEX
     */
    protected $mappingMode;

    /**
     * @var array
     */
    protected $mapping;

    /**
     * @var int
     */
    protected $position = -1;

    /**
     * @var string
     */
    protected $delimiter = ',';

    /**
     * @param string $filename
     * @param int $columnTitlesIndex
     * @param string $open_mode
     * @param bool $use_include_path
     * @param null $context
     */
    public function __construct($filename, $columnTitlesIndex = -1, $open_mode = 'r', $use_include_path = false, $context = null)
    {
        $this->columnTitlesIndex = $columnTitlesIndex;
        if (is_null($context)) {
            $this->file = parent::__construct($filename, $open_mode, $use_include_path);
        } else {
            $this->file = parent::__construct($filename, $open_mode, $use_include_path, $context);
        }
    }

    /**
     * @return array
     * @throws RK_Csv_Exception_InvalidMappingException
     */
    public function fetch()
    {
        while ($row = $this->fgetcsv($this->delimiter)) {
            $this->position++;
            if ($this->position < $this->columnTitlesIndex) {
                continue;
            }
            if ($this->mappingMode == self::COLUMN_TITLES) {
                if ($this->position == $this->columnTitlesIndex) {
                    $this->mapping = array_filter($row);
                    continue;
                }
                return array_combine($this->mapping, $row);
            } elseif ($this->mappingMode == self::CUSTOM) {
                if ($this->position == $this->columnTitlesIndex) {
                    continue;
                }
                if (!is_array($this->mapping)) {
                    throw new RK_Csv_Exception_InvalidMappingException('Mapping is set to custom but no mapping was found.');
                }
                return array_combine($this->mapping, $row);
            } else {
                if ($this->position == $this->columnTitlesIndex) {
                    continue;
                }
                return $row;
            }
        }
    }

    /**
     * @param int $columnTitlesIndex
     */
    public function setColumnTitlesIndex($columnTitlesIndex)
    {
        $this->columnTitlesIndex = $columnTitlesIndex;
    }

    /**
     * @return int
     */
    public function getColumnTitlesIndex()
    {
        return $this->columnTitlesIndex;
    }

    /**
     * @param array $mapping
     */
    public function setMapping($mapping)
    {
        $this->mapping = $mapping;
    }

    /**
     * @return array
     */
    public function getMapping()
    {

        return $this->mapping;
    }

    /**
     * @param int $mappingMode
     */
    public function setMappingMode($mappingMode)
    {
        $this->mappingMode = $mappingMode;
    }

    /**
     * @return int
     */
    public function getMappingMode()
    {
        return $this->mappingMode;
    }

    /**
     * @param SplFileObject $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * @return SplFileObject
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param string $delimiter
     */
    public function setDelimiter($delimiter)
    {
        $this->delimiter = $delimiter;
    }

    /**
     * @return string
     */
    public function getDelimiter()
    {
        return $this->delimiter;
    }
}
