<?php

namespace App\Controller;

use App\Entity\Sondage;
use App\Form\SondageType;
use App\Repository\SondageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
#[Route('/sondage')]
class SondageController extends AbstractController
{
    #[Route('/', name: 'app_sondage_index', methods: ['GET'])]
    #[Security('is_granted("ROLE_ADMIN")')]
    public function index(SondageRepository $sondageRepository): Response
    {
        return $this->render('sondage/index.html.twig', [
            'sondages' => $sondageRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_sondage_new', methods: ['GET', 'POST'])]
    #[Security('is_granted("ROLE_ADMIN")')]
    public function new(Request $request, SondageRepository $sondageRepository): Response
    {
        $sondage = new Sondage();
        $form = $this->createForm(SondageType::class, $sondage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();
            if ($image) {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();
                $newFilename = 'images/upload/' . $originalFilename . '.' . $extension;

    
                    $image->move(
                        $this->getParameter('dossier_images'),
                        $newFilename
                    );
                
    
                $sondage->setImage($newFilename);
            }
            $sondageRepository->save($sondage, true);

            return $this->redirectToRoute('app_sondage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sondage/new.html.twig', [
            'sondage' => $sondage,
            'form' => $form,
        ]);
    }

    #[Route('/{sondageId}', name: 'app_sondage_show', methods: ['GET'])]
    #[Security('is_granted("ROLE_ADMIN")')]
    public function show(Sondage $sondage): Response
    {
        return $this->render('sondage/show.html.twig', [
            'sondage' => $sondage,
        ]);
    }

    #[Route('/{sondageId}/edit', name: 'app_sondage_edit', methods: ['GET', 'POST'])]
    #[Security('is_granted("ROLE_ADMIN")')]
    public function edit(Request $request, Sondage $sondage, SondageRepository $sondageRepository): Response
    {
        $form = $this->createForm(SondageType::class, $sondage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();
            if ($image) {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();
                $newFilename = '/images/upload/' . $originalFilename . '.' . $extension;
                $image->move(
                    $this->getParameter('dossier_images'),
                    $newFilename
                );
                $sondage->setImage($newFilename);
            }
            $sondageRepository->save($sondage, true);

            return $this->redirectToRoute('app_sondage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sondage/edit.html.twig', [
            'sondage' => $sondage,
            'form' => $form,
        ]);
    }

    /*#[Route('/{sondageId}', name: 'app_sondage_delete', methods: ['POST'])]
    public function delete(Request $request, Sondage $sondage, SondageRepository $sondageRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sondage->getSondageId(), $request->request->get('_token'))) {
            $sondageRepository->remove($sondage, true);
        }

        return $this->redirectToRoute('app_sondage_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/{sondageId}', name: 'app_sondage_delete')]
    public function delete($id,ManagerRegistry $doctrine){
        $sondage=$doctrine->getRepository(Sondage::class)->find($sondageId);
        $av=$doctrine->getManager();
        $av->remove($sondage);
        $av->flush();
        return $this->redirectToRoute('app_sondage_index');
    }*/
    #[Route('deleteSondage/{sondageId}', name: 'app_sondage_delete')]
    #[Security('is_granted("ROLE_ADMIN")')]
    public function delete($sondageId,ManagerRegistry $doctrine): Response
    {
        $sondage= $doctrine->getRepository(Sondage::class)->find($sondageId);
        $em=$doctrine->getManager();
        $em->remove($sondage);
        $em->flush();
        return $this->redirectToRoute('app_sondage_index');


    }
    
    #[Route('/user', name: 'app_sondage_index_user', methods: ['GET'])]
    #[Security('not is_granted("ROLE_ADMIN") and is_granted("ROLE_USER")')]
    public function indexuser(SondageRepository $sondageRepository): Response
    {
        return $this->render('sondage/indexuser.html.twig', [
            'sondages' => $sondageRepository->findAll(),
        ]);
    }
}

