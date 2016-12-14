<?php
namespace ITRocks\Addresses;

use ITRocks\Framework\Configuration;
use ITRocks\Framework\Plugin\Priority;
use ITRocks\Framework\Widget\Menu;

global $loc;
require __DIR__ . '/../../loc.php';
require __DIR__ . '/../../itrocks/framework/config.php';

$config['ITRocks/Addresses'] = [
	Configuration::APP         => Application::class,
	Configuration::ENVIRONMENT => $loc[Configuration::ENVIRONMENT],
	Configuration::EXTENDS_APP => 'ITRocks/Framework',

	Priority::NORMAL => [
		Menu::class => [
			Menu::TITLE => [SL, 'Home', '#main'],
			'Address book' => [
				'/ITRocks/Addresses/Addresses' => 'Addresses'
			]
		]
	]

];
