<?php

use App\Models\Configuration;

if (!function_exists('price')) {
    function price()
    {
        $config = Configuration::first();
        $price = round($config->preco_bilhete_sem_iva + ($config->preco_bilhete_sem_iva * $config->percentagem_iva) / 100, 2);

        return $price;
    }
}
