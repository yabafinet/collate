<?php


    namespace App\Services\Sources;


    interface SourcesCarsInterface
    {

        function getPrices($brand, $model, $type);
    }