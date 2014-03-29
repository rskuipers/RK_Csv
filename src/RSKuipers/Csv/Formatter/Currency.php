<?php

namespace RSKuipers\Csv\Formatter;

/**
 * Class Currency
 * @package RSKuipers\Csv\Formatter
 */
class Currency extends Number
{
    /**
     * @var int
     */
    protected $style = \NumberFormatter::CURRENCY;

    /**
     * @param $value
     * @return float
     */
    public function parse($value)
    {
        return $this->formatter->parseCurrency($value, $curr);
    }
}
