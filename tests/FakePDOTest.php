<?php
namespace Kir\FakePDO;

use Kir\FakePDO\EventHandlers\RegistryEventHandler;

class FakePDOTest extends \PHPUnit_Framework_TestCase {
    public function test() {
        $eventHandler = new RegistryEventHandler();

        $eventHandler->add('PDOStatement::fetchColumn', function () {
            return 123;
        });

        $pdo = new FakePDO($eventHandler);
        $stmt = $pdo->prepare('SELECT 1');
        $value = $stmt->fetchColumn(0);
        $this->assertEquals(123, $value);
    }
}
