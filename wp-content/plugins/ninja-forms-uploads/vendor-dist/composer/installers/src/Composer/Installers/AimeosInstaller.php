<?php

namespace NF_FU_VENDOR\Composer\Installers;

class AimeosInstaller extends BaseInstaller
{
    protected $locations = array('extension' => 'ext/{$name}/');
}
