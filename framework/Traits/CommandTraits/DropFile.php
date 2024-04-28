<?php

namespace Framework\Traits\CommandTraits;

trait DropFile
{
    private function dropController($path)
    {
        $filepath = __DIR__ . "/../../../app/controllers/$path.php";
        if (file_exists($filepath)) {
            if (unlink($filepath)) {
                echo "" . PHP_EOL;
                echo "\033[42mSuccessfully deleted controller $path \033[0m" . PHP_EOL;
                echo "" . PHP_EOL;
            } else {
                echo "" . PHP_EOL;
                echo "\033[41mFailed deleting $path\033[0m" . PHP_EOL;
                echo "" . PHP_EOL;
            }
        } else {
            echo "" . PHP_EOL;
            echo "\033[41m$path doesn't exist\033[0m" . PHP_EOL;
            echo "" . PHP_EOL;
        }
    }

    private function dropModel($path)
    {
        $filepath = __DIR__ . "/../../../app/models/$path.php";
        if (file_exists($filepath)) {
            if (unlink($filepath)) {
                echo "" . PHP_EOL;
                echo "\033[42mSuccessfully deleted model $path \033[0m" . PHP_EOL;
                echo "" . PHP_EOL;
            } else {
                echo "" . PHP_EOL;
                echo "\033[41mFailed deleting $path model\033[0m" . PHP_EOL;
                echo "" . PHP_EOL;
            }
        } else {
            echo "" . PHP_EOL;
            echo "\033[41m$path doesn't exist\033[0m" . PHP_EOL;
            echo "" . PHP_EOL;
        }
    }
}
