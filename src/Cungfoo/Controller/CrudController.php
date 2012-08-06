<?php

namespace Cungfoo\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\Routing\Route;

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

    public function __construct($modelName, $modelClass, $formType)
    {
        $this->modelName  = $modelName;
        $this->modelClass = $modelClass;
        $this->queryClass = $modelClass.'Query';
        $this->peerClass  = $modelClass.'Peer';
        $this->formType   = $formType;
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
            ->generateList    ($app, $controllers)
            ->generateRead    ($app, $controllers)
            ->generateUpdate  ($app, $controllers)
            ->generateDelete  ($app, $controllers)
        ;

        return $controllers;
    }

    protected function generateList(Application $app, ControllerCollection $controllers)
    {
        $controllers
            ->get('/', function () use ($app)
            {
                $query = new $this->queryClass();

                return $app['twig']->render('Crud/list.twig', array(
                    'name'       => $this->modelName,
                    'fieldnames' => call_user_func($this->peerClass.'::getFieldNames'),
                    'collection' => $query->find()->exportTo($app['twig_collection_parser']),
                ));
            })
            ->bind(sprintf('%s_crud_list', $this->modelName))
        ;
        return $this;
    }

    protected function generateRead(Application $app, ControllerCollection $controllers)
    {
        $controllers
            ->get('/{id}', function ($id) use ($app)
            {
                $query  = new $this->queryClass();
                $object = $query->findPk($id);

                if ($object === null)
                {
                    throw new NotFoundHttpException(sprintf('%s with id "%d" does not exist.', ucfirst($this->modelName), $id));
                }

                return $app['twig']->render('Crud/read.twig', array(
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
            ->match('/{id}/update', function ($id = null, Request $request) use ($app)
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
                        return $app->redirect($app['url_generator']->generate(sprintf('%s_crud_read', $this->modelName), array('id' => $object->getId())));
                    }
                }

                // display the form
                return $app['twig']->render('Crud/update.twig', array(
                    'name' => $this->modelName,
                    'form' => $form->createView(),
                ));

            })
            ->value('id', null)
            ->bind(sprintf('%s_crud_update', $this->modelName))
        ;
        return $this;
    }

    protected function generateDelete(Application $app, ControllerCollection $controllers)
    {
        $controllers
            ->get('/delete/{id}', function ($id) use ($app)
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
}
