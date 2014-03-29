<?php

namespace RSKuipers\Csv\Formatter;

/**
 * Interface FormatterInterface
 * @package RSKuipers\Csv\Formatter
 */
interface FormatterInterface
{
    /**
     * @param $value
     * @return mixed
     */
    public function parse($value);
}
