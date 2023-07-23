<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Xtompie\Flux\Core\Machine;
use Xtompie\Flux\Core\Program;
use Xtompie\Flux\Filter\OnceFilter;
use Xtompie\Flux\Finish\CountFilesLinesFinish;
use Xtompie\Flux\Input\LinesInput;
use Xtompie\Flux\Output\FileOutput;
use Xtompie\Flux\Start\RsyncStart;
use Xtompie\Flux\Stop\CountFileLinesStop;

Machine::new(
    program: [
        Program::new(
            name: 'default',
            start: RsyncStart::new('user@127.0.0.1:/var/nginx/logs/laravel-*', 'var/default/input'),
            input: LinesInput::new('var/default/input/'),
            filter: OnceFilter::new('var/default/once/'),
            output: FileOutput::new('log/default.log'),
            stop: CountFileLinesStop::new('log/default.log'),
        )
    ],
    finish: CountFilesLinesFinish::new('log/'),
)
    ->run()
;
