<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class ComponentCopy extends BaseCommand
{
    protected $group       = 'Custom';
    protected $name        = 'component:copy';
    protected $description = 'Copia a estrutura de um componente existente para um novo.';
    protected $usage       = 'php spark component:copy origem destino';

    public function run(array $params)
    {
        if (count($params) < 2) {
            CLI::error('Uso incorreto. Exemplo: php spark component:copy Shared/Forms/Fields/Input Shared/Forms/Fields/Checkbox');
            return;
        }

        [$sourcePath, $targetPath] = $params;

        // Normaliza caminhos
        $sourcePath = trim($sourcePath, '/\\');
        $targetPath = trim($targetPath, '/\\');

        // Extrai nomes de classe
        $sourceClass = basename($sourcePath);
        $targetClass = basename($targetPath);

        // Caminhos completos
        $baseDir = APPPATH . 'Components' . DIRECTORY_SEPARATOR;
        $sourceFile = $baseDir . str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $sourcePath) . DIRECTORY_SEPARATOR . $sourceClass . '.php';
        $targetDir = $baseDir . str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $targetPath);
        $targetFile = $targetDir . DIRECTORY_SEPARATOR . $targetClass . '.php';

        // Valida se origem existe
        if (!file_exists($sourceFile)) {
            CLI::error("O componente de origem não existe: {$sourceFile}");
            return;
        }

        // Evita sobrescrever
        if (file_exists($targetFile)) {
            CLI::error("O componente de destino já existe: {$targetFile}");
            return;
        }

        // Lê o arquivo original
        $sourceCode = file_get_contents($sourceFile);

        // Extrai PROPS
        $propsBlock = '[]';
        if (preg_match('/const\s+PROPS\s*=\s*(\[[^\]]*\])\s*;/s', $sourceCode, $matches)) {
            $propsBlock = trim($matches[1]);
        }

        // Extrai parâmetros do render()
        $paramsBlock = '';
        if (preg_match('/public\s+static\s+function\s+render\s*\(([^)]*)\)/s', $sourceCode, $matches)) {
            $paramsBlock = trim($matches[1]);
        }

        // Gera novo namespace e origin
        $namespace = 'App\\Components\\' . str_replace(['/', '\\'], '\\', $targetPath);
        $origin = 'components/' . strtolower(str_replace(['\\', '/'], '/', $targetPath));

        // Cria diretório destino
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Gera o conteúdo da nova classe
        $template = <<<PHP
            <?php

            namespace {$namespace};

            use App\Components\BaseComponents;

            class {$targetClass} extends BaseComponents
            {
                const ORIGIN = "{$origin}";
                const PROPS = {$propsBlock};

                public static function render({$paramsBlock})
                {
                    Component(self::ORIGIN, compact(self::PROPS));
                }
            }
            PHP;

        // Salva o novo arquivo
        file_put_contents($targetFile, $template);

        CLI::write("✅ Componente copiado com sucesso!", 'green');
        CLI::write("📦 Origem: {$sourcePath}");
        CLI::write("📁 Novo: {$targetPath}");
        CLI::newLine();
    }
}
