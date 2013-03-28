<?php

namespace VacancesDirectes\Controller;

use Symfony\Component\HttpFoundation\Request;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;

use Cungfoo\Model\Newsletter;
use Cungfoo\Model\NewsletterQuery;

use \BasePeer;
use \Exception;

class AsyncController implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $ctl = $app['controllers_factory'];

        $ctl->post('/newsletter', array($this, 'newsletter'))
            ->bind('async_newsletter')
        ;

        return $ctl;
    }

    function newsletter(Application $app, Request $request) {

        try {
            $newsletterData = $request->get('Newsletter');

            $newsletterObject = NewsletterQuery::create()
                ->filterByEmail($newsletterData['email'])
                ->findOne()
            ;

            if (!$newsletterObject) {
                $newsletterObject = new Newsletter();
                $newsletterObject->fromArray($newsletterData, BasePeer::TYPE_FIELDNAME);
                $newsletterObject->save();
            }
        }
        catch (Exception $e) {
            return false;
        }

        return true;
    }
}
