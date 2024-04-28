<?php

namespace Framework;

use Framework\Traits\CommandTraits\MakeFile;
use Framework\Traits\CommandTraits\DropFile;
use Framework\Traits\CommandTraits\TextColoring;
use Framework\QueryBuilder\Migration;
use Symfony\Component\String\Inflector\EnglishInflector;

class CmdHandler
{
    use TextColoring, MakeFile, DropFile;

    public function catchCommands($argc, $argv)
    {
        $get_cmd = explode(":", $argv[1]);
        if ($argc === 1 && $argv[0] === 'slash') {
            $this->displayAllCommands();
        } else if ($get_cmd[0] === 'make') {
            $this->makeFile($get_cmd[1], $argv[2] ?? '');
        } else if ($get_cmd[0] === 'drop') {
            $this->dropFile($get_cmd[1], $argv[2] ?? '');
        } else if ($argv[1] === 'run:migrate') {
            Migration::run();
        } else {
            echo "" . PHP_EOL;
            echo "\033[41mThat command doesn't exist. Please run \"php slash\"\033[0m to check the commands.\033[0m" . PHP_EOL;
            echo "" . PHP_EOL;
        }
    }

    private function displayAllCommands()
    {
        $codereeze = self::textRed('Codereeze');
        $dashed_line = str_repeat('-', 80);

        echo "" . PHP_EOL;
        echo "Welcome To $codereeze Framework 🦖🔥" . PHP_EOL;
        echo $dashed_line . PHP_EOL;

        foreach ($this->slash_commands as $key => $value) {
            echo self::textRed($key) . ":" . PHP_EOL;
            foreach ($value as $item) {
                echo "\t $item, \n";
            }
            echo $dashed_line . PHP_EOL;
        }

        echo "" . PHP_EOL;
        echo "Thank you✨✨" . PHP_EOL;
        echo "" . PHP_EOL;
    }

    private function makeFile(string $command, string $classname)
    {
        if ($command === 'controller') {
            $this->makeController($classname);
        } else if ($command === 'model') {
            $this->makeModel($classname);
        } else if ($command === 'migration') {
            $inflector = new EnglishInflector();
            $pluralized = $inflector->pluralize($classname)[0];

            $tableName = str_replace('Table', '', $pluralized);
            date_default_timezone_set('Asia/Jakarta');
            $fileNameByDate = date('Y_d_m_His_') . strtolower($tableName) . '_table';

            $this->makeMigration($fileNameByDate, $tableName . 'Table', strtolower($tableName));
        } else {
            echo "" . PHP_EOL;
            echo "\033[41mSorry, the command is not available in the list\033[0m" . PHP_EOL;
            echo "" . PHP_EOL;
        }
    }

    private function dropFile(string $command, string $path)
    {
        if ($command === 'controller') {
            $this->dropController($path);
        } else if ($command === 'model') {
            $this->dropModel($path);
        }
    }
}
