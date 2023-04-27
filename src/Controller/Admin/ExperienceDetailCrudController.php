<?php

namespace App\Controller\Admin;

use App\Entity\ExperienceDetail;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class ExperienceDetailCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ExperienceDetail::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextareaField::new('name'),
            AssociationField::new('experience')
        ];
    }
}
