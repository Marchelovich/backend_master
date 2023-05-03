<?php declare(strict_types=1);

require 'src/Storage/Reader.php';
require 'src/Storage/Writer.php';
require 'src/Event/EventCreater.php';

use App\Event\EventCreater;
use App\Storage\Reader;
use App\Storage\Writer;

$reader = new Reader;
$writer = new Writer();

$data = unserialize($reader->read('queue'));
foreach ( $data as $item ) {
	$event = EventCreater::createEvent($item);
	$event->handle();
}

$writer->delete('queue');

