<?php

namespace App\Controller\Admin;

use App\Entity\Technology;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;

class TechnologyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Technology::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Technology')
            ->setEntityLabelInPlural('Technologies')
            ->setSearchFields(['name', 'description'])
            ->setDefaultSort(['name' => 'DESC']);
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(EntityFilter::new('projects'));
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('name');
        yield TextField::new('slug')
            ->onlyWhenUpdating();
        yield TextareaField::new('description')
            ->hideOnIndex();
        yield ImageField::new('image')
            ->setBasePath('uploads/tech/')
            ->setSortable(false)
            ->addCssClass("img-thumbnail-25")
            ->addHtmlContentsToBody('<style>.img-thumbnail-25 img{height: 25px; width: auto}</style>')
            ->setUploadDir('public/uploads/tech/');
    }

}
