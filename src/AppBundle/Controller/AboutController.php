<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use AppBundle\Entity\About;
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
     * @Template()
     */
    public function indexAction()
    {
        // We do nothing because About data are already available through all the Application via a Twig extension
        return [];
    }

    /**
     * Display edition form and Edit About
     * @param Request $request
     * @return array
     *
     * @Route("/edit", name="about_edit")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function editAction(Request $request)
    {
        $about = $this->getDoctrine()->getRepository('AppBundle:About')->findOne();
        $form = $this->createForm(new AboutType(), $about);

        if ($request->isMethod('POST')) {
            // Process the Form if the User is submitting data
            $form->handleRequest($request);

            if ($form->isValid()) {
                // Save entity
                $this->getDoctrine()->getManager()->persist($about);
                $this->getDoctrine()->getManager()->flush();

                // Redirect to the show Post action
                return $this->redirectToRoute('about');
            }
        }

        return [
            'form' => $form->createView(),
        ];
    }
}
