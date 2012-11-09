<?php

namespace Cungfoo\Controller;

use Silex\Application,
Silex\ControllerCollection,
Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
Symfony\Component\Routing\Route;

use Symfony\Component\Filesystem\Filesystem;

use Cungfoo\Model\PortfolioMediaQuery,
    Cungfoo\Model\PortfolioMedia;

use \Exception;

class PortfolioController implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->get('/{page}', function (Request $request, $page) use ($app)
        {
            $medias = PortfolioMediaQuery::create()
                ->orderByCreatedAt(\Criteria::DESC)
                ->paginate($page, 14)
            ;

            return $app['twig']->render('Portfolio/list.twig', array(
                'medias' => $medias
            ));
        })
        ->assert('page', '\d+')
        ->value('page', 1)
        ->bind('portfolio');

        $controllers->get('/media/{id}/edit', function (Request $request, $id) use ($app)
        {
            $media = PortfolioMediaQuery::create()
                ->filterById($id)
                ->findOne()
            ;

            return $app['twig']->render('Portfolio/edit.twig', array(
                'media' => $media
            ));
        })
        ->assert('id', '\d+')
        ->bind('portfolio_media_edit');

        $controllers->get('/media/{id}/delete', function (Request $request, $id) use ($app)
        {
            $media = PortfolioMediaQuery::create()
                ->filterById($id)
                ->findOne()
            ;

            if (!$media)
            {
                throw new Exception(sprintf("Media %s Not Found", $id), 1);
            }

            $media->setWebDirectory($app['config']->get('web_dir'));
            $media->delete();

            return $app->redirect($app['url_generator']->generate('portfolio'));
        })
        ->assert('id', '\d+')
        ->bind('portfolio_media_delete');

        $controllers->match('/media/add', function (Request $request) use ($app)
        {
            $form = $app['form.factory']->createBuilder('form')
                ->add('files', 'file', array(
                    'label'     => 'Files',
                    'attr' => array(
                        'multiple'  => 'multiple',
                        'accept'    => 'image/*'
                    )
                ))->getForm()
            ;

            if ($request->getMethod() == 'POST')
            {
                $form->bind($request);

                if ($form->isValid())
                {
                    $data  = $request->files->get($form->getName());

                    $filesystem = new Filesystem();

                    foreach ($data['files'] as $file)
                    {
                        $media = new PortfolioMedia();
                        $media->setWebDirectory($app['config']->get('web_dir'));
                        $media->loadFile($file);
                        $media->save();
                    }

                    return $app->redirect($app['url_generator']->generate('portfolio'));
                }

            }

            return $app['twig']->render('Portfolio/create.twig', array(
                'form' => $form->createView(),
            ));

        })
        ->bind('portfolio_media_create');

        return $controllers;
    }
}
