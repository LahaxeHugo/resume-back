<?php

namespace App\Controller\Admin;

use App\Entity\SiteDetail;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SiteDetailCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SiteDetail::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
