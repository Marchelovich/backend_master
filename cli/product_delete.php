<?php declare(strict_types=1);

require 'src/Storage/Writer.php';
require 'src/Storage/Reader.php';

use App\Storage\Writer;
use App\Storage\Reader;

$writer = new Writer;
$reader = new Reader;

try {
	$queue = unserialize($reader->read('queue'));
} catch (Throwable $e) {
	$queue = [];
}
$queue[] = $argv;
$writer->update('queue', serialize($queue));
