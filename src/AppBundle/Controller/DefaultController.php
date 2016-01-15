<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use AppBundle\Entity\Subscription;


class DefaultController extends Controller
{


    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        $subscription = new Subscription();

        $form = $this->createFormBuilder($subscription)
            ->add('name', TextType::class)
            ->add('email', EmailType::class)
            ->add('topic', EntityType::class, array(
                'class' => 'AppBundle:Topic',
                'choice_label' => 'name',
            ))
            ->add('save', SubmitType::class, array('label' => 'Subscribe!'))
            ->getForm();

        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($subscription);
            $em->flush();

            $this->addFlash(
                'success',
                'You have subscribed to the newsletter!'
            );

            return $this->redirectToRoute('homepage');

        }


        return $this->render('default/index.html.twig', [
            'form'          => $form->createView(),
            'base_dir'      => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ]);
    }



    /**
     * @Route("/subscribe/newsletter", name="subscribe")
     */
    public function subscribeAction($newsletter, Request $request)
    {

    }


}







