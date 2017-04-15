<?php

/**
 * @package Dbmover
 * @subpackage Data
 */

namespace Dbmover\Data;

use Dbmover\Core;

class Plugin extends Core\Plugin
{
    public $description = 'Handling default data...';

    public function __invoke(string $sql) : string
    {
        if (preg_match_all("@^(INSERT INTO|UPDATE|DELETE FROM).*?;$@ms", $sql, $matches, PREG_SET_ORDER)) {
            foreach ($matches as $match) {
                $this->defer($match[0]);
                $sql = str_replace($match[0], '', $sql);
            }
        }
        return $sql;
    }
}

