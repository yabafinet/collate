<?php


    namespace App\Services\Sources;


    class SourceItemsData
    {
        public $branch;
        public $model;
        public $location;
        public $price = 0.0;


        /**
         * SourceData constructor.
         *
         * @param $branch
         * @param $model
         * @param $price
         * @param $location
         */
        function __construct($branch, $model, $price, $location)
        {
            $this->branch   = $branch;
            $this->model    = $model;
            $this->location = $location;

            $this->setPrice($price);
        }

        function setPrice($price)
        {
            $price       = str_replace(['US','$','DO',' ',','],'', $price);
            $this->price = number_format($price);
        }


        function getData()
        {
            return $this;
        }

    }