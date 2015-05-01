<?php
namespace Kir\FakePDO\Tools;

class MethodNameGenerator {
	/** @var string */
	private $className = null;

	/**
	 * @param string $className
	 */
	public function __construct($className) {
		$this->className = $className;
	}

	/**
	 * @param string $methodName
	 * @return string
	 */
	public function getQualifiedMethodName($methodName) {
		return "{$this->className}::{$methodName}";
	}
}
