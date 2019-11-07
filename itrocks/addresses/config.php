<?php
namespace ITRocks\Addresses;

use ITRocks\Framework;
use ITRocks\Framework\Component\Menu;
use ITRocks\Framework\Configuration;
use ITRocks\Framework\Dao\File;
use ITRocks\Framework\Plugin\Priority;

global $loc;
require __DIR__ . '/../../loc.php';
require __DIR__ . '/../../itrocks/framework/config.php';

$config['ITRocks/Addresses'] = [
	Configuration::APP         => Application::class,
	Configuration::ENVIRONMENT => $loc[Configuration::ENVIRONMENT],
	Configuration::EXTENDS_APP => 'ITRocks/Framework',

	Priority::CORE => [
		Framework\Error_Handler\Error_Handlers::class => [
			[
				E_ALL & ~E_COMPILE_WARNING & ~E_CORE_WARNING & ~E_DEPRECATED & ~E_NOTICE & ~E_STRICT
				& ~E_USER_DEPRECATED & ~E_USER_NOTICE & ~E_USER_WARNING & ~E_WARNING,
				Framework\Error_Handler\To_Exception_Error_Handler::class
			],
			[
				E_COMPILE_WARNING | E_CORE_WARNING | E_DEPRECATED | E_NOTICE | E_STRICT
				| E_USER_DEPRECATED | E_USER_NOTICE | E_USER_WARNING | E_WARNING,
				Framework\Error_Handler\Report_Call_Stack_Error_Handler::class
			]
		]
	],

	//------------------------------------------------------------------------ LOWER priority plugins
	Priority::LOWER => [
		// lower than Maintainer to log all sql errors
		Framework\Dao\Mysql\File_Logger::class => [
			'path' => $loc[File\Link::class]['path'] . '/logs',
		]
	],

	Priority::NORMAL => [
		Framework\Component\Menu::class => [
			Menu::TITLE => [SL, 'Home', '#main'],
			'Address book' => [
				'/ITRocks/Addresses/Addresses' => 'Addresses'
			]
		],
		Framework\Dao::class => [
			Framework\Dao::LINKS_LIST => [
				'files' => array_merge(
					[Configuration::CLASS_NAME => File\Link::class],
					$loc[File\Link::class]
				)
			]
		],
		Framework\Logger::class
	],

	//----------------------------------------------------------------------- HIGHER priority plugins
	Priority::HIGHER => [
		Framework\Dao\Cache::class,
		Framework\View\Logger::class => [
			'path' => $loc[Framework\Dao\File\Link::class]['path'] . '/logs',
		]
	]

];
