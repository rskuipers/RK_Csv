<?php

class RK_Csv_Formatter_Int extends RK_Csv_Formatter_Number
{
    public function parse($value)
    {
        return intval(parent::parse($value));
    }
}
