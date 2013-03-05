<?php

namespace VacancesDirectes\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Cungfoo\Model\EtablissementQuery;

class ApiController implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->match('/criteo.xml', function (Request $request) use ($app)
        {
            $campings = EtablissementQuery::create()
                ->findActive()
            ;

            $dom = new \DOMDocument('1.0', 'UTF-8');
            $dom->formatOutput = true;

            $root = $dom->createElement('products');
            $dom->appendChild($root);
            foreach ($campings as $camping)
            {
                $campingDom = $dom->createElement('product');
                $campingDom->setattribute('id', $camping->getId());
                $root->appendChild($campingDom);

                $node = $dom->createElement('name');
                $node->appendChild($dom->createTextNode($camping->getName()));
                $campingDom->appendChild($node);

                $node = $dom->createElement('producturl');
                $node->appendChild($dom->createTextNode(
                    $app->url('destination_camping', array(
                        'pays' => $camping->getVille()->getRegion()->getPays()->getSlug(),
                        'region' => $camping->getVille()->getRegion()->getSlug(),
                        'ville' => $camping->getVille()->getSlug(),
                        'camping' => $camping->getSlug()
                    ))
                ));
                $campingDom->appendChild($node);

                $node = $dom->createElement('description');
                $node->appendChild($dom->createTextNode($camping->getDescription()));
                $campingDom->appendChild($node);

                $node = $dom->createElement('price');
                $node->appendChild($dom->createTextNode($camping->getMinimumPrice()));
                $campingDom->appendChild($node);
            }

            return new Response( $dom->saveXML(), 200, array('content-type' => 'application/xml'));
        })
        ->bind('api_criteo_xml');

        $controllers->match('/criteo.csv', function (Request $request) use ($app)
        {
            $campings = EtablissementQuery::create()
                ->findActive()
            ;

            $lines = array();
            $lines[] = implode('|', array(
                'id',
                'name',
                'smallimage',
                'bigimage',
                'producturl',
                'description',
                'price',
                'retailprice',
                'discount',
                'recommendable',
                'instock',
            ));
            foreach ($campings as $camping)
            {
                $lines[] = implode('|', array(
                    $camping->getId(),
                    '"' . str_replace('"', '""', $camping->getName()) . '"',
                    '',
                    '',
                    $app->url('destination_camping', array(
                        'pays' => $camping->getVille()->getRegion()->getPays()->getSlug(),
                        'region' => $camping->getVille()->getRegion()->getSlug(),
                        'ville' => $camping->getVille()->getSlug(),
                        'camping' => $camping->getSlug()
                    )),
                    '"' . str_replace('"', '""', $camping->getDescription()) . '"',
                    $camping->getMinimumPrice(),
                    '',
                    '',
                    '',
                    '',
                ));
            }

            return new Response(implode("\n", $lines), 200, array('content-type' => 'text/csv'));
        })
        ->bind('api_criteo_csv');

        return $controllers;
    }
}
