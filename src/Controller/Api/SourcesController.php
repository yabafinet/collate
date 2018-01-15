<?php


    namespace App\Controller\Api;


    use App\Services\Sources\Repositories\SuperCarrosSource;
    use App\Services\Sources\SourceBase;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;

    class SourcesController extends Controller
    {
        /**
         * @var SourceBase
         */
        public $source;


        function __construct()
        {
            $this->source = new SourceBase();

        }

        /**
         *
         * @Route("/sources/search/{resource_id}")
         *
         * @param $resource_id
         * @return Response
         * @internal param $type
         */
        function search($resource_id = 0)
        {
            $results = $this->source->search();


            foreach ($results as $result) {

            }

            return new Response(
                "Resource({$resource_id}): "
            );
        }
    }