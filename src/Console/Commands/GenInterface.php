<?php

declare(strict_types=1);

namespace Focite\Generator\Console\Commands;

use Illuminate\Console\Command;

class GenInterface extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gen:interface';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate typescript interface';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $files = glob(base_path('resources/types/*.json'));
        foreach ($files as $file) {
            $moduleName = basename($file, '.json');

            $content = '';
            $data = json_decode(file_get_contents($file), true);
            if (isset($data['components']['schemas'])) {
                foreach ($data['components']['schemas'] as $type => $schema) {
                    if (! isset($schema['properties'])) {
                        exit($moduleName.' '.$type.' 缺少 properties 参数');
                    }
                    $content .= $this->genCode($type, $schema);
                }
            }

            file_put_contents(base_path('resources/types/'.$moduleName.'.ts'), $content);

            unlink($file);
        }
    }

    private function genCode(string $interface, array $schema): string
    {
        $c = "export interface I$interface {\n";

        foreach ($schema['properties'] as $name => $property) {
            if (isset($property['type'])) {
                $type = $property['type'];
                if (in_array($type, ['integer', 'float'])) {
                    $type = 'number';
                } elseif ($type === 'file') {
                    $type = 'string';
                } elseif ($type === 'array') {
                    if (isset($property['items']['$ref'])) {
                        $type = 'I'.basename($property['items']['$ref']).'[]';
                    } elseif (isset($property['items']['type'])) {
                        $type = $property['items']['type'];
                        if (in_array($type, ['integer', 'float'])) {
                            $type = 'number';
                        }
                        $type = $type.'[]';
                    }
                }
            } elseif (isset($property['$ref'])) {
                $type = 'I'.basename($property['$ref']).'[]';
            } else {
                exit($interface.' 对象 '.var_export($property, true).' 缺失类型');
            }

            $description = isset($property['description']) ? ' // '.$property['description'] : '';

            if (isset($schema['required']) && ! in_array($name, $schema['required'])) {
                $name = $name.'?';
            }

            $c .= "  $name: $type,$description\n";
        }

        return $c."}\n\n";
    }
}
