<?php
/**
 * This file was generated by Atlas. Changes will be overwritten.
 */
declare(strict_types=1);

namespace Author;

use Atlas\Table\Table;

/**
 * @method AuthorRow|null fetchRow($primaryVal)
 * @method AuthorRow[] fetchRows(array $primaryVals)
 * @method AuthorTableSelect select(array $whereEquals = [])
 * @method AuthorRow newRow(array $cols = [])
 * @method AuthorRow newSelectedRow(array $cols)
 */
class AuthorTable extends Table
{
    const DRIVER = 'sqlite';

    const NAME = 'author';

    const COLUMNS = [
        'id' => [
            'name' => 'id',
            'type' => 'INTEGER',
            'size' => null,
            'scale' => null,
            'notnull' => true,
            'default' => null,
            'autoinc' => false,
            'primary' => true,
            'options' => null,
        ],
        'first_name' => [
            'name' => 'first_name',
            'type' => 'VARCHAR',
            'size' => 128,
            'scale' => null,
            'notnull' => true,
            'default' => null,
            'autoinc' => false,
            'primary' => false,
            'options' => null,
        ],
        'last_name' => [
            'name' => 'last_name',
            'type' => 'VARCHAR',
            'size' => 128,
            'scale' => null,
            'notnull' => true,
            'default' => null,
            'autoinc' => false,
            'primary' => false,
            'options' => null,
        ],
        'email' => [
            'name' => 'email',
            'type' => 'VARCHAR',
            'size' => 128,
            'scale' => null,
            'notnull' => false,
            'default' => null,
            'autoinc' => false,
            'primary' => false,
            'options' => null,
        ],
    ];

    const COLUMN_NAMES = [
        'id',
        'first_name',
        'last_name',
        'email',
    ];

    const COLUMN_DEFAULTS = [
        'id' => null,
        'first_name' => null,
        'last_name' => null,
        'email' => null,
    ];

    const PRIMARY_KEY = [
        'id',
    ];

    const AUTOINC_COLUMN = null;

    const AUTOINC_SEQUENCE = null;
}
