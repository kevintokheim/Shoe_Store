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
        protected function tearDown()
        {
            Store::deleteAll();

        }

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

        function test_getAll()
        {
            //Arrange
            $store_name = "Flying Shoes";
            $store_name2 = "Magic Shoes";
            $test_store = new Store($store_name);
            $test_store->save();
            $test_store2 = new Store($store_name2);
            $test_store2->save();

            //Act
            $result = Store::getAll();

            //Assert
            $this->assertEquals([$test_store, $test_store2], $result);
        }

        function test_save()
        {
            //Arrange
            $store_name = "Flying Shoes";
            $id = 1;
            $test_store = new Store($store_name, $id);
            $test_store->save();

            //Act
            $result = Store::getAll();

            //Assert
            $this->assertEquals($test_store, $result[0]);
        }

        function test_deleteAll()
        {
            //Arrange
            $store_name = "Flying Shoes";
            $test_store = new Store($store_name);
            $test_store->save();

            //Act
            Store::deleteAll();
            $result = Store::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $store_name = "Flying Shoes";
            $id = 1;
            $test_store = new Store($store_name, $id);
            $test_store->save();

            //Act
            $result = Store::find($test_store->getId());

            //Assert
            $this->assertEquals($test_store, $result);
        }
    }
































?>
