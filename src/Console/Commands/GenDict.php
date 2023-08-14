<?php

declare(strict_types=1);

namespace Laractl\Console\Commands;

use Laractl\Support\SchemaTrait;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GenDict extends Command
{
    use SchemaTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gen:dict';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate database dict';

    private array $ignoreTables = [

    ];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $database = env('DB_DATABASE');
        $tables = DB::query('show tables;');

        $content = "# 数据字典\n\n";
        foreach ($tables as $row) {
            $tableName = implode('', $row);
            if (in_array($tableName, $this->ignoreTables)) {
                continue;
            }

            $tableInfo = DB::query("SELECT `TABLE_COMMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$database' AND TABLE_NAME = '$tableName';");
            $content .= "### {$tableInfo[0]['TABLE_COMMENT']}(`$tableName`)\n";

            $columns = $this->getTableInfo($database, $tableName);
            $content .= $this->getContent($columns);
        }

        file_put_contents(public_path('docs/dict/README.md'), $content);
    }

    public function getContent($columns): string
    {
        $content = "| 列名 | 数据类型 | 索引 | 是否为空 | 描述 |\n";
        $content .= "| ------- | --------- | --------- | --------- | -------------- |\n";
        foreach ($columns as $column) {
            $isNull = $column['Null'] === 'NO' ? '否' : '是';
            $content .= "| {$column['Field']} | {$column['Type']} | {$column['Key']} | $isNull | {$column['Comment']} |\n";
        }
        $content .= "\n";

        return $content;
    }
}
