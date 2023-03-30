<?php

namespace App\Controller;

use Utils\Str\Str;
use App\Entity\Url;
use App\Form\UrlFormType;
use App\Repository\UrlRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class UrlsController extends AbstractController
{
    private $urlRepo;
    public function __construct(UrlRepository $urlRepo)
    {
        $this->urlRepo = $urlRepo;
    }


    #[Route('/', name: 'app_home', methods: ["GET", "POST"])]
    public function create(Request $request, EntityManagerInterface $em): Response
    {

        $url = new Url;
        $form = $this->createForm(UrlFormType::class, $url);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $url = $this->urlRepo->findOneBy(['original' => $form['original']->getData()]);


            if (!$url) {
                $url = $form->getData();

                $em->persist($url);
                $em->flush();
            }

            return $this->redirectToRoute('app_urls_preview', ['shortened' => $url->getShortened()]);
        }




        return $this->render('urls/create.html.twig', ['form' => $form->createView()]);
    }

    #[Route('/preview/{shortened}', name: 'app_urls_preview', methods: ['GET'])]
    public function preview(Url $url)
    {
        return $this->redirectToRoute('urls/preview.html.twig', compact('url'));
    }

    #[Route('/{shortened}', name: 'app_urls_show', methods: ['GET'])]
    public function show(Url $url)
    {
        return $this->redirect($url->getOriginal());
    }
}
