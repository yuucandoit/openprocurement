<?php

    if(!function_exists('CurrencyToNumeric')) {
        function CurrencyToNumeric($value)
        {
            return preg_replace('/\D/', '', $value);
        }
    }
