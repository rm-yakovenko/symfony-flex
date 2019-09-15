<?php


namespace App\Admin;

use App\Spec\PostSpec;
use Sonata\AdminBundle\Route\RouteCollection;

class DeletedPostAdmin extends AbstractPostAdmin
{
    protected $baseRoutePattern = '/app/deleted-post';

    protected $baseRouteName = 'app_deleted_post';

    protected function configureRoutes(RouteCollection $collection)
    {
        parent::configureRoutes($collection);
        $collection->remove('create')
            ->remove('delete');
    }

    protected function getQuerySpec()
    {
        return PostSpec::deleted();
    }
}
