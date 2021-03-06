<?php
namespace Kir\FakePDO;

use PDO;
use Kir\FakePDO\Tools\MethodNameGenerator;
use Kir\FakePDO\EventHandlers\EventHandler;
use Kir\FakePDO\EventHandlers\EventHandlerTrait;

class FakePDO extends PDO {
	use EventHandlerTrait;

	/** @var array */
	private $attributes = [];
	/** @var bool */
	private $inTransaction = false;
	/** @var MethodNameGenerator */
	private $methodNameGeneratorA = null;

	/**
	 * @return array
	 */
	public static function getAvailableDrivers() {
		return PDO::getAvailableDrivers();
	}

	/**
	 * @param EventHandler $eventHandler
	 */
	public function __construct(EventHandler $eventHandler = null) {
		$this->methodNameGeneratorA = new MethodNameGenerator('PDO');
		$this->setEventHandler($eventHandler);
	}

	/**
	 * @param string $statement
	 * @param array|null $options
	 * @return FakePDOStatement
	 */
	public function prepare($statement, $options = NULL) {
		$methodName = $this->methodNameGeneratorA->getQualifiedMethodName(__FUNCTION__);
		return $this->invokeEventHandler($methodName, array($statement, $options), function () {
			return new FakePDOStatement($this->getEventHandler());
		});
	}

	/**
	 * @return bool
	 */
	public function beginTransaction() {
		$methodName = $this->methodNameGeneratorA->getQualifiedMethodName(__FUNCTION__);
		return $this->invokeEventHandler($methodName, array(), function () {
			$inTransaction = $this->inTransaction();
			if($inTransaction) {
				return false;
			} else {
				$this->inTransaction = true;
				return true;
			}
		});
	}

	/**
	 * @return bool
	 */
	public function commit() {
		$methodName = $this->methodNameGeneratorA->getQualifiedMethodName(__FUNCTION__);
		return $this->invokeEventHandler($methodName, array(), function () {
			$inTransaction = $this->inTransaction();
			if($inTransaction) {
				$this->inTransaction = false;
				return true;
			} else {
				return false;
			}
		});
	}

	/**
	 * @return bool
	 */
	public function rollback() {
		$methodName = $this->methodNameGeneratorA->getQualifiedMethodName(__FUNCTION__);
		return $this->invokeEventHandler($methodName, array(), function () {
			$inTransaction = $this->inTransaction();
			if($inTransaction) {
				$this->inTransaction = false;
				return true;
			} else {
				return false;
			}
		});
	}

	/**
	 * @return bool
	 */
	public function inTransaction() {
		$methodName = $this->methodNameGeneratorA->getQualifiedMethodName(__FUNCTION__);
		return $this->invokeEventHandler($methodName, array(), function () {
			return $this->inTransaction;
		});
	}

	/**
	 * @param int $attribute
	 * @return mixed
	 */
	public function getAttribute($attribute) {
		$methodName = $this->methodNameGeneratorA->getQualifiedMethodName(__FUNCTION__);
		return $this->invokeEventHandler($methodName, array($attribute), function ($attribute) {
			$attribute = json_encode($attribute);
			if(array_key_exists($attribute, $this->attributes)) {
				return $this->attributes[$attribute];
			}
			return null;
		});
	}

	/**
	 * @param int $attribute
	 * @param mixed $value
	 * @return bool
	 */
	public function setAttribute($attribute, $value) {
		$methodName = $this->methodNameGeneratorA->getQualifiedMethodName(__FUNCTION__);
		return $this->invokeEventHandler($methodName, array($attribute, $value), function ($attribute, $value) {
			$attribute = json_encode($attribute);
			$this->attributes[$attribute] = $value;
			return true;
		});
	}

	/**
	 * @param string $statement
	 * @return int
	 */
	public function exec($statement) {
		$methodName = $this->methodNameGeneratorA->getQualifiedMethodName(__FUNCTION__);
		return $this->invokeEventHandler($methodName, array($statement), function () {
			return 1;
		});
	}

	/**
	 * @param string $statement
	 * @return FakePDOStatement
	 */
	public function query($statement, ?int $fetchMode = null, ...$fetchModeArgs) {
		$methodName = $this->methodNameGeneratorA->getQualifiedMethodName(__FUNCTION__);
		return $this->invokeEventHandler($methodName, array($statement), function () {
			return new FakePDOStatement($this->getEventHandler());
		});
	}

	/**
	 * @param string|null $name
	 * @return string|null
	 */
	public function lastInsertId($name = null) {
		$methodName = $this->methodNameGeneratorA->getQualifiedMethodName(__FUNCTION__);
		return $this->invokeEventHandler($methodName, array($name), function () {
			return null;
		});
	}

	/**
	 * @return mixed
	 */
	public function errorCode() {
		$methodName = $this->methodNameGeneratorA->getQualifiedMethodName(__FUNCTION__);
		return $this->invokeEventHandler($methodName, array(), function () {
			return null;
		});
	}

	/**
	 * @return mixed
	 */
	public function errorInfo() {
		$methodName = $this->methodNameGeneratorA->getQualifiedMethodName(__FUNCTION__);
		return $this->invokeEventHandler($methodName, array(), function () {
			return [0, 0, 0];
		});
	}

	/**
	 * @param string $string
	 * @param int $parameter_type
	 * @return string|void
	 */
	public function quote($string, $parameter_type = PDO::PARAM_STR) {
		$methodName = $this->methodNameGeneratorA->getQualifiedMethodName(__FUNCTION__);
		return $this->invokeEventHandler($methodName, array($string, $parameter_type), function ($string) {
			return $string;
		});
	}
}
