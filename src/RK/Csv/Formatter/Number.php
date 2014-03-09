<?php

abstract class RK_Csv_Formatter_Number implements RK_Csv_Formatter_Interface
{
    protected $style = \NumberFormatter::DECIMAL;

    protected $locale;

    protected $formatter;

    public function __construct($locale = null)
    {
        $this->locale = is_null($locale) ? locale_get_default() : $locale;
        $this->formatter = new NumberFormatter($this->locale, $this->style);
    }

    public function parse($value)
    {
        return $this->formatter->parse($value);
    }
}
