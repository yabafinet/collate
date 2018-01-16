<?php


    namespace App\Services\Sources;


    interface SourcesCarsInterface
    {

        function getName();
        function newItem(SourceItemsData $sourceItemsData);
        /**
         * @return SourceItemsData
         */
        function startScratching();
    }