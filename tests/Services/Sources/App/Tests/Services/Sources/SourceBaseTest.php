<?php

    namespace App\Tests\Services\Sources;

    use App\Services\Sources\SourceBase;
    use App\Services\Sources\SourcesCarsInterface;
    use PHPUnit\Framework\TestCase as BaseTestCase;

    class SourceBaseTest extends BaseTestCase
    {
        /** @var  SourceBase */
        public $source;

        function setUp()
        {
            $this->source = new SourceBase();
        }

        /** @test */
        function searchTest()
        {
           $results = $this->source->search();

           $this->assertArrayHasKey('cod', $results);
        }

        /** @test */
        function verifyingRegisteredSourcesTest(){

            //var_dump($this->source->getSources());

            foreach ($this->source->getSources() as $source =>$config) {

                /** @var SourcesCarsInterface $repositoryMock */
                $repositoryMock = $this->getMockBuilder($source)->getMock();
                $prices         = $repositoryMock->getPrices('','','');

                $this->assertTrue(is_float($prices));
            }
        }

    }
