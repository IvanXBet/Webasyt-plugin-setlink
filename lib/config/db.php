<?php
return array(
    'shop_setlink_cards' => array(
        'id' => array('int', 11, 'null' => 0, 'autoincrement' => 1),
        'name' => array('varchar', 255, 'null' => 0),
        'text' => array('varchar', 255),
        'path' => array('varchar', 255),
        'size' => array('int', 11, 'null' => 0),
        'original_filename' => array('varchar', 255, 'null' => 0),
        'ext' => array('varchar', 32, 'null' => 0),
        'sort' => array('int', 11, 'null' => 0),
        ':keys' => array(
            'PRIMARY' => 'id',
        ),
    ),
);
