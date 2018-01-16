<?php


    namespace App\Services\Sources;

    use Symfony\Component\Yaml\Yaml;
    use GuzzleHttp\Client as HttpClient;
    use Symfony\Component\DomCrawler\Crawler;

    trait SourceCoreTrail
    {
        /**
         * Nombre de la fuente de información.
         *
         * @var string
         */
        //protected $name = '';

        /**
         * Arreglo de configuraciones obtenido
         * desde el archivo de configuración
         * file: collate.yml
         *
         * @var array
         */
        public $config;

        /**
         * En este arreglo se almacenan los datos
         * obtenidos desde las fuentes configuradas.
         *
         * @var array
         */
        public $items = [];

        /**
         * Contenido obtenido en el request realizado
         * a las fuentes de datos.
         *
         * @var string
         */
        public $html;

        /**
         * Pasar contenido html obtenido desde la
         * pagina de la fuente.
         *
         * @param $html
         */
        function setHtml($html)
        {
            $this->html = $html;
        }

        /**
         * Obtener contenido html obtenido desde
         * una fuente configurada.
         *
         * @return mixed
         */
        public function getHtml()
        {
            return $this->html;
        }

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
         * Crear un nuevo item en el repositorio.
         * Los items agregados via este método se recorrerán
         * para ser mostrados en la comparación.
         *
         * @param SourceItemsData $sourceItemsData
         */
        function newItem(SourceItemsData $sourceItemsData)
        {
            $this->items[] = $sourceItemsData;
        }

        /**
         * Obtener todos los items agregados al repositorio.
         *
         * @return array
         */
        public function getItems()
        {
            return $this->items;
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
         * Obtener el contenido de las webs de las fuentes.
         *
         * @param        $uri
         * @param string $method
         * @param array  $options
         * @return Crawler
         */
        public function getPageContentCrawler($uri, $method = 'GET', $options = array())
        {

            $client = new HttpClient();
            $res    = $client->request($method, $uri, $options);
            $html   = 'INI'.$res->getBody().'END';

            if ($res->getStatusCode() !== 200) {
                //return $res->getStatusCode();
            }

            $this->setHtml($html);

            return new Crawler( $this->getHtml() );
        }
    }