<?php return array(
    'root' => array(
        'name' => 'root/html',
        'pretty_version' => '1.0.0+no-version-set',
        'version' => '1.0.0.0',
        'reference' => NULL,
        'type' => 'library',
        'install_path' => __DIR__ . '/../../',
        'aliases' => array(),
        'dev' => true,
    ),
    'versions' => array(
        'root/html' => array(
            'pretty_version' => '1.0.0+no-version-set',
            'version' => '1.0.0.0',
            'reference' => NULL,
            'type' => 'library',
            'install_path' => __DIR__ . '/../../',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'scssphp/scssphp' => array(
            'pretty_version' => 'v1.11.0',
            'version' => '1.11.0.0',
            'reference' => '33749d12c2569bb24071f94e9af828662dabb068',
            'type' => 'library',
            'install_path' => __DIR__ . '/../scssphp/scssphp',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'twbs/bootstrap' => array(
            'pretty_version' => 'v4.5.0',
            'version' => '4.5.0.0',
            'reference' => '7a6da5e3e7ad7c749dde806546a35d4d4259d965',
            'type' => 'library',
            'install_path' => __DIR__ . '/../twbs/bootstrap',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'twitter/bootstrap' => array(
            'dev_requirement' => false,
            'replaced' => array(
                0 => 'v4.5.0',
            ),
        ),
    ),
);
