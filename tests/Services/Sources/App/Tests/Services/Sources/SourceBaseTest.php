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
        function verifyingRegisteredSourcesDataItemsTest()
        {

            foreach ($this->source->getSources() as $source =>$config) {

                /** @var SourcesCarsInterface $repositoryMock */
                $repositoryMock = new $source();

                $this->assertInstanceOf(\App\Services\Sources\SourcesCarsInterface::class, $repositoryMock);

                $source_scratch = $repositoryMock->startScratching();

                foreach ($source_scratch as $scratch)
                {
                    $this->assertNotEmpty($scratch->branch,"branch:".$source);
                    $this->assertNotEmpty($scratch->model);
                    //$this->assertTrue($this->isCurrency($scratch->price),'price: '.$scratch->price);
                }
            }
        }


        /**
         * @param $number
         * @return int
         */
        function isCurrency($number)
        {
            return preg_match("/^\d*(\.\d{2})?$/", $number);
        }

    }
