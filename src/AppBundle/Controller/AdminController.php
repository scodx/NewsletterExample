<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Topic;
use AppBundle\Entity\Newsletter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AdminController extends Controller
{

    /**
     * @Route("/admin/", name="admin")
     */
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    /**
     * @Route("/admin/topics/", name="topics")
     */
    public function topicsAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $topics = $em->getRepository('AppBundle:Topic')
            ->getTopics();


        $topic = new Topic();

        $form = $this->createFormBuilder($topic)
            ->add('name', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Create Topic'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($topic);
            $em->flush();

            $this->addFlash(
                'success',
                'Your changes were saved!'
            );

            return $this->redirectToRoute('topics');

        }

        return $this->render('default/topics.html.twig', [
            'topics'    => $topics,
            'form'      => $form->createView(),
            'base_dir'  => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ]);


    }


    /**
     * @Route("/admin/newsletters/", name="newsletters")
     */
    public function newslettersAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $topics = $em->getRepository('AppBundle:Topic')
            ->getTopics();
        $newsletters = $em->getRepository('AppBundle:Newsletter')
            ->getNewsletters();


        $newsletter = new Newsletter();

        $form = $this->createFormBuilder($newsletter)
            ->add('title', TextType::class)
            ->add('body', TextareaType::class)
            ->add('topic', EntityType::class, array(
                'class' => 'AppBundle:Topic',
                'choice_label' => 'name',
//                'choices' => $topics,
            ))
            ->add('save', SubmitType::class, array('label' => 'Create Topic'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($newsletter);
            $em->flush();

            $this->addFlash(
                'success',
                'Your changes were saved!'
            );

            return $this->redirectToRoute('newsletters');

        }

        return $this->render('default/newsletters.html.twig', [
            'newsletters'    => $newsletters,
            'form'      => $form->createView(),
            'base_dir'  => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ]);


    }


}
