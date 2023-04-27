<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\SiteDetail;
use App\Entity\Skill;
use App\Entity\Diploma;
use App\Entity\Experience;
use App\Entity\ExperienceDetail;
use App\Entity\Project;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Resume Back');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::linkToCrud('Site Details', 'fa fa-sliders', SiteDetail::class);

        yield MenuItem::linkToCrud('Skills', 'fa fa-book', Skill::class);

        yield MenuItem::linkToCrud('Diplomas', 'fa fa-graduation-cap', Diploma::class);
        
        yield MenuItem::subMenu('Experiences', 'fa fa-landmark')->setSubItems([
            MenuItem::linkToCrud('Items', 'fa fa-paperclip', Experience::class),
            MenuItem::linkToCrud('Details', 'fa fa-bars', ExperienceDetail::class)
        ]);

        yield MenuItem::linkToCrud('Projects', 'fa fa-regular fa-floppy-disk', Project::class);
    }
}
