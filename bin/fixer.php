#!/usr/bin/env php
<?php

require __DIR__."/../config/main.php";
require __DIR__."/../config/scraper.php";
require __DIR__."/../bootstrap/icetea_bootstrap.php";

use Phx\DataFixer;
use Phx\Scrapers\Fixers\Detik;
use Phx\Scrapers\Fixers\Tribunnews;
use Phx\Scrapers\Fixers\GlobalFixer;

if (! isset($argv[1])) {
	print "\$argv[1] is not defined!\n";
	exit(1);
}

switch ($argv[1]) {
	case '--all':
		$st = new GlobalFixer;
		break;

	case 'liputan6':
		$st = new Liputan6;
		#define("LOG_FILE", "liputan6_fixer.log");
		break;
	
	case 'tribunnews':
		$st = new Tribunnews;
		#define("LOG_FILE", "tribunnews_fixer.log");
		break;

	case 'detik':
		$st = new Detik;
		#define("LOG_FILE", "tribunnews_fixer.log");
		break;

	default:
		print "Invalid argument \"{$argv[1]}\"";
		exit(1);
		break;
}

if (!($st instanceof DataFixer)) {
	print "Error: ".get_class($st)." is not instanceof ".DataFixer::class."!\n";
	exit(1);
}

$st->run();
