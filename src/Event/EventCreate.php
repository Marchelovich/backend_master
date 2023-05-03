<?php

namespace App\Event;

use App\Model\Product;
use App\Storage\Writer;

require_once 'src/Storage/Writer.php';
require_once 'src/Model/Product.php';
require_once 'ProductEventInterface.php';

class EventCreate implements ProductEventInterface {

	private int $id;
	private string $name;
	private float $price;

	public function __construct(int $id, string $name, float $price)
	{
		$this->id    = $id;
		$this->name  = $name;
		$this->price = $price;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getName(): ?string
	{
		return $this->name;
	}

	public function getPrice(): ?float
	{
		return $this->price;
	}

	public function handle() {
		$writer = new Writer();
		$writer->create($this->id, serialize(new Product($this->id, $this->name, $this->price)));

		echo sprintf("Product created: %d %s %s\n", $this->id, $this->name, number_format($this->price, 2, ',', '.'));
	}
}
