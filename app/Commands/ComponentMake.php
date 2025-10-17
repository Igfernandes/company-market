<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class ComponentMake extends BaseCommand
{
    protected $group       = 'Custom';
    protected $name        = 'component:make';
    protected $description = 'Gera uma nova classe de componente e sua view com base em templates em /app/Views/commands/templates.';

    public function run(array $params)
    {
        if (empty($params)) {
            CLI::error('❌ Você precisa informar o caminho do componente. Exemplo: php spark component:make Shared/Forms/Fields/Checkbox');
            return;
        }

        // Caminho informado (ex: Shared/Forms/Fields/Checkbox)
        $path = trim($params[0], '/\\');

        // Nome da classe (último segmento)
        $className = basename($path);

        // Caminho base das classes
        $componentDir = APPPATH . 'Components' . DIRECTORY_SEPARATOR . str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $path);

        // Caminho final da classe
        $filePath = $componentDir . DIRECTORY_SEPARATOR . $className . '.php';

        // Caminho base da view
        $viewFile = APPPATH . 'Views' . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . strtolower(str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $path)) . '.php';

        // Namespace da classe
        $namespace = 'App\\Components\\' . str_replace(['/', '\\'], '\\', $path);

        // Caminho ORIGIN da view (minúsculo)
        $origin = 'components/' . strtolower(str_replace(['\\', '/'], '/', $path));

        // Caminhos dos templates
        $templateDir = APPPATH . 'Views' . DIRECTORY_SEPARATOR . 'commands' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR;
        $phpTemplateFile = $templateDir . 'component.php.txt';
        $htmlTemplateFile = $templateDir . 'component.html.txt';

        // Verifica se o componente já existe
        if (file_exists($filePath)) {
            CLI::error("❌ O componente já existe: {$filePath}");
            return;
        }

        // Cria diretórios
        if (!is_dir($componentDir)) mkdir($componentDir, 0777, true);
        if (!is_dir(dirname($viewFile))) mkdir(dirname($viewFile), 0777, true);

        // 🧱 Carrega template da classe
        if (file_exists($phpTemplateFile)) {
            $classTemplate = file_get_contents($phpTemplateFile);
        } else {
            CLI::error("❌ Template PHP não encontrado em: {$phpTemplateFile}");
            return;
        }

        // 🧱 Carrega template da view
        if (file_exists($htmlTemplateFile)) {
            $htmlTemplate = file_get_contents($htmlTemplateFile);
        } else {
            CLI::error("❌ Template HTML não encontrado em: {$htmlTemplateFile}");
            return;
        }

        // 🔁 Substitui variáveis dinâmicas nos templates
        $replacements = [
            '{{namespace}}' => $namespace,
            '{{className}}' => $className,
            '{{origin}}' => $origin,
            '{{componentName}}' => strtolower($className),
        ];

        $classContent = str_replace(array_keys($replacements), array_values($replacements), $classTemplate);
        $htmlContent = str_replace(array_keys($replacements), array_values($replacements), $htmlTemplate);

        // Cria arquivos
        file_put_contents($filePath, $classContent);
        file_put_contents($viewFile, $htmlContent);

        CLI::write("✅ Componente criado com sucesso!", 'green');
        CLI::write("📦 Classe: {$filePath}");
        CLI::write("📄 View:   {$viewFile}");
        CLI::newLine();
    }
}
