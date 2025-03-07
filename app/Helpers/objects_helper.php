<?php


if (!function_exists('getObjectValues')) {
    /**
     * Retorna todos os valores das propriedades de um objeto.
     *
     * @param object $obj O objeto de onde os valores serão extraídos.
     * @return array Um array associativo com os nomes das propriedades como chaves e seus valores.
     */
    function getObjectValues(object $obj): array
    {
        // Converte o objeto para um array, incluindo propriedades privadas e protegidas
        $reflection = new ReflectionClass($obj);
        $properties = $reflection->getProperties();
        $values = [];

        foreach ($properties as $property) {
            $property->setAccessible(true);  // Permite acesso a propriedades privadas/protegidas
            $values[$property->getName()] = $property->getValue($obj);
        }

        return $values;
    }
}
