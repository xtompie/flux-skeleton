<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Xtompie\Flux\FileOutput;
use Xtompie\Flux\Machine;
use Xtompie\Flux\OnceFilter;
use Xtompie\Flux\Program;
use Xtompie\Flux\SshLinesInput;

Machine::new([
    Program::new(
        name: 'default',
        // input: new SshLinesInput('user@host:/path'),
        filter: new OnceFilter(),
        output: new FileOutput('default.log')
    )
])
    ->runAllPrograms()
;