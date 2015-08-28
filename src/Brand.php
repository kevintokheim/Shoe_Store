<?php

    class Brand
    {
        private $brand_name;
        private $id;

        //Constructor
        function __construct($brand_name, $id = null)
        {
            $this->brand_name = $brand_name;
            $this->id = $id;
        }

        //Setter
        function setBrandName($new_brand_name)
        {
            $this->brand_name = (string) $new_brand_name;
        }

        //Getters
        function getBrandName()
        {
            return $this->brand_name;
        }

        function getId()
        {
            return $this->id;
        }

        //Saves the information to the database
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO brands (brand_name) VALUES (
                '{$this->getBrandName()}'
            );");

            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        //Retrieves the information from the database
        static function getAll()
        {
            $returned_brands = $GLOBALS['DB']->query("SELECT * FROM brands;");
            $brands = array();
            foreach ($returned_brands as $brand) {
                $brand_name = $brand['brand_name'];
                $id = $brand['id'];
                $new_brand = new Brand($brand_name, $id);
                array_push($brands, $new_brand);
            }
            return $brands;
        }

        //Deletes all information from the database
        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands;");
            $GLOBALS['DB']->exec("DELETE FROM stores_brands;");
        }

        //Finds a brand based on its id
        static function find($search_id)
        {
            $found_brand = null;
            $brands = Brand::getAll();
            foreach($brands as $brand) {
                $brand_id = $brand->getId();
                if ($brand_id == $search_id) {
                    $found_brand = $brand;
                }
            }
            return $found_brand;
        }

        //Adds a store to an individual shoe brand's page
        function addStore($store)
        {
            $GLOBALS['DB']->exec("INSERT INTO stores_brands (store_id, brand_id) VALUES(
                {$store->getId()},
                {$this->getId()}
            );");
        }

        //Retrieves stores from the database with a join statement so that the user
        //can see which stores carry a particular brand
        function getStores()
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT stores.* FROM brands
                JOIN stores_brands ON (brands.id = stores_brands.brand_id)
                JOIN stores ON (stores_brands.store_id = stores.id)
                WHERE brands.id = {$this->getId()};");

            $stores = array();
            foreach($returned_stores as $store) {
                $store_name = $store['store_name'];
                $id = $store['id'];
                $new_store = new Store($store_name, $id);
                array_push($stores, $new_store);
            }
            return $stores;
        }


        // function delete()
        // {
        //     $GLOBALS['DB']->exec("DELETE FROM brands WHERE id = {$this->getId()};");
        //     $GLOBALS['DB']->exec("DELETE FROM stores_brands WHERE brand_id = {$this->getId()};");
        // }
    }




























?>
