<?php


    namespace App\Services\Sources;


    use Symfony\Component\Yaml\Yaml;

    class SourceBase
    {

        public $config;


        /**
         * Cargando las configuraciones desde el
         * archivo de configuración principal.
         *
         * @param null $parameter
         * @return array|mixed
         */
        public function getConfig($parameter = null)
        {
            if (! isset($this->config)) {
                $this->config = Yaml::parseFile(__DIR__.'/../../../config/collate.yml');
            }

            return $parameter ? $this->config[$parameter] : $this->config;
        }

        /**
         * Obteniendo las fuentes de precios.
         *
         * @return array|mixed
         */
        public function getSources()
        {
            return $this->getConfig('sources');
        }


        /**
         * Realizando la búsqueda en las fuentes registradas.
         *
         * @return array
         */
        public function search()
        {

            return [
              'cod'=>'00'
            ];
        }
    }