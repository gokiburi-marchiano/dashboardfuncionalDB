<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /**
         * Validación personalizada para RUT Chileno
         * Uso: 'rut' en las reglas de validación
         */
        Validator::extend('rut', function ($attribute, $value, $parameters, $validator) {
            // 1. Limpiar el string de puntos y guiones, dejar solo números y K
            $rut = preg_replace('/[^k0-9]/i', '', $value);

            if (strlen($rut) < 2) {
                return false;
            }

            // 2. Separar dígito verificador y cuerpo
            $dv = substr($rut, -1);
            $numero = substr($rut, 0, strlen($rut) - 1);

            // 3. Algoritmo de validación (Módulo 11)
            $i = 2;
            $suma = 0;
            foreach (array_reverse(str_split($numero)) as $v) {
                if ($i == 8) {
                    $i = 2;
                }
                $suma += $v * $i;
                $i++;
            }

            $dvr = 11 - ($suma % 11);

            if ($dvr == 11) {
                $dvr = 0;
            }
            if ($dvr == 10) {
                $dvr = 'K';
            }

            // 4. Comparar el dígito ingresado con el calculado
            return strtoupper($dv) == strtoupper($dvr);
        });
    }
}
