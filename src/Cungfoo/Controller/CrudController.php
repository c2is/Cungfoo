<?php

namespace Cungfoo\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\Routing\Route;

use Cungfoo\Lib\Listing\Listing,
    Cungfoo\Lib\Listing\Filler,
    Cungfoo\Lib\Listing\Column,
    Cungfoo\Form\Type\ContextType;

/**
 * CRUD controllers provider.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 * @author  Denis Roussel <denis.roussel@gmail.com>
 */
class CrudController implements ControllerProviderInterface
{
    protected $modelName;
    protected $modelClass;
    protected $formType;
    protected $prefix;

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

        $this
            ->generateList($app, $controllers)
            ->generateCreate($app, $controllers)
            ->generateRead($app, $controllers)
            ->generateUpdate($app, $controllers)
            ->generateDelete($app, $controllers)
        ;

        return $controllers;
    }

    protected function generateList(Application $app, ControllerCollection $controllers)
    {
        $controllers
            ->get(sprintf('/%s/{slug}/{page}', $this->prefix), function ($page) use ($app)
            {

                $utils = new \Cungfoo\Lib\Utils();
                $queryContextualized    = $app['context']->contextualizeQuery(new $this->queryClass());

                // Context form
                $contextForm    = $app['form.factory']->create(new ContextType($app));
                $contextRender  = $app['twig']->render('Cungfoo/context.twig', array(
                    'form'          => $contextForm->createView(),
                    'allowedFields' => $app['context']->getAllowedContextByQuery($queryContextualized),
                ));

                // Listing
                $listingClass           = sprintf("\Cungfoo\Listing\%sListing", $utils->camelize($this->modelName));
                $listing                = new $listingClass($app);

                $paginator = $queryContextualized->paginate($page);

                $listing->setFiller(new Filler\PropelFiller($paginator->getResults()));

                return $app['twig']->render('Cungfoo/Crud/list.twig', array(
                    'name'         => $this->modelName,
                    'column_names' => $listing->getColumnNames(),
                    'lines'        => $listing->render(),
                    'context'      => $contextRender,
                    'paginator'    => $paginator,
                ));
            })
            ->assert('page', '\d+')
            ->value('page', 1)
            ->value('slug', 'page')
            ->bind(sprintf('%s_crud_list', $this->modelName))
        ;

        return $this;
    }

    protected function generateCreate(Application $app, ControllerCollection $controllers)
    {
        $controllers
            ->match(sprintf('/%s/create', $this->prefix), function (Request $request) use ($app)
            {
                return $this->edit($request, $app);
            })
            ->value('id', null)
            ->bind(sprintf('%s_crud_create', $this->modelName))
        ;

        return $this;
    }

    protected function generateRead(Application $app, ControllerCollection $controllers)
    {
        $controllers
            ->get(sprintf('/%s/{id}', $this->prefix), function ($id) use ($app)
            {
                $query  = new $this->queryClass();
                $object = $query->findPk($id);

                if ($object === null)
                {
                    throw new NotFoundHttpException(sprintf('%s with id "%d" does not exist.', ucfirst($this->modelName), $id));
                }

                return $app['twig']->render('Cungfoo/Crud/read.twig', array(
                    'name'       => $this->modelName,
                    'fieldnames' => call_user_func($this->peerClass.'::getFieldNames'),
                    'object'     => $object->exportTo($app['twig_object_parser']),
                ));
            })
            ->bind(sprintf('%s_crud_read', $this->modelName))
        ;

        return $this;
    }

    protected function generateUpdate(Application $app, ControllerCollection $controllers)
    {
        $controllers
            ->match(sprintf('/%s/{id}/update', $this->prefix), function ($id, Request $request) use ($app)
            {
                return $this->edit($request, $app, $id);
            })
            ->value('id', null)
            ->bind(sprintf('%s_crud_update', $this->modelName))
        ;

        return $this;
    }

    protected function generateDelete(Application $app, ControllerCollection $controllers)
    {
        $controllers
            ->get(sprintf('/%s/delete/{id}', $this->prefix), function ($id) use ($app)
            {
                $object = call_user_func($this->queryClass.'::create')
                    ->filterById($id)
                    ->findOne()
                ;

                if ($object === null)
                {
                    throw new NotFoundHttpException(sprintf('%s with id "%d" does not exist.', ucfirst($this->modelName), $id));
                }

                $object->delete();

                return $app->redirect($app['url_generator']->generate(sprintf('%s_crud_list', $this->modelName)));
            })
            ->bind(sprintf('%s_crud_delete', $this->modelName))
        ;

        return $this;
    }

    protected function edit(Request $request, Application $app, $id = null)
    {
        if ($id === null)
        {
            $object = new $this->modelClass();
        }
        else
        {
            $object = call_user_func($this->queryClass.'::create')
                ->filterById($id)
                ->findOne()
            ;

            if ($object === null)
            {
                throw new NotFoundHttpException(sprintf('%s with id "%d" does not exist.', ucfirst($this->modelName), $id));
            }
        }

        if (!class_exists($this->formType))
        {
            throw new \Exception(sprintf('Class %s undefined.', $this->formType));
        }

        $form = $app['form.factory']->create(new $this->formType($app), $object);

        if ('POST' == $request->getMethod())
        {
            $form->bind($app['request']->get($form->getName()));

            if ($form->isValid())
            {
                $object->save();

                return $app->redirect($app['url_generator']->generate(sprintf('%s_crud_list', $this->modelName), array('id' => $object->getId())));
            }
        }

        return $app['twig']->render('Cungfoo/Crud/update.twig', array(
            'name' => $this->modelName,
            'form' => $form->createView(),
        ));
    }
}
