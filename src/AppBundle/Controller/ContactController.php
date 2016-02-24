<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Contact controller.
 *
 * @Route("/contact")
 */
class ContactController extends Controller
{
    /**
     * Display Contact information and Contact form
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return array
     *
     * @Route("", name="contact")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        // Create contact Form (no FormType because there is no underlying Entity)
        $contactForm = $this->createFormBuilder([])
            ->add('email',   EmailType::class,    [ 'required' => true ])
            ->add('subject', TextType::class,     [ 'required' => true ])
            ->add('content', TextareaType::class, [ 'required' => true ])
            ->getForm();

        if ($request->isMethod('POST')) {
            // Process the Form if the User is submitting data
            $contactForm->handleRequest($request);

            if ($contactForm->isValid()) {
                // Send email (use the email defined in About entity as receiver)
                $data = $contactForm->getData();

                // Load contact email stored in About Entity
                /** @var \AppBundle\Entity\About $about */
                $about = $this->getDoctrine()->getRepository('AppBundle:About')->findOne();

                // Build Email
                $message = \Swift_Message::newInstance();
                $message
                    ->setContentType('text/html')
                    ->setFrom($data['email'])
                    ->setTo($about->getEmail())
                    ->setSubject('Nokturnal Clash Contact : ' . $data['subject'])
                    ->setBody($data['content'])
                ;

                try {
                    // Send mail
                    $this->get('mailer')->send($message);

                    // Display success message
                    $this->addFlash('success', $this->get('translator')->trans('contact.message.sent', array()));

                    // Redirect (even if it's to the same route) to avoid User sending multiple emails by refreshing the Page
                    return $this->redirectToRoute('contact');
                } catch(\Exception $e) {
                    // Display error message
                    $this->addFlash('success', $this->get('translator')->trans('contact.message.not_sent', array()));
                }
            }
        }

        return $this->render('::Contact/index.html.twig', [
            'contactForm' => $contactForm->createView(),
        ]);
    }
}