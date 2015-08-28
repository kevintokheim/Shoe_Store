<?php

    /**
    * @backupGlobals disabled
    * @backupStatic Attributes disabled
    */

    require_once "src/Store.php";

    $server = 'mysql:host=localhost:3306;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StoreTest extends PHPUnit_Framework_TestCase
    {
        // protected function tearDown()
        // {
        //     Store::deleteAll();
        //     Brand::deleteAll();
        // }

        function test_setStoreName()
        {
            //Arrange
            $store_name = "Flying Shoes";
            $test_store = new Store($store_name);

            //Act
            $test_store->setStoreName("Awesome Shoe Store");
            $result = $test_store->getStoreName();

            //Assert
            $this->assertEquals("Awesome Shoe Store", $result);
        }

        function test_getStoreName()
        {
            //Arrange
            $store_name = "Magic Shoes";
            $test_store = new Store($store_name);

            //Act
            $result = $test_store->getStoreName();

            //Assert
            $this->assertEquals($store_name, $result);
        }

        function test_getId()
        {
            //Arrange
            $store_name = "Magic Shoes";
            $id = 1;
            $test_store = new Store($store_name, $id);

            //Act
            $result = $test_store->getId();

            //Assert
            $this->assertEquals(1, $result);
        }
    }
?>
