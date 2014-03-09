<?php

class RK_Csv_Formatter_Currency extends RK_Csv_Formatter_Number
{
    protected $style = \NumberFormatter::CURRENCY;

    public function parse($value)
    {
        return $this->formatter->parseCurrency($value, $curr);
    }
}
