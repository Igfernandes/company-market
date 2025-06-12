<?php

namespace App\Traits;

trait EntityEnhancerTrait
{
    /**
     * Converte a entidade em um array, opcionalmente filtrando valores vazios.
     *
     * @param bool $onlyChanged   Se true, retorna apenas os campos que foram modificados. Padrão é false.
     * @param bool $filterEmpty   Se true, remove valores vazios (null, '', [], etc.), mantendo 0 e '0'. Padrão é true.
     *
     * @return array   Um array com os dados da entidade, potencialmente filtrado conforme os parâmetros.
     */
    public function toArray(bool $onlyChanged = false, bool $cast = true, bool $recursive = false): array
    {
        $data = parent::toArray($onlyChanged, $cast, $recursive);

        // Adicionando lógica extra: Filtrar valores vazios
        $data = array_filter($data, function ($value) {
            return !empty($value);
        });

        return $data;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }


    public function store(array $data)
    {
        foreach ($this->attributes as $atbIndex => $atbValue) {
            if (isset($data[$atbIndex]))
                $this->attributes[$atbIndex] = $data[$atbIndex];
        }
    }
}
