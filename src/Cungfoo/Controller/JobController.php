<?php

namespace Cungfoo\Controller;

use Silex\Application,
Silex\ControllerCollection,
Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
Symfony\Component\Routing\Route;

class JobController implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->get('/', function () use ($app)
        {
            $jobs = \Cungfoo\Model\JobQuery::create()
                ->orderByCreatedAt(\Criteria::DESC)
                ->find()
            ;

            return $app['twig']->render('Job/list.twig', array(
                'jobs' => $jobs
            ));
        })
        ->bind('job_list');

        $controllers->get('/{id}', function ($id) use ($app)
        {
            $job = \Cungfoo\Model\JobQuery::create()
                ->filterById($id)
                ->findOne()
            ;

            if (null === $job)
            {
                throw new \Exception(sprintf('La page de log doit faire référence à un job'));
            }

            $jobLogs = \Cungfoo\Model\JobLogQuery::create()
                ->filterByJobId($job->getId())
                ->orderById(\Criteria::ASC)
                ->find()
            ;

            return $app['twig']->render('Job/list_log.twig', array(
                'name' => $job->getType(),
                'jobLogs' => $jobLogs
            ));
        })
        ->bind('job_log_list');

        return $controllers;
    }
}
