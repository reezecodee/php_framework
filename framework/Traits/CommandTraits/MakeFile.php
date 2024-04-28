<?php

namespace Framework\Traits\CommandTraits;

trait MakeFile
{
    private function makeController($path)
    {
        $namespace = explode('\\', '\\' . str_replace('/', '\\', $path));
        $classname = end($namespace);
        $namespace = implode('\\', array_slice($namespace, 0, -1));
        $template = <<<CLASS
            <?php

            namespace App\Controllers$namespace;

            use Framework\Controller;

            class $classname extends Controller
            {
                // Hello World
            }
            CLASS;

        $directory = __DIR__ . '/../../../app/controllers/';
        $filename = "$classname.php";
        $filepath = $directory . $namespace . '/' . $filename;

        if (file_exists($filepath)) {
            echo "" . PHP_EOL;
            echo "\033[41m$classname does exist in controllers\033[0m" . PHP_EOL;
            echo "" . PHP_EOL;
        } else {
            $directoryPath = $directory . str_replace('\\', '/', $namespace);

            if (!is_dir($directoryPath)) {
                if (!mkdir($directoryPath, 0755, true)) {
                    die("Unable to create directory $directoryPath");
                }
            }

            $file = fopen($filepath, "a");
            fwrite($file, $template);
            fclose($file);

            echo "" . PHP_EOL;
            echo "\033[42mSuccessfully created $classname in controllers\033[0m" . PHP_EOL;
            echo "" . PHP_EOL;
        }
    }

    private function makeModel($path)
    {
        $namespace = explode('\\', '\\' . str_replace('/', '\\', $path));
        $classname = end($namespace);
        $namespace = implode('\\', array_slice($namespace, 0, -1));
        $template = <<<CLASS
            <?php

            namespace App\Models$namespace;

            use Framework\Model;

            class $classname extends Model
            {
                // Hello World
            }
            CLASS;

        $directory = __DIR__ . '/../../../app/models/';
        $filename = "$classname.php";
        $filepath = $directory . $namespace . '/' . $filename;

        if (file_exists($filepath)) {
            echo "" . PHP_EOL;
            echo "\033[41m$classname does exist in models\033[0m" . PHP_EOL;
            echo "" . PHP_EOL;
        } else {
            $directoryPath = $directory . str_replace('\\', '/', $namespace);

            if (!is_dir($directoryPath)) {
                if (!mkdir($directoryPath, 0755, true)) {
                    die("Unable to create directory $directoryPath");
                }
            }

            $file = fopen($filepath, "a");
            fwrite($file, $template);
            fclose($file);

            echo "" . PHP_EOL;
            echo "\033[42mSuccessfully created $classname in models\033[0m" . PHP_EOL;
            echo "" . PHP_EOL;
        }
    }

    private function makeMigration($filename, $class_name, $table_name)
    {
        $template = <<<CLASS
        <?php

        namespace Database\Migrations;

        use Framework\QueryBuilder\Blueprint;
        use Framework\QueryBuilder\Migration;
        use Framework\QueryBuilder\Schema;

        class $class_name extends Migration
        {
            public function up()
            {
                Schema::create('$table_name', function (Blueprint \$attribute) {
                    \$attribute->id();
                });
            }

            public function down()
            {
                Schema::dropIfExists('$table_name');
            }
        }

        CLASS;

        $directory = __DIR__ . '/../../../database/migrations/';
        $filename = "$filename.php";
        $filepath = $directory . $filename;

        $file = fopen($filepath, "a");
        fwrite($file, $template);
        fclose($file);

        echo "" . PHP_EOL;
        echo "\033[42mSuccessfully created migration $class_name in database migration\033[0m" . PHP_EOL;
        echo "" . PHP_EOL;
    }
}