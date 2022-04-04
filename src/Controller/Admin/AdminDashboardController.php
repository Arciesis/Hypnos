<?php

namespace App\Controller\Admin;

use App\Entity\Establishment;
use App\Entity\Manager;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Menu\SubMenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminDashboardController extends AbstractDashboardController
{
    #[Route('/dashboard/admin', name: 'admin_dashboard')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);

        /*if (in_array('ROLE_MANAGER', $this->getUser()->getRoles())) {
            return $this->redirect($adminUrlGenerator->setDashboard(ManagerDashBoardController::class));
        } else if ($this->getUser() === null) {
            $this->redirect('/');
        } else {
           return $this->render('backoffice/admin-dashboard.html.twig');
        }*/

        return $this->render('backoffice/admin-dashboard.html.twig');

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Hypnos Admin Dashboard');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToCrud('Manager', 'fa fa-people-roof', Manager::class),
            MenuItem::linkToCrud('Establishment', 'fa-solid fa-archway', Establishment::class),

        ];
    }
}
