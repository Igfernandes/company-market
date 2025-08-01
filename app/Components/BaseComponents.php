<?php

namespace App\Components;

class BaseComponents
{
    const ORIGIN = "";
    const PROPS = [];

    /**
     * Renderiza um componente de formulário com os parâmetros fornecidos.
     *
     * Cada parâmetro representa uma propriedade esperada pelo componente
     * e será automaticamente convertido em uma variável interna na view.
     * A view é determinada por `self::ORIGIN`, e os parâmetros são passados
     * através de `compact(self::PROPS)`.
     * 
     * @return void
     */
    public static function render() {}
}
