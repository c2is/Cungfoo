<?php

namespace Cungfoo\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\Routing\Route;

use Cungfoo\Lib\Listing\Listing,
    Cungfoo\Lib\Listing\Filler,
    Cungfoo\Lib\Listing\Column,
    Cungfoo\Model\Metadata,
    Cungfoo\Model\MetadataQuery,
    Cungfoo\Form\Type\MetadataType,
    Cungfoo\Model\Seo,
    Cungfoo\Model\SeoQuery,
    Cungfoo\Form\Type\SeoType,
    Cungfoo\Form\Type\ContextType;

/**
 * CRUD controllers provider.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 * @author  Denis Roussel <denis.roussel@gmail.com>
 */
class CrudController implements ControllerProviderInterface
{
    protected
        $modelName,
        $modelClass,
        $formType,
        $prefix;

    public function __construct($modelName, $modelClass, $formType, $prefix)
    {
        $this->modelName  = $modelName;
        $this->modelClass = $modelClass;
        $this->queryClass = $modelClass.'Query';
        $this->peerClass  = $modelClass.'Peer';
        $this->formType   = $formType;
        $this->prefix     = $prefix;
    }

    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        if (!class_exists($this->modelClass))
        {
            throw new \Exception(sprintf('Class %s undefined.', $this->modelClass));
        }

        $controllers = $app['controllers_factory'];

        $controllers->match(sprintf('/%s/metadata', $this->prefix), array($this, 'metadata'))
            ->bind(sprintf('%s_crud_metadata', $this->modelName))
        ;

        $controllers->match(sprintf('/%s/seo', $this->prefix), array($this, 'seo'))
            ->bind(sprintf('%s_crud_seo', $this->modelName))
        ;

        $controllers->match(sprintf('/%s/{slug}/{page}', $this->prefix), array($this, 'listing'))
            ->assert('page', '\d+')
            ->value('page', 1)
            ->assert('slug', 'pages')
            ->value('slug', 'pages')
            ->bind(sprintf('%s_crud_list', $this->modelName))
        ;

        $controllers->match(sprintf('/%s/create', $this->prefix), array($this, 'update'))
            ->bind(sprintf('%s_crud_create', $this->modelName))
        ;

        $controllers->match(sprintf('/%s/{id}/update', $this->prefix), array($this, 'update'))
            ->assert('id', '\d*')
            ->bind(sprintf('%s_crud_update', $this->modelName))
        ;

        $controllers->match(sprintf('/%s/{id}/delete', $this->prefix), array($this, 'delete'))
            ->assert('id', '\d*')
            ->bind(sprintf('%s_crud_delete', $this->modelName))
        ;

        $controllers->match(sprintf('/%s/{id}/active', $this->prefix), array($this, 'active'))
            ->assert('id', '\d*')
            ->bind(sprintf('%s_crud_active', $this->modelName))
        ;

        return $controllers;
    }

    function metadata(Application $app, Request $request) {
        $peerClass = $this->peerClass;

        $object = MetadataQuery::create()
            ->filterByTableRef($peerClass::TABLE_NAME)
            ->findOne()
        ;

        if (!$object) {
            $object = new Metadata();
            $object->setTableRef($peerClass::TABLE_NAME);
        }


        $form = $app['form.factory']->create(new MetadataType($app), $object);
        if ('POST' == $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $object->saveFromCrud($form);

                return $app->redirect($app['url_generator']->generate(sprintf('%s_crud_list', $this->modelName)));
            }
        }

        return $app['twig']->render('Crud/metadata.twig', array(
            'name' => $this->modelName,
            'form' => $form->createView(),
        ));
    }

    function seo(Application $app, Request $request) {
        $peerClass = $this->peerClass;

        $object = SeoQuery::create()
            ->filterByTableRef($peerClass::TABLE_NAME)
            ->findOne()
        ;

        if (!$object) {
            $object = new Seo();
            $object->setTableRef($peerClass::TABLE_NAME);
        }

        $form = $app['form.factory']->create(new SeoType($app), $object);
        if ('POST' == $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $object->saveFromCrud($form);

                return $app->redirect($app['url_generator']->generate(sprintf('%s_crud_list', $this->modelName)));
            }
        }

        return $app['twig']->render('Crud/seo.twig', array(
            'name' => $this->modelName,
            'form' => $form->createView(),
        ));
    }

    function listing(Application $app, Request $request, $page) {
        $utils = new \Cungfoo\Lib\Utils();
        $queryContextualized    = $app['context']->contextualizeQuery(new $this->queryClass());

        // Context form
        $contextForm    = $app['form.factory']->create(new ContextType($app));
        $contextRender  = $app['twig']->render('context.twig', array(
            'form'          => $contextForm->createView(),
            'allowedFields' => $app['context']->getAllowedContextByQuery($queryContextualized),
        ));

        // Listing
        $listingClass           = sprintf("\Cungfoo\Listing\%sListing", $utils->camelize($this->modelName));
        $listing                = new $listingClass($app);

        $paginator = $queryContextualized->paginate($page, 50);

        $listing->setFiller(new Filler\PropelFiller($paginator->getResults()));

        return $app['twig']->render('Crud/list.twig', array(
            'name'         => $this->modelName,
            'column_names' => $listing->getColumnNames(),
            'lines'        => $listing->render(),
            'context'      => $contextRender,
            'paginator'    => $paginator,
        ));
    }

    function update(Application $app, Request $request, $id = null) {
        $object = call_user_func($this->queryClass.'::create')
            ->filterById($id)
            ->findOne()
        ;

        if (!$object && null !== $id) {
            throw new NotFoundHttpException(sprintf('%s with id "%d" does not exist.', ucfirst($this->modelName), $id));
        }

        if (!$object) {
            $object = new $this->modelClass();
        }

        if (!class_exists($this->formType)) {
            throw new \Exception(sprintf('Class %s undefined.', $this->formType));
        }

        $form = $app['form.factory']->create(new $this->formType($app), $object);

        if ('POST' == $request->getMethod()) {
            $form->bindRequest($request);
            if ($form->isValid()) {
                $object->saveFromCrud($form);

                return $app->redirect($app['url_generator']->generate(sprintf('%s_crud_list', $this->modelName)));
            }
        }

        return $app['twig']->render('Crud/update.twig', array(
            'name' => $this->modelName,
            'form' => $form->createView(),
        ));
    }

    function active(Application $app, Request $request, $id) {
        $query  = new $this->queryClass();
        $object = $query->findPk($id);
        $object
            ->setActive(!$object->getActive())
            ->save()
        ;

        return new Response(json_encode(array('active' => $object->getActive())), 200, array (
            'Content-Type' => 'application/json',
        ));
    }

    function delete(Application $app, Request $request, $id) {
        $object = call_user_func($this->queryClass.'::create')
            ->filterById($id)
            ->findOne()
        ;

        if (!$object){
            throw new NotFoundHttpException(sprintf('%s with id "%d" does not exist.', ucfirst($this->modelName), $id));
        }

        $object->delete();

        return $app->redirect($app['url_generator']->generate(sprintf('%s_crud_list', $this->modelName)));
    }
}
