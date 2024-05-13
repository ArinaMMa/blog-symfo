<?php 

namespace App\Controller\Backend;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/categories', name: 'admin.categories')]
class CategoryController extends AbstractController {
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    #[Route('', name: '.index', methods: ['GET'])]
    public function index(CategoryRepository $categoryRepo): Response {
        return $this->render('Backend/Categories/index.html.twig', [
            'categories' => $categoryRepo->findAll(),
        ]);
    }

    //Modifier une catégorie
    #[Route('/update', name: '.update', methods:['GET', 'POST'])]
    public function update(?Category $category, Request $request) : Response|RedirectResponse {
        //catégory existe ? --> message error et redirect
        if(!$category) {
            $this->addFlash('error', 'La catégorie n\'existe pas dans la base de données');
            return $this->redirectToRoute('admin.categories.index');
        }
        //créer form de update et récupérer request
        
        //si form soumis et validé, persist BDD + redirect

        //afficher form dasn twig
    }

    //Créer une nouvelle catégorie
    #[Route('/create', name: '.create', methods: ['GET', 'POST'])]
    public function create(Request $request): Response {
        $category = new Category();

        $form = $this->createForm(CategoryType::class, $category); 
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($category);
            $this->em->flush();

            $this->addFlash('success', 'Catégorie créée');
            return $this->redirectToRoute('admin.categories.index');
        }
        return $this->render('Backend/Categories/create.html.twig', [
            'form' => $form,
        ]);
    }

}