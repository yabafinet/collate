<?php


    namespace App\Services\Sources\Repositories;

    use App\Services\Sources\SourceCoreTrail;
    use App\Services\Sources\SourceItemsData;
    use App\Services\Sources\SourcesCarsInterface;
    use Symfony\Component\DomCrawler\Crawler;

    class SuperCarrosSource implements SourcesCarsInterface
    {
        use SourceCoreTrail;


        protected $name = 'supercarros.com';

        /**
         * @return string
         */
        public function getName()
        {
            return $this->name;
        }

        /**
         * Iniciar el scratching.
         *
         * @return array
         */
        function startScratching()
        {
            $crawler     = null;

            $crawlerBase = $this->getPageContentCrawler('http://www.supercarros.com/carros/');

            //var_dump($crawlerBase);

            $crawlerBase
                ->filter('div#bigsearch-results-inner-container ul > li > div > a')
                ->each(function (Crawler $node, $i) {

                    $html    = $node->html();
                    $crawler = new Crawler();

                    $crawler->addHtmlContent($html);

                    $branch_model  = explode(' ',$crawler->filterXPath('//div[@class="title1"]')->text());
                    $price         = $crawler->filterXPath('//div[@class="price"]')->text();

                    // Agregando Item
                    $this->newItem(
                        new SourceItemsData($branch_model[0], $branch_model[1],$price,'location')
                    );
            });

            return $this->getItems();
        }
    }