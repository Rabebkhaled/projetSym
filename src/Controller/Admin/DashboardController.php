<?php

namespace App\Controller\Admin;
use App\Entity\User;
use App\Entity\Annonce;
use App\Entity\Demande;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Jobsearch');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('annonce', 'fas fa-list', Annonce::class);
        yield MenuItem::linkToCrud('User', 'fas fa-user', User::class);

        yield MenuItem::linkToCrud('demande', 'fas fa-user', Demande::class);

        //if ($this->isGranted('ROLE_ADMIN')){
        //}
    }
}
