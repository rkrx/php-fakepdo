<?php
namespace Kir\FakePDO\EventHandlers;

interface EventHandler {
	/**
	 * @param string $eventName
	 * @param array $params
	 * @param object $callee
	 * @return mixed
	 */
	public function invoke($eventName, array $params, $callee);

	/**
	 * @param string $eventName
	 * @param array $params
	 * @param object $callee
	 * @return bool
	 */
	public function isResponsible($eventName, array $params, $callee);
}
