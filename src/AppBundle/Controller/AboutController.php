<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use AppBundle\Form\AboutType;

/**
 * About controller.
 *
 * @Route("/about")
 */
class AboutController extends Controller
{
    /**
     * Lists all About entities.
     * @return array
     *
     * @Route("", name="about")
     * @Method("GET")
     */
    public function indexAction()
    {
        $this->addFlash('success', $this->get('translator')->trans('about.message.update_success', array()));
        $this->addFlash('warning', $this->get('translator')->trans('about.message.update_success', array()));
        $this->addFlash('error', $this->get('translator')->trans('about.message.update_success', array()));

        // We do nothing because About data are already available through all the Application via a Twig extension
        return $this->render('::About/index.html.twig', []);
    }

    /**
     * Display edition form and Edit About
     * @param Request $request
     * @return array
     *
     * @Route("/edit", name="about_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request)
    {
        $about = $this->getDoctrine()->getRepository('AppBundle:About')->findOne();
        $form = $this->createForm(AboutType::class, $about);

        if ($request->isMethod('POST')) {
            // Process the Form if the User is submitting data
            $form->handleRequest($request);

            if ($form->isValid()) {
                // Save entity
                $this->getDoctrine()->getManager()->persist($about);
                $this->getDoctrine()->getManager()->flush();

                // Display confirm message
                $this->addFlash('success', $this->get('translator')->trans('about.message.update_success', array()));

                // Redirect to the show Post action
                return $this->redirectToRoute('about');
            }
        }

        return $this->render('::About/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
