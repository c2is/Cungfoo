<?php

namespace Cungfoo\Controller;

use Silex\Application,
Silex\ControllerCollection,
Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
Symfony\Component\Routing\Route;

use Cungfoo\Model\PortfolioMediaQuery;
use Cungfoo\Model\PortfolioUsageQuery;
use Cungfoo\Model\PortfolioMedia;
use Cungfoo\Listing\PortfolioMediaListing;
use Cungfoo\Form\Type\ContextType;
use Cungfoo\Form\Type\PortfolioSearchType;
use Cungfoo\Form\Data\PortfolioSearchData;
use Cungfoo\Lib\Listing\Filler;
use Cungfoo\Form\Type\PortfolioMediaType;
use Cungfoo\Model\PortfolioTag;

class PortfolioController implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->get('/', function () use ($app)
        {
            return $app['twig']->render('Crud/portfolio.twig', array());
        })
        ->bind('portfolio_dashboard');

        $controllers->get('/popin/{id}', function ($id) use ($app)
        {
            $queryContextualized    = $app['context']->contextualizeQuery(new PortfolioMediaQuery());

            $paginator = $queryContextualized->paginate(0, 50);

            $ids = explode(';', $id);

            $medias = PortfolioMediaQuery::create()
                ->filterById($ids, \Criteria::IN)
                ->find()
            ;

            $searchData = new PortfolioSearchData();
            $searchForm = $app['form.factory']->create(new PortfolioSearchType($app), $searchData);

            return $app['twig']->render('Crud/Portfolio/popin.twig', array(
                'paginator' => $paginator,
                'medias' => $medias,
                'mediaIds' => $ids,
                'form' => $searchForm->createView(),
            ));
        })
        ->value('id', null)
        ->bind('portfolio_popin');

        $controllers->match('/popin/{id}/edit', function (Request $request, $id) use ($app)
        {
            $object = PortfolioMediaQuery::create()
                ->filterById($id)
                ->findOne()
            ;

            $file = $object->getFile();

            $form = $app['form.factory']->create(new PortfolioMediaType($app), $object);
            if ('POST' == $request->getMethod()) {
                $form->bindRequest($request);

                if ($form->isValid()) {
                    $object->save();

                    $object->setFile($file);

                    return json_encode(array(
                        'id' => $id,
                        'success' => true,
                        'object' => $object->toArray(),
                        'html' => $app['twig']->render('Crud/Portfolio/table_line.twig', array(
                            'line' => $object,
                            'used' => false,
                        )),
                    ));
                }
            }

            return $app['twig']->render('Crud/Portfolio/edit.twig', array(
                'form' => $form->createView(),
            ));
        })
        ->bind('portfolio_edit');

        $controllers->post('/popin/search', function (Request $request) use ($app)
        {
            $ids = $request->get('ids');

            $searchData = new PortfolioSearchData();
            $searchForm = $app['form.factory']->create(new PortfolioSearchType($app), $searchData);
            $searchForm->bindRequest($request);

            if ($searchForm->isValid()) {
                $queryContextualized = $app['context']->contextualizeQuery(new PortfolioMediaQuery())->distinct();
                if ($searchData->getSearch()) {
                    $stringToSearch = sprintf('%%%s%%', $searchData->getSearch());
                    $queryContextualized = $queryContextualized
                        ->filterByTitle($stringToSearch)
                        ->_or()
                        ->filterByDescription($stringToSearch)
                        ->_or()
                        ->filterByFile($stringToSearch)
                        ->_or()
                        ->usePortfolioMediaTagQuery(null, \Criteria::LEFT_JOIN)
                            ->usePortfolioTagQuery(null, \Criteria::LEFT_JOIN)
                                ->filterByName($stringToSearch)
                            ->endUse()
                        ->endUse()
                    ;
                }
                if ($searchData->getTable()) {
                    $queryContextualized = $queryContextualized
                        ->usePortfolioUsageQuery()
                            ->filterByTableRef($searchData->getTable())
                    ;
                    if ($searchData->getColumn()) {
                        $queryContextualized = $queryContextualized
                            ->filterByColumnRef($searchData->getColumn())
                        ;
                    }
                    $queryContextualized = $queryContextualized->endUse();
                }
                $paginator = $queryContextualized->paginate(0, 50);

                return json_encode(array(
                    'success' => true,
                    'sql'   => $queryContextualized->toString(),
                    'html' => $app['twig']->render('Crud/Portfolio/table.twig', array(
                        'paginator' => $paginator,
                        'mediaIds' => explode(';', $ids),
                    )),
                ));
            }

            return json_encode(array(
                'success' => false,
            ));
        })
        ->bind('portfolio_search');

        $controllers->match('/popin/{id}/delete', function (Request $request, $id) use ($app)
        {
            $object = PortfolioMediaQuery::create()
                ->filterById($id)
                ->findOne()
                ->delete()
            ;

            return json_encode(array(
                'id' => $id,
                'success' => true,
            ));
        })
        ->bind('portfolio_delete');

        $controllers->post('/upload', function (Request $request) use ($app)
        {
            // retrieves the posted data, for reference
            $file = $request->get('value');
            $name = $request->get('name');

            $json = array(
                'name'    => $name,
                'success' => false,
                'html'    => null,
            );

            // get the mime
            $getMime = explode('.', $name);
            $mime    = end($getMime);

            // separete out the data
            $data = explode(',', $file);

            // encoded it correctly
            $encodedData = str_replace(' ', '+', $data[1]);
            $decodedData = base64_decode($encodedData);

            $media = new PortfolioMedia();

            // generate new name, relative and absolute path
            $image = uniqid().'_'.preg_replace('/\s+/', '_', $name);
            $absolutePath = $media->getUploadRootDir().'/'.$image;

            if (file_put_contents($absolutePath, $decodedData)) {
                $relativePath = $media->getUploadDir().'/'.$image;
                $imageInfos   = getimagesize($absolutePath);

                $media
                    ->setTitle($name)
                    ->setWidth($imageInfos[0])
                    ->setHeight($imageInfos[1])
                    ->setType($imageInfos['mime'])
                    ->setSize($media->convertFileSize(filesize($absolutePath)))
                    ->setFile($relativePath)
                    ->save()
                ;

                $json['success'] = true;
                $json['html'] = $app['twig']->render('Crud/Portfolio/table_line.twig', array(
                    'line' => $media,
                    'used' => false,
                ));
            }

            return json_encode($json);
        })
        ->bind('portfolio_upload');

        $controllers->post('/tag/add', function(Request $request) use ($app)
        {
            $tag = new PortfolioTag();
            $tag
                ->setName($request->get('tag'))
                ->save()
            ;

            return json_encode(array('html' => '<option value="'.$tag->getId().'">'.$tag->getName().'</option>'));
        })
        ->bind('portfolio_tag_add');

        $controllers->get('/list-fields', function(Request $request) use ($app)
        {
            $table = $request->get('table', '');

            $tablesUsed = PortfolioUsageQuery::create()->select('column_ref')->filterByTableRef($table)->find()->toArray();
            $tableChoices = array();
            foreach ($tablesUsed as $table) {
                $tableChoices[$table] = $table;
            }

            return json_encode($tableChoices);
        })
        ->bind('portfolio_list_fields');

        return $controllers;
    }
}
