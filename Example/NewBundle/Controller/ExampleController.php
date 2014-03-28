<?php

namespace Example\NewBundle\Controller;

use Doctrine\ORM\EntityRepository;
use Example\NewBundle\Entity\Example;
use Example\NewBundle\Form\Type\Example\EditType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

/**
 * Example controller.
 *
 * @Route("/example")
 */
class ExampleController extends Controller
{


    /**
     * @Route("/add", name="example_new_add")
     * @Template("ExampleNewBundle:Example:edit.html.twig")
     */
    public function createAction()
    {
        return $this->editAction();
    }
    /**
     * @Route("/edit/{id}", name="example_new_edit", requirements={"id" = "\d+"})
     * @Template()
     */
    public function editAction()
    {
        $request = $this->getRequest();
        $exampleId = $request->get('id');
        if (!empty($exampleId)) {//update
            $repository = $this->getDoctrine()
                ->getRepository('ExampleNewBundle:Example');
            $example = $repository->find($exampleId);
        } else {//new
            /* @var $example Example */
            $example = new Example();
        }

        $form = $this->createForm(new EditType(), $example);
        $form->handleRequest($request);

        if ($form->isValid()) {
            /** @var ExampleManager $exampleManager */
            $exampleManager = $this->get('example.new.manager');
            $exampleManager->saveExample($example);

            $em = $this->getDoctrine()->getManager();
            $em->persist($example);
            $em->flush();

            $flashMessage = 'Example #' . $example->getId()
                . ' successfully ' . (($exampleId) ? 'updated' : 'created');
            $this->get('session')->getFlashBag()->add('notice', $flashMessage);
            return $this->redirect($this->generateUrl('example_new_edit'));
        }

        return array('form' => $form->createView(),
            'example' => $example,
            'success' => false);
    }



}
