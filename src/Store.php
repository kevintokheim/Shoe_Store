<?php

    class Store
    {
        private $store_name;
        private $id;

        //Constructor
        function __construct($store_name, $id = null)
        {
            $this->store_name = $store_name;
            $this->id = $id;
        }

        //Setter
        function setStoreName($new_store_name)
        {
            $this->store_name = (string) $new_store_name;
        }

        //Getters
        function getStoreName()
        {
            return $this->store_name;
        }

        function getId()
        {
            return $this->id;
        }

        //Save the information into database
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO stores (store_name) VALUES (
                '{$this->getStoreName()}'
            );");

            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        //Retrieve the information stored in the database
        static function getAll()
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores;");
            $stores = array();
            foreach ($returned_stores as $store) {
                $store_name = $store['store_name'];
                $id = $store['id'];
                $new_store = new Store($store_name, $id);
                array_push($stores, $new_store);
            }
            return $stores;
        }

        //Delete the information stored in the database
        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores;");
            $GLOBALS['DB']->exec("DELETE FROM stores_brands;");
        }

        //Find an input in the database by its id
        static function find($search_id)
        {
            $found_store = null;
            $stores = Store::getAll();
            foreach($stores as $store) {
                $store_id = $store->getId();
                if ($store_id == $search_id) {
                    $found_store = $store;
                }
            }
            return $found_store;
        }

        //Add a brand of shoe to the shoe store
        function addBrand($brand)
        {
            $GLOBALS['DB']->exec("INSERT INTO stores_brands (store_id, brand_id) VALUES (
                {$this->getId()},
                {$brand->getId()}
            );");
        }

        //Retrieve brands from the database with a join statement so the user can see
        //which brands are available in an individual store
        function getBrands()
        {
            $returned_brands = $GLOBALS['DB']->query("SELECT brands.* FROM stores
                JOIN stores_brands ON (stores.id = stores_brands.store_id)
                JOIN brands ON (stores_brands.brand_id = brands.id)
                WHERE stores.id = {$this->getId()};");

            $brands = array();
            foreach($returned_brands as $brand) {
                $brand_name = $brand['brand_name'];
                $id = $brand['id'];
                $new_brand = new Brand($brand_name, $id);
                array_push($brands, $new_brand);
            }
            return $brands;
        }

        //Deletes an individual item in the stores and stores_brands database
        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM stores_brands WHERE store_id = {$this->getId()};");
        }

        //Updates the store name
        function update($new_store_name)
        {
            $GLOBALS['DB']->exec("UPDATE stores SET store_name = '{$new_store_name}' WHERE id = {$this->getId()};");
            $this->setStoreName($new_store_name);
        }

    }


?>
