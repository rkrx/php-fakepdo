<?php
namespace Kir\FakePDO\EventHandlers;

class ClosureEventHandler implements EventHandler {
	/** @var callable */
	private $callback;
	/** @var callable|null */
	private $isResponsible;

	/**
	 * ClosureEventHandler constructor.
	 * @param callable $callback
	 * @param callable $isResponsible
	 */
	public function __construct(callable $callback, callable $isResponsible = null) {
		$this->callback = $callback;
		$this->isResponsible = $isResponsible;
	}


	/**
	 * @param string $eventName
	 * @param array $params
	 * @param object $callee
	 * @return mixed
	 */
	public function invoke($eventName, array $params, $callee) {
		return call_user_func($this->callback, $eventName, $params, $callee);
	}

	/**
	 * @param string $eventName
	 * @param array $params
	 * @param object $callee
	 * @return bool
	 */
	public function isResponsible($eventName, array $params, $callee) {
		if($this->isResponsible) {
			return call_user_func($this->isResponsible, $eventName, $params);
		}
		return true;
	}
}