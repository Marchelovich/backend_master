<?php

namespace App\Event;

use App\Model\Product;
use App\Storage\Reader;
use App\Storage\Writer;

require_once 'src/Storage/Reader.php';
require_once 'src/Storage/Writer.php';
require_once 'ProductEventInterface.php';
require_once 'src/Model/Product.php';

class EventUpdate implements ProductEventInterface {

	private int $id;
	private ?string $name;
	private ?float $price;

	public function __construct(int $id, ?string $name = null, ?float $price = null)
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
		$reader = new Reader();
		$writer = new Writer();

		/** @var Product $product */
		$product = unserialize($reader->read($this->id));
		$output =  'Product updated:';
		if ($this->name && $this->name !== $product->getName()) {
			$product->setName($this->name);
			$output .= ' ' . $this->name;
		}
		if ($this->price  && $this->price !== $product->getPrice()) {
			$product->setPrice($this->price);
			$output .= ' ' . number_format($this->price, 2, ',', '.');
		}
		$writer->update($this->id, serialize($product));


		echo $output . "\n";
	}
}
