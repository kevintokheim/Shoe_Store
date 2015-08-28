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

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO stores (store_name) VALUES (
                '{$this->getStoreName()}'
            );");

            $this->id = $GLOBALS['DB']->lastInsertId();
        }

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

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores;");
        }

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
    }

























?>
