<?php

namespace App\Event;

use App\Storage\Writer;

require_once 'src/Storage/Writer.php';
require_once 'ProductEventInterface.php';
require_once 'src/Model/Product.php';

class EventDelete implements ProductEventInterface {

	private int $id;

	public function __construct(int $id)
	{
		$this->id    = $id;
	}

	public function handle() {
		$writer = new Writer();
		$writer->delete($this->id);

		echo sprintf("Product deleted: %d\n", $this->id);
	}
}
