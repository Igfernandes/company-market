<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use CodeIgniter\Database\Seeder;

class MigrateTestCommand extends BaseCommand
{
    protected $group       = 'Inicialize';
    protected $name        = 'migrate:test';
    protected $description = 'Roda as migrations e seeds no banco de teste (grupo tests)';

    public function run(array $params)
    {
        CLI::write('🚀 Executando migrations no banco de TESTES...', 'yellow');

        command('migrate', ['--group' => 'tests', '--env' => 'testing']);

        // 2️⃣ Pega o serviço de migrations corretamente
        /** @var \CodeIgniter\Database\MigrationRunner $migrations */
        $migrations = service('migrations'); // Isso pega o MigrationRunner configurado

        // 3️⃣ Define o grupo de migrations que você quer rodar
        $migrations->setGroup('tests');

        // 4️⃣ Executa as migrations para o banco de teste
        $migrations->latest();

        CLI::write('✅ Migrations concluídas para o banco de testes.', 'green');

        // Rodando seeds
        CLI::write('🌱 Populando banco de testes com seeds...', 'yellow');

        /** @var Seeder $seeder */
        command('db:seed BaseSeeds', ['--group' => 'tests', '--env' => 'testing']);


        CLI::write('✅ Seeds concluídos.', 'green');
    }
}
