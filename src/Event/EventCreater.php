<?php

namespace App\Event;

require_once 'EventCreate.php';
require_once 'EventDelete.php';
require_once 'EventUpdate.php';

class EventCreater {
	const CREATE_EVENT = 'cli/product_create.php';
	const UPDATE_EVENT = 'cli/product_update.php';
	const DELETE_EVENT = 'cli/product_delete.php';

	public static function createEvent($data) {
		switch ($data[0]) {
			case self::CREATE_EVENT:
				$event = new EventCreate((int)$data[1], $data[2], (float)$data[3]);
				break;
			case self::UPDATE_EVENT:
				$event = new EventUpdate((int)$data[1], $data[2], (float)$data[3]);
				break;
			case self::DELETE_EVENT:
				$event = new EventDelete((int)$data[1]);
				break;
			default:
				throw new \Error('Undefined event');

		}

		return $event;
	}
}
