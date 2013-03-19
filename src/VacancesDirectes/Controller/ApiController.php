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

        $controllers->match('/xml/criteo', function (Request $request) use ($app)
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
                $campingDom->setattribute('id', $camping->getCode());
                $root->appendChild($campingDom);

                $node = $dom->createElement('name');
                $node->appendChild($dom->createTextNode($camping->getName()));
                $campingDom->appendChild($node);

                $node = $dom->createElement('smallimage');
                $node->appendChild($dom->createTextNode(''));
                $campingDom->appendChild($node);

                $node = $dom->createElement('bigimage');
                $node->appendChild($dom->createTextNode(''));
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

                $node = $dom->createElement('retailprice');
                $node->appendChild($dom->createTextNode(''));
                $campingDom->appendChild($node);

                $node = $dom->createElement('discount');
                $node->appendChild($dom->createTextNode(''));
                $campingDom->appendChild($node);

                $node = $dom->createElement('recommendable');
                $node->appendChild($dom->createTextNode(''));
                $campingDom->appendChild($node);

                $node = $dom->createElement('instock');
                $node->appendChild($dom->createTextNode(''));
                $campingDom->appendChild($node);

                $node = $dom->createElement('categoryid1');
                $node->appendChild($dom->createTextNode($camping->getRegion()->getPays()->getName()));
                $campingDom->appendChild($node);

                $node = $dom->createElement('categoryid2');
                $node->appendChild($dom->createTextNode($camping->getRegion()->getName()));
                $campingDom->appendChild($node);

                $node = $dom->createElement('categoryid3');
                $node->appendChild($dom->createTextNode($camping->getVille()->getName()));
                $campingDom->appendChild($node);
            }

            return new Response($dom->saveXML(), 200, array('Content-Type' => 'application/xml'));
        })
        ->bind('api_criteo_xml');

        $controllers->match('/csv/criteo', function (Request $request) use ($app)
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
                'categoryid1',
                'categoryid2',
                'categoryid3',
            ));
            foreach ($campings as $camping)
            {
                $lines[] = implode('|', array(
                    $camping->getCode(),
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
                    '"' . str_replace('"', '""', $camping->getRegion()->getPays()->getName()) . '"',
                    '"' . str_replace('"', '""', getRegion()->getName()) . '"',
                    '"' . str_replace('"', '""', getVille()->getName()) . '"',
                ));
            }

            return new Response(implode("\n", $lines), 200, array('Content-Type' => 'text/csv', 'Content-Disposition' => 'attachment; filename="criteo.csv'));
        })
        ->bind('api_criteo_csv');

        $controllers->match('/xml/criteo_v2', function (Request $request) use ($app)
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
                $campingDom->setattribute('id', $camping->getCode());
                $root->appendChild($campingDom);

                $node = $dom->createElement('name');
                $node->appendChild($dom->createTextNode(sprintf('%s | %s | %s', $camping->getVille()->getName(), $camping->getName(), $app->trans('criteo.name.suffix'))));
                $campingDom->appendChild($node);

                $node = $dom->createElement('smallimage');
                $node->appendChild($dom->createTextNode(''));
                $campingDom->appendChild($node);

                $node = $dom->createElement('bigimage');
                $node->appendChild($dom->createTextNode(''));
                $campingDom->appendChild($node);

                $node = $dom->createElement('producturl');
                $node->appendChild($dom->createTextNode(
                    $app->url('destination_camping', array(
                        'pays' => $camping->getVille()->getRegion()->getPays()->getSlug(),
                        'region' => $camping->getVille()->getRegion()->getSlug(),
                        'ville' => $camping->getVille()->getSlug(),
                        'camping' => $camping->getSlug()
                    ))
                    . '?utm_source=criteo&utm_medium=cpc&utm_campaign=remarketing'
                ));
                $campingDom->appendChild($node);

                $situationsGeographiques = $camping->getSituationGeographiques();
                $description = '';
                foreach ($situationsGeographiques as $situation) {
                    if ($situation->getCode() == 'MDIR') {
                        $description = $situation->getName();
                        break;
                    }
                    if ($situation->getCode() == 'M2K') {
                        $description = $situation->getName();
                        break;
                    }
                }

                if (!$description) {
                    $baignades = $camping->getBaignades();
                    foreach ($baignades as $baignade) {
                        if ($baignade->getCode() == 'PCOU ') {
                            $description = $baignade->getName();
                            break;
                        }
                        if ($baignade->getCode() == 'PAAQ ') {
                            $description = $baignade->getName();
                            break;
                        }
                        if ($baignade->getCode() == 'TOBO  ') {
                            $description = $baignade->getName();
                            break;
                        }
                    }
                }

                $node = $dom->createElement('description');
                $node->appendChild($dom->createTextNode($description));
                $campingDom->appendChild($node);

                $node = $dom->createElement('price');
                $node->appendChild($dom->createTextNode($camping->getMinimumPrice()));
                $campingDom->appendChild($node);

                $node = $dom->createElement('retailprice');
                $node->appendChild($dom->createTextNode(''));
                $campingDom->appendChild($node);

                $node = $dom->createElement('discount');
                $node->appendChild($dom->createTextNode(''));
                $campingDom->appendChild($node);

                $node = $dom->createElement('recommendable');
                $node->appendChild($dom->createTextNode(''));
                $campingDom->appendChild($node);

                $node = $dom->createElement('instock');
                $node->appendChild($dom->createTextNode(''));
                $campingDom->appendChild($node);

                $node = $dom->createElement('categoryid1');
                $node->appendChild($dom->createTextNode($camping->getRegion()->getPays()->getName()));
                $campingDom->appendChild($node);

                $node = $dom->createElement('categoryid2');
                $node->appendChild($dom->createTextNode($camping->getRegion()->getName()));
                $campingDom->appendChild($node);

                $node = $dom->createElement('categoryid3');
                $node->appendChild($dom->createTextNode($camping->getVille()->getName()));
                $campingDom->appendChild($node);
            }

            return new Response($dom->saveXML(), 200, array('Content-Type' => 'application/xml'));
        })
        ->bind('api_criteo_xml_v2');

        return $controllers;
    }
}
