<?php
namespace Kir\FakePDO\EventHandlers;

trait EventHandlerTrait {
	/** @var EventHandler */
	private $eventHandler;

	/**
	 * @return EventHandler
	 */
	protected function getEventHandler() {
		return $this->eventHandler;
	}

	/**
	 * @param EventHandler $eventHandler
	 * @return $this
	 */
	protected function setEventHandler($eventHandler) {
		$this->eventHandler = $eventHandler;
		return $this;
	}

	/**
	 * @param string $eventName
	 * @param array $params
	 * @param callable $defaultCallback
	 * @return mixed
	 */
	protected function invokeEventHandler($eventName, array $params = array(), $defaultCallback = null) {
		$eventHandler = $this->eventHandler;
		if($eventHandler !== null && $eventHandler->isResponsible($eventName, $params, $this)) {
			return $eventHandler->invoke($eventName, $params, $this);
		}
		if($defaultCallback !== null) {
			return call_user_func($defaultCallback);
		}
		return null;
	}
}