<?php

/**
 * nuCMS - menu module config
 *
 * @author              nugato
 */
$config['positions'] = [                                                        // Menu positions
    1 => lang('menu.position.top'),
    2 => lang('menu.position.footer'),
];
$config['types_modules'] = [                                                    // Menu types modules
    1 => null,
    2 => 'page',
];
$config['targets'] = [                                                          // Menu item target options
    '_self' => lang('menu.form.target.self'),
    '_blank' => lang('menu.form.target.blank'),
];