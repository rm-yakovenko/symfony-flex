<?php


namespace App\Admin;

use App\Entity\Post;
use App\Repository\PostRepository;
use Happyr\DoctrineSpecification\EntitySpecificationRepositoryInterface;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

abstract class AbstractPostAdmin extends AbstractAdmin
{
    use AdminSpecificationTrait;

    /**
     * @var PostRepository
     */
    private $postRepository;

    public function __construct($code, $class, $baseControllerName, PostRepository $postRepository)
    {
        parent::__construct($code, $class, $baseControllerName);
        $this->postRepository = $postRepository;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id')
            ->add('title')
            ->add('content');
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('id')
            ->add('title')
            ->add('content')
            ->add('_action', null, [
                'actions' => [
                    'show'   => [],
                    'edit'   => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
            ->add('title')
            ->add('content');
    }

    protected function getQueryRepository(): EntitySpecificationRepositoryInterface
    {
        return $this->postRepository;
    }

    /**
     * @param Post $object
     * @return string
     */
    public function toString($object)
    {
        return "#{$object->getId()} {$object->getTitle()}";
    }
}
