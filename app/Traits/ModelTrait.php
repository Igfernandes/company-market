<?php

namespace App\Traits;

use CodeIgniter\Entity\Entity;

trait ModelTrait
{
    /**
     * Insere ou atualiza um registro na tabela com base nas condições especificadas.
     *
     * Se um registro correspondente for encontrado com base nas condições passadas em `$where`, 
     * ele será atualizado com os dados fornecidos em `$data`. 
     * Caso contrário, um novo registro será inserido.
     *
     * @param array|object $where Condição para buscar o registro existente (array associativo ou objeto).
     *                            Exemplo: ['id' => 1] ou (object) ['id' => 1].
     * @param Entity|array $data Dados a serem inseridos ou atualizados (entidade ou array associativo).
     *                           Exemplo: ['name' => 'John', 'email' => 'john@example.com'].
     *
     * @return bool|int Retorna `true` se a operação de atualização for bem-sucedida, 
     *                  `false` se falhar, ou o ID do registro inserido em caso de inserção.
     *
     * @throws \CodeIgniter\Database\Exceptions\DatabaseException Se ocorrer um erro na consulta ao banco de dados.
     *
     * @example
     * // Atualiza se existir, caso contrário insere um novo registro
     * $this->upsert(['id' => 1], ['name' => 'Alice', 'email' => 'alice@example.com']);
     */
    public function upsert(array|object $where, Entity $data)
    {
        $this->where($where);

        if (!empty($this->first())) {
            $this->set($data->toArray(true))->where($where)->update();
            return;
        }

        $this->save($data);
    }
}
