<?php

use think\migration\Migrator;
use think\migration\db\Column;

class User extends Migrator
{

    public function change()
    {
        $table = $this->table('user');
        $table->addColumn('username', 'string');
        $table->addColumn('password', 'string');
        $table->addTimestamps();
        $table->addSoftDelete();
        $table->create();
    }
}
