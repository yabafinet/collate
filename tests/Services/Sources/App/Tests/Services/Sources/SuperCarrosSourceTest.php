<?php

    namespace App\Tests\Services\Sources;

    use App\Services\Sources\Repositories\SuperCarrosSource;
    use App\Services\Sources\SourceBase;
    use PHPUnit\Framework\TestCase;

    class SuperCarrosSourceTest extends TestCase
    {

        /** @var  SourceBase */
        public $source;

        function setUp()
        {
            $this->source = new SourceBase();
        }

        /** @test */
        function scratchingTest()
        {
            $super = new SuperCarrosSource();
//            $super->setHtml(
//                file_get_contents(__DIR__."/html/supercarros.html")
//            );
            $results     = $super->startScratching();

            print_r($results[23]);

            $this->assertEquals($results[23]->branch, 'Toyota');
            $this->assertEquals($results[23]->model, 'Land');
        }

    }
