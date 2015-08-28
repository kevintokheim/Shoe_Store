<?php

    /**
    * @backupGlobals disabled
    * @backupStatic Attributes disabled
    */

    require_once "src/Brand.php";

    $server = 'mysql:host=localhost;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class BrandTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Brand::deleteAll();
        }

        function test_setBrandName()
        {
            //Arrange
            $brand_name = "Nike";
            $test_brand = new Brand($brand_name);

            //Act
            $test_brand->setBrandName("Nike");
            $result = $test_brand->getBrandName();

            //Assert
            $this->assertEquals("Nike", $result);
        }

        function test_getBrandName()
        {
            //Arrange
            $brand_name = "Nike";
            $test_brand = new Brand($brand_name);

            //Act
            $result = $test_brand->getBrandName();

            //Assert
            $this->assertEquals("Nike", $result);
        }

        function test_getId()
        {
            //Arrange
            $brand_name = "ADIDAS";
            $id = 1;
            $test_brand = new Brand($brand_name, $id);

            //Act
            $result = $test_brand->getId();

            //Assert
            $this->assertEquals(1, $result);
        }

        function test_getAll()
        {
            //Arrange
            $brand_name = "Puma";
            $test_brand = new Brand($brand_name);
            $test_brand->save();
            $brand_name2 = "Nike";
            $test_brand2 = new Brand($brand_name2);
            $test_brand2->save();

            //Act
            $result = Brand::getAll();

            //Assert
            $this->assertEquals([$test_brand, $test_brand2], $result);
        }

        function test_save()
        {
            //Arrange
            $brand_name = "Puma";
            $test_brand = new Brand($brand_name);
            $test_brand->save();

            //Act
            $result = Brand::getAll();

            //Assert
            $this->assertEquals($test_brand, $result[0]);
        }

        function test_deleteAll()
        {
            //Arrange
            $brand_name = "Nike";
            $test_brand = new Brand($brand_name);
            $test_brand->save();

            //Act
            Brand::deleteAll();
            $result = $test_brand->getAll();

            //Assert
            $this->assertEquals([], $result);
        }
    }
































?>
