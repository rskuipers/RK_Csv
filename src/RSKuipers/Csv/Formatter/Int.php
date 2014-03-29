<?php

namespace RSKuipers\Csv\Formatter;

/**
 * Class Int
 * @package RSKuipers\Csv\Formatter
 */
class Int extends Number
{
    /**
     * @param $value
     * @return int
     */
    public function parse($value)
    {
        return intval(parent::parse($value));
    }
}
