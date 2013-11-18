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
                $node->appendChild($dom->createTextNode('http://' . $app['request']->getHttpHost() . '/images/passerelle/min/' . $camping->getCode() . '.jpg'));
                $campingDom->appendChild($node);

                $node = $dom->createElement('bigimage');
                $node->appendChild($dom->createTextNode('http://' . $app['request']->getHttpHost() . '/images/passerelle/max/' . $camping->getCode() . '.jpg'));
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
                    '"' . str_replace('"', '""', $camping->getRegion()->getName()) . '"',
                    '"' . str_replace('"', '""', $camping->getVille()->getName()) . '"',
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
                $node->appendChild($dom->createTextNode(sprintf('%s | %s | %s', preg_replace("/\([^)]+\)/", "", $camping->getVille()->getName()), $camping->getName(), $app->trans('criteo.name.suffix'))));
                $campingDom->appendChild($node);

                $node = $dom->createElement('smallimage');
                $node->appendChild($dom->createTextNode('http://' . $app['request']->getHttpHost() . '/images/passerelle/min/' . $camping->getCode() . '.jpg'));
                $campingDom->appendChild($node);

                $node = $dom->createElement('bigimage');
                $node->appendChild($dom->createTextNode('http://' . $app['request']->getHttpHost() . '/images/passerelle/max/' . $camping->getCode() . '.jpg'));
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

                $description = '';
                $codes = array();
                foreach ($camping->getSituationGeographiques() as $situation) {
                    $codes[$situation->getCode()] = $situation->getName();
                }

                if (array_key_exists('MDIR', $codes)) {
                    $description = $codes['MDIR'];
                }
                else if (array_key_exists('M2K', $codes)) {
                    $description = $codes['M2K'];
                }
				
                if (!$description) {
                    $codesB = array();
                    foreach ($camping->getBaignades() as $baignade) {
                        $codesB[$baignade->getCode()] = $baignade->getName();
                    }

                    if (array_key_exists('PCOU', $codesB)) {
                        $description = $codesB['PCOU'];
                    }
                    else if (array_key_exists('PAAQ', $codesB)) {
                        $description = $codesB['PAAQ'];
                    }
                    else if (array_key_exists('TOBO', $codesB)) {
                        $description = $codesB['TOBO'];
                    }
					else if (array_key_exists('PISC', $codesB)) {
                        $description = $codesB['PISC'];
                    }
                }
				unset($codesB);

				if (!$description) {
					if (array_key_exists('AMON', $codes)) {
						$description = $codes['AMON'];
					}
					else if (array_key_exists('BOLA', $codes)) {
						$description = $codes['BOLA'];
					}
					else if (array_key_exists('BORI', $codes)) {
						$description = $codes['BORI'];
					}
					else if (array_key_exists('PEAU', $codes)) {
						$description = $codes['PEAU'];
					}
					else if (array_key_exists('CAMO', $codes)) {
						$description = $codes['CAMO'];
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

                $inStock = $camping->getMinimumPrice() ? 1 : 0;
                $node = $dom->createElement('recommendable');
                $node->appendChild($dom->createTextNode($inStock));
                $campingDom->appendChild($node);

                $node = $dom->createElement('instock');
                $node->appendChild($dom->createTextNode($inStock));
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

		$controllers->match('/csv/ematch', function (Request $request) use ($app)
        {
            $campings = EtablissementQuery::create()
                ->findActive()
            ;

            $lines = array();
            $lines[] = implode(',', array(
                'id',
				'name',
				'shortdescription',
				'description',
				'smallimage',
				'bigimage',
				'producturl',
				'price'
            ));

            foreach ($campings as $camping)
            {
				$short_description = '';
                $codes = array();
				
                foreach ($camping->getSituationGeographiques() as $situation) {
                    $codes[$situation->getCode()] = $situation->getName();
                }

				if (array_key_exists('MDIR', $codes)) {
                    $short_description = $codes['MDIR'];
                }
                else if (array_key_exists('M2K', $codes)) {
                    $short_description = $codes['M2K'];
                }
				
                if (!$short_description) {
                    $codesB = array();
                    foreach ($camping->getBaignades() as $baignade) {
                        $codesB[$baignade->getCode()] = $baignade->getName();
                    }

                    if (array_key_exists('PCOU', $codesB)) {
                        $short_description = $codesB['PCOU'];
                    }
                    else if (array_key_exists('PAAQ', $codesB)) {
                        $short_description = $codesB['PAAQ'];
                    }
                    else if (array_key_exists('TOBO', $codesB)) {
                        $short_description = $codesB['TOBO'];
                    }
					else if (array_key_exists('PISC', $codesB)) {
                        $short_description = $codesB['PISC'];
                    }
                }
				unset($codesB);

				if (!$short_description) {
					if (array_key_exists('AMON', $codes)) {
						$short_description = $codes['AMON'];
					}
					else if (array_key_exists('BOLA', $codes)) {
						$short_description = $codes['BOLA'];
					}
					else if (array_key_exists('BORI', $codes)) {
						$short_description = $codes['BORI'];
					}
					else if (array_key_exists('PEAU', $codes)) {
						$short_description = $codes['PEAU'];
					}
					else if (array_key_exists('CAMO', $codes)) {
						$short_description = $codes['CAMO'];
					}
				}

				$description = str_replace('"', '""', $camping->getDescription());
				$description = str_replace("\n", ' ', strip_tags($description));
				$description = str_replace("\r", ' ', $description);
				$description = html_entity_decode($description,ENT_NOQUOTES,"UTF-8");

                $lines[] = implode(',', array(
                    $camping->getCode(),
                    '"' . str_replace('"', '""', $camping->getName()) . '"',
					'"' . str_replace('"', '""',$short_description) . '"',
                    '"' . $description . '"',
                    '"http://' . $app['request']->getHttpHost() . '/images/passerelle/min/' . $camping->getCode() . '.jpg"',
                    '"http://' . $app['request']->getHttpHost() . '/images/passerelle/max/' . $camping->getCode() . '.jpg"',
                    '"'.$app->url('destination_camping', array(
                        'pays' => $camping->getVille()->getRegion()->getPays()->getSlug(),
                        'region' => $camping->getVille()->getRegion()->getSlug(),
                        'ville' => $camping->getVille()->getSlug(),
                        'camping' => $camping->getSlug()
                    ))
					.'?utm_source=Ematch&utm_medium=email&utm_campaign=retargeting"',
                    $camping->getMinimumPrice()
                ));
            }

            return new Response(implode("\n", $lines), 200, array('Content-Type' => 'text/csv', 'Content-Disposition' => 'attachment; filename="ematch.csv'));
        })
        ->bind('api_ematch_csv');

        return $controllers;
    }
}
