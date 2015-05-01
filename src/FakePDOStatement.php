<?php
namespace Kir\FakePDO;

use Kir\FakePDO\EventHandlers\EventHandler;
use Kir\FakePDO\EventHandlers\EventHandlerTrait;
use Kir\FakePDO\Tools\MethodNameGenerator;
use PDO;
use PDOStatement;

class FakePDOStatement extends PDOStatement {
	use EventHandlerTrait;

	/** @var array */
	private $attributes = null;
	/** @var MethodNameGenerator */
	private $methodNameGenerator = null;

	/**
	 * @param EventHandler $eventHandler
	 */
	public function __construct(EventHandler $eventHandler = null) {
		$this->setEventHandler($eventHandler);
		$this->methodNameGenerator = new MethodNameGenerator('PDOStatement');
	}

	/**
	 * @param array|null $bound_input_params
	 * @return bool
	 */
	public function execute($bound_input_params = NULL) {
		$methodName = $this->methodNameGenerator->getQualifiedMethodName(__FUNCTION__);
		return $this->invokeEventHandler($methodName, array($bound_input_params), function () {
			return true;
		});
	}

	/**
	 * @param int|null $fetch_style
	 * @param int $cursor_orientation
	 * @param int $cursor_offset
	 * @return mixed
	 */
	public function fetch($fetch_style = null, $cursor_orientation = PDO::FETCH_ORI_NEXT, $cursor_offset = 0) {
		$methodName = $this->methodNameGenerator->getQualifiedMethodName(__FUNCTION__);
		return $this->invokeEventHandler($methodName, array($fetch_style, $cursor_orientation, $cursor_offset), function () {
			return [];
		});
	}

	/**
	 * @param mixed $parameter
	 * @param mixed $variable
	 * @param int $data_type
	 * @param int|null $length
	 * @param int|null $driver_options
	 * @return bool|mixed
	 */
	public function bindParam($parameter, &$variable, $data_type = PDO::PARAM_STR, $length = null, $driver_options = null) {
		$methodName = $this->methodNameGenerator->getQualifiedMethodName(__FUNCTION__);
		return $this->invokeEventHandler($methodName, array($parameter, $variable, $data_type, $driver_options), function () {
			return true;
		});
	}

	/**
	 * @param mixed $column
	 * @param mixed $param
	 * @param int $type
	 * @param int $maxlen
	 * @param mixed $driverdata
	 * @return bool|void
	 */
	public function bindColumn($column, &$param, $type = null, $maxlen = null, $driverdata = null) {
		$methodName = $this->methodNameGenerator->getQualifiedMethodName(__FUNCTION__);
		return $this->invokeEventHandler($methodName, array($column, $param, $type, $maxlen, $driverdata), function () {
			return true;
		});
	}

	/**
	 * @param mixed $parameter
	 * @param mixed $value
	 * @param int $data_type
	 * @return bool|mixed
	 */
	public function bindValue($parameter, $value, $data_type = PDO::PARAM_STR) {
		$methodName = $this->methodNameGenerator->getQualifiedMethodName(__FUNCTION__);
		return $this->invokeEventHandler($methodName, array($parameter, $value, $data_type), function () {
			return true;
		});
	}

	/**
	 * @return int
	 */
	public function rowCount() {
		$methodName = $this->methodNameGenerator->getQualifiedMethodName(__FUNCTION__);
		return $this->invokeEventHandler($methodName, array(), function () {
			return 0;
		});
	}

	/**
	 * @param int $column_number
	 * @return string
	 */
	public function fetchColumn($column_number = 0) {
		$methodName = $this->methodNameGenerator->getQualifiedMethodName(__FUNCTION__);
		return $this->invokeEventHandler($methodName, array(), function () {
			return '';
		});
	}

	/**
	 * @param mixed|null $how
	 * @param mixed|null $class_name
	 * @param array|null $ctor_args
	 * @return array
	 */
	public function fetchAll($how = NULL, $class_name = NULL, $ctor_args = NULL) {
		$methodName = $this->methodNameGenerator->getQualifiedMethodName(__FUNCTION__);
		return $this->invokeEventHandler($methodName, array(), function () {
			return [];
		});
	}

	/**
	 * @param string $class_name
	 * @param array $ctor_args
	 * @return mixed
	 */
	public function fetchObject($class_name = NULL, $ctor_args = NULL) {
		$methodName = $this->methodNameGenerator->getQualifiedMethodName(__FUNCTION__);
		return $this->invokeEventHandler($methodName, array(), function () {
			return new \stdClass();
		});
	}

	/**
	 * @return string
	 */
	public function errorCode() {
		$methodName = $this->methodNameGenerator->getQualifiedMethodName(__FUNCTION__);
		return $this->invokeEventHandler($methodName, array(), function () {
			return '';
		});
	}

	/**
	 * @return array
	 */
	public function errorInfo() {
		$methodName = $this->methodNameGenerator->getQualifiedMethodName(__FUNCTION__);
		return $this->invokeEventHandler($methodName, array(), function () {
			return [0, 0, 0];
		});
	}

	/**
	 * @param int $attribute
	 * @return mixed
	 */
	public function getAttribute($attribute) {
		$methodName = $this->methodNameGenerator->getQualifiedMethodName(__FUNCTION__);
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
		$methodName = $this->methodNameGenerator->getQualifiedMethodName(__FUNCTION__);
		return $this->invokeEventHandler($methodName, array($attribute, $value), function ($attribute, $value) {
			$attribute = json_encode($attribute);
			$this->attributes[$attribute] = $value;
			return true;
		});
	}

	/**
	 *
	 */
	public function columnCount() {
		$methodName = $this->methodNameGenerator->getQualifiedMethodName(__FUNCTION__);
		return $this->invokeEventHandler($methodName, array(), function () {
			return 0;
		});
	}

	/**
	 * @param int $column
	 * @return array
	 */
	public function getColumnMeta($column) {
		$methodName = $this->methodNameGenerator->getQualifiedMethodName(__FUNCTION__);
		return $this->invokeEventHandler($methodName, array($column), function () {
			return [];
		});
	}

	/**
	 * @param int $mode
	 * @return bool
	 */
	public function setFetchMode($mode) {
		$methodName = $this->methodNameGenerator->getQualifiedMethodName(__FUNCTION__);
		return $this->invokeEventHandler($methodName, array($mode), function () {
			return true;
		});
	}

	/**
	 * @return bool
	 */
	public function nextRowset() {
		$methodName = $this->methodNameGenerator->getQualifiedMethodName(__FUNCTION__);
		return $this->invokeEventHandler($methodName, array(), function () {
			return true;
		});
	}

	/**
	 * @return bool
	 */
	public function closeCursor() {
		$methodName = $this->methodNameGenerator->getQualifiedMethodName(__FUNCTION__);
		return $this->invokeEventHandler($methodName, array(), function () {
			return true;
		});
	}

	/**
	 * @return bool
	 */
	public function debugDumpParams() {
		$methodName = $this->methodNameGenerator->getQualifiedMethodName(__FUNCTION__);
		return $this->invokeEventHandler($methodName, array(), function () {
			return true;
		});
	}
}
