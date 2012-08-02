<?php

namespace Cungfoo\Controller;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Route;

/**
 * @author Morgan Brunot <brunot.morgan@gmail.com>
 */
class CrudController implements ControllerProviderInterface
{
    private $modelName;

    private $modelClass;

    private $formType;

    public function __construct($modelName, $modelClass, $formType)
    {
        $this->modelName  = $modelName;
        $this->modelClass = $modelClass;
        $this->formType   = $formType;
    }

    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        $modelName  = $this->modelName;
        $modelClass = $this->modelClass;
        $formType   = $this->formType;

        $prefix     = sprintf('crud_controller.%s.', $this->modelName);

        if (null !== $this->modelClass)
        {
            $app[$prefix.'model_class'] = $this->modelClass;
        }

        if (isset($app[$prefix.'model_class']))
        {
            $app[$prefix.'query_class'] = $app[$prefix.'model_class'] . 'Query';
        } else
        {
            throw new \InvalidArgumentException(
                sprintf('You have to configure the "%s.model_class" parameter.', $prefix)
            );
        }

        $controllers = $app['controllers_factory'];

        // Returns all objects
        $controllers->get('/', function () use ($app, $prefix)
        {
            $query = new $app[$prefix.'query_class'];

            $peerName = sprintf('%sPeer', $this->modelClass);

            return $app['twig']->render('Crud/list.twig', array(
                'name'       => $this->modelName,
                'fieldnames' => $peerName::getFieldNames(),
                'collection' => $query->find()->exportTo($app['twig_collection_parser']),
            ));
        })
        ->bind(sprintf('%s_crud_list', $modelName))
        ;

        // Returns a specific object identified by a given id
        $controllers->get('/{id}/show', function ($id) use ($app, $prefix)
        {
            $query  = new $app[$prefix.'query_class'];
            $object = $query->findPk($id);

            if (!$object instanceof $app[$prefix.'model_class'])
            {
                throw new NotFoundHttpException(
                    sprintf('%s with id "%d" does not exist.', ucfirst($this->modelName), $id)
                );
            }

            $peerName = sprintf('%sPeer', $this->modelClass);

            return $app['twig']->render('Crud/show.twig', array(
                'name'       => $this->modelName,
                'fieldnames' => $peerName::getFieldNames(),
                'object'     => $object->exportTo($app['twig_object_parser']),
            ));
        })
        ->bind(sprintf('%s_crud_show', $modelName))
        ;

        //Create a new object
        $controllers->get('/edit/{id}', function ($id = null, Request $request) use ($app, $prefix)
        {
            $peerName  = sprintf('%sPeer', $this->modelClass);
            $queryName = sprintf('%sQuery', $this->modelClass);

            if (null == $id)
            {
                $model = new $this->modelClass();
            }
            else
            {
                $model = $queryName::create()
                    ->filterById($id)
                    ->findOne()
                ;

                if (null == $model)
                {
                    throw new \Exception('Object not found');
                }
            }

            if (!class_exists($this->formType))
            {
                throw new \Exception('Définir la classe');
            }

            $form = $app['form.factory']->create(new $this->formType($app), $model);

            // display the form
            return $app['twig']->render('Crud/edit.twig', array(
                'name' => $this->modelName,
                'form' => $form->createView(),
            ));

        })
        ->value('id', null)
        ->bind(sprintf('%s_crud_edit', $modelName))
        ;

        // Create a new object
        $controllers->post('/edit/{id}', function ($id = null, Request $request) use ($app, $prefix)
        {
            $peerName  = sprintf('%sPeer', $this->modelClass);
            $queryName = sprintf('%sQuery', $this->modelClass);

            if (null == $id)
            {
                $model = new $this->modelClass();
            }
            else
            {
                $model = $queryName::create()
                    ->filterById($id)
                    ->findOne()
                ;

                if (null == $model)
                {
                    throw new \Exception('Object not found');
                }
            }

            if (!class_exists($this->formType))
            {
                throw new \Exception('Définir la classe');
            }

            $form = $app['form.factory']->create(new $this->formType($app), $model);

            if ('POST' == $request->getMethod())
            {
                $form->bind($app['request']->get($form->getName()));

                if ($form->isValid())
                {
                    $model->save();

                    return $app->redirect($app['url_generator']->generate(sprintf('%s_crud_show', $this->modelName), array('id' => $model->getId())));
                }
            }

            // display the form
            return $app['twig']->render('Crud/edit.twig', array(
                'name' => $this->modelName,
                'form' => $form->createView()
            ));
        })
        ->value('id', null)
        ->bind(sprintf('%s_crud_create', $modelName))
        ;

        // Delete a object identified by a given id
        $controllers->get('/delete/{id}', function ($id) use ($app, $prefix)
        {
            $queryName = sprintf('%sQuery', $this->modelClass);
            $model = $queryName::create()
                ->filterById($id)
                ->findOne()
            ;

            if (null == $model)
            {
                throw new \Exception('Object not found');
            }

            $model->delete();

            return $app->redirect($app['url_generator']->generate(sprintf('%s_crud_list', $this->modelName)));
        })
        ->bind(sprintf('%s_crud_delete', $modelName))
        ;

        return $controllers;
    }
}
