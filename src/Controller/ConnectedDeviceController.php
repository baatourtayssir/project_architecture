<?php

namespace App\Controller;

use App\Entity\ConnectedDevice;
use App\Form\ConnectedDeviceType;
use App\Repository\ConnectedDeviceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

#[Route('/Connected/device')]
class ConnectedDeviceController extends AbstractController
{



    #[Route('/home', name: 'home_')]
    public function home(): Response
    {
        return $this->render('home.html.twig');
    }

   

    #[Route('/base', name: 'base_')]
    public function base(): Response
    {
        return $this->render('base.html.twig');
    }


    #[Route('/index', name: 'app_connected_device_index', methods: ['GET'])]
    public function index(ConnectedDeviceRepository $connectedDeviceRepository): Response
    {
        return $this->render('connected_device/index.html.twig', [
            'connected_devices' => $connectedDeviceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_connected_device_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $connectedDevice = new ConnectedDevice();
        $form = $this->createForm(ConnectedDeviceType::class, $connectedDevice);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Traiter l'état On/Off
            if ($form->get('isOn')->getData()) {
                $connectedDevice->turnOn();
            } else {
                $connectedDevice->turnOff();
            }
    
            $entityManager->persist($connectedDevice);
            $entityManager->flush();
    
            return $this->redirectToRoute('app_connected_device_index');
        }
    
        return $this->render('connected_device/new.html.twig', [
            'connected_device' => $connectedDevice,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_connected_device_show', methods: ['GET'])]
    public function show(ConnectedDevice $connectedDevice): Response
    {
        return $this->render('connected_device/show.html.twig', [
            'connected_device' => $connectedDevice,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_connected_device_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ConnectedDevice $connectedDevice, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ConnectedDeviceType::class, $connectedDevice);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Traiter l'état On/Off
            if ($form->get('isOn')->getData()) {
                $connectedDevice->turnOn();
            } else {
                $connectedDevice->turnOff();
            }
    
            $entityManager->flush();
    
            return $this->redirectToRoute('app_connected_device_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->render('connected_device/edit.html.twig', [
            'connected_device' => $connectedDevice,
            'form' => $form,
        ]);
    }

    #[Route('{id}', name: 'app_connected_device_delete', methods: ['POST'])]
    public function delete(Request $request, ConnectedDevice $connectedDevice, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$connectedDevice->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($connectedDevice);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_connected_device_index', [], Response::HTTP_SEE_OTHER);
    }

#[Route('/{id}/toggle', name: 'app_connected_device_toggle', methods: ['GET'])]
public function toggle(ConnectedDevice $connectedDevice, EntityManagerInterface $entityManager): Response
{
    $connectedDevice->toggle(); // Méthode pour activer ou désactiver l'appareil
    $entityManager->flush();

    return $this->redirectToRoute('app_connected_device_index');
}

}
