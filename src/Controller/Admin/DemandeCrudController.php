<?php

namespace App\Controller\Admin;
use App\Entity\Demande;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class DemandeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Demande::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
           
            TextField::new('nom'),
            TextField::new('tel'),
            TextField::new('formation'),
            TextField::new('adresse'),
            TextField::new('annonce'),
            TextField::new('user'),
            //FileType::new('brochureFilename')->setBasePath('brochure/file/')->setUploadDir('public/brochure/file'),
        ];
    }
    
}
