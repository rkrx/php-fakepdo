<?php
namespace Kir\FakePDO\EventHandlers;

class RegistryEventHandler implements EventHandler {
	/** @var array[] */
	private $handlers = [];

	/**
	 * @param string $eventName
	 * @param callable $callback
	 * @param callable $filterFn
	 * @return $this
	 */
	public function add($eventName, callable $callback, callable $filterFn = null) {
		/*if(!array_key_exists($eventName, $this->handlers)) {
			$this->handlers[$eventName] = [];
		}*/
		$this->handlers[$eventName] = [
			'callback' => $callback,
			'filterFn' => $filterFn
		];
		return $this;
	}

	/**
	 * @param string $eventName
	 * @param array $params
	 * @param object $callee
	 * @return mixed
	 */
	public function invoke($eventName, array $params = [], $callee) {
		if(!$this->isResponsible($eventName, $params, $callee)) {
			return null;
		}
		$handler = $this->handlers[$eventName];
		if($handler['filterFn'] === null || call_user_func($handler['filterFn'], $eventName, $params, $callee)) {
			return call_user_func($handler['callback'], $eventName, $params, $callee);
		}
		return null;
	}

	/**
	 * @param string $eventName
	 * @param array $params
	 * @param object $callee
	 * @return bool
	 */
	public function isResponsible($eventName, array $params, $callee) {
		return array_key_exists($eventName, $this->handlers);
	}
}
