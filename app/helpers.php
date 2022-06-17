<?php

use App\Models\Configuration;

if (!function_exists('price')) {
    /**
     * Get the current ticket price, including tax
     *
     * @param string|null $unit
     * @return string|int|float
     */
    function ticket_price($unit = null)
    {
        if ($unit !== null && !is_string($unit))
            throw new \Exception('$unit must be a string');

        $config = Configuration::first();
        $price = round($config->preco_bilhete_sem_iva + ($config->preco_bilhete_sem_iva * $config->percentagem_iva) / 100, 2);

        return $price . $unit;
    }
}
