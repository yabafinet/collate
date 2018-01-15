<?php


    namespace App\Services\Sources\Repositories;

    use App\Services\Sources\SourcesCarsInterface;

    class SuperCarrosSource implements SourcesCarsInterface
    {

        protected $name = 'Supercarros.com';

        function getPrices($brand, $model, $type)
        {
            return 1.0;
        }

        /**
         * @return string
         */
        public function getName()
        {
            return $this->name;
        }
    }