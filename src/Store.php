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
    }

?>
