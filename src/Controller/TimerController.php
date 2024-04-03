<?php

namespace App\Controller;

use App\Entity\Timer;
use App\Form\TimerType;
use App\Repository\TimerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/timer')]
class TimerController extends AbstractController
{
    #[Route('/', name: 'app_timer_index', methods: ['GET'])]
    public function index(TimerRepository $timerRepository): Response
    {
        return $this->render('timer/index.html.twig', [
            'timers' => $timerRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_timer_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $timer = new Timer();
        $form = $this->createForm(TimerType::class, $timer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($timer);
            $entityManager->flush();

            return $this->redirectToRoute('app_timer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('timer/new.html.twig', [
            'timer' => $timer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_timer_show', methods: ['GET'])]
    public function show(Timer $timer): Response
    {
        return $this->render('timer/show.html.twig', [
            'timer' => $timer,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_timer_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Timer $timer, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TimerType::class, $timer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_timer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('timer/edit.html.twig', [
            'timer' => $timer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_timer_delete', methods: ['POST'])]
    public function delete(Request $request, Timer $timer, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$timer->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($timer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_timer_index', [], Response::HTTP_SEE_OTHER);
    }
}
