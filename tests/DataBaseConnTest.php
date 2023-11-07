<?php
require('../app/libs/DataBaseConn.php');

use PHPUnit\Framework\TestCase;

class DataBaseConnTest extends TestCase {
    public $dbconn;

    public function setUp() : void {
        $this->dbconn = new DataBaseConn('localhost', 'username', 'password', 'database');
    }





    public function testDelete() {
        $result = $this->dbconn->delete('');
        $this->assertEquals(true, $result);
    }

    public function tearDown() : void {
        unset($this->dbconn);
    }
}
