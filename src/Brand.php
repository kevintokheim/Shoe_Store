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
    }




























?>
