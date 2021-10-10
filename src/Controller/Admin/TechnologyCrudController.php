<?php

namespace App\Controller\Admin;

use App\Entity\Technology;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

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
            ->setDefaultSort(['name' => 'ASC']);
    }


    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('name')
            ->setLabel('Name');
        yield TextareaField::new('description')
            ->setLabel('Description');
        yield ImageField::new('image')
            ->setLabel('Image')
            ->setUploadDir('public/images/technology')
            ->setUploadedFileNamePattern($this->generateRandomName() . '.[extension]')
            ->setBasePath('/images/technology')
            ->hideWhenUpdating();

    }

    private function generateRandomName(): string
    {
        return bin2hex(random_bytes(6));
    }
}
