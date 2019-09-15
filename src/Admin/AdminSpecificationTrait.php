<?php


namespace App\Admin;

use Happyr\DoctrineSpecification\EntitySpecificationRepositoryInterface;
use Happyr\DoctrineSpecification\Spec;
use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery;

trait AdminSpecificationTrait
{
    public function getObject($id)
    {
        $object = $this->getQueryRepository()->matchOneOrNullResult(
            Spec::andX(
                Spec::eq('id', $id),
                $this->getQuerySpec()
            )
        );
        foreach ($this->getExtensions() as $extension) {
            $extension->alterObject($this, $object);
        }

        return $object;
    }

    public function createQuery($context = 'list')
    {
        $query = $this->getQueryRepository()->getQueryBuilder($this->getQuerySpec(), 'o');
        $query = new ProxyQuery($query);

        foreach ($this->extensions as $extension) {
            $extension->configureQuery($this, $query, $context);
        }

        return $query;
    }

    protected function getQueryRepository() : EntitySpecificationRepositoryInterface
    {
        return null;
    }

    protected function getQuerySpec()
    {
        return null;
    }
}
