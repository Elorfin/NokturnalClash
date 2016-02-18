<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Blog\Post;
use AppBundle\Form\PostType;

/**
 * Blog controller.
 *
 * @Route("/blog")
 */
class BlogController extends Controller
{
    /**
     * List all Blog posts
     * @return array
     *
     * @Route("", name="blog")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $posts = $this->getDoctrine()->getRepository('AppBundle:Blog\Post')->findAll();

        return [
            'posts' => $posts,
        ];
    }

    /**
     * Show a Post of the Blog
     * @param \AppBundle\Entity\Blog\Post $post
     * @return array
     *
     * @Route("/{id}", name="blog_show", requirements={"id" = "\d+"})
     * @Method("GET")
     * @Template()
     */
    public function showAction(Post $post)
    {
        return [
            'post' => $post
        ];
    }

    /**
     * Display creation Form and Create a new Post in the Blog
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return array
     *
     * @Route("/new", name="blog_new")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function newAction(Request $request)
    {
        // Create the Form
        $post = new Post();
        $form = $this->createForm(new PostType(), $post);

        // Check if the form is submitted or just rendered
        $this->handleForm($form, $post, $request);

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * Display edition Form and Edit a Post of the Blog
     * @param \AppBundle\Entity\Blog\Post $post
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return array
     *
     * @Route("/{id}", name="blog_edit", requirements={"id" = "\d+"})
     * @Method({"GET", "PUT"})
     * @Template()
     */
    public function editAction(Post $post, Request $request)
    {
        // Create the Form
        $form = $this->createForm(new PostType(), $post, [ 'method' => 'PUT' ]);

        // Check if the form is submitted or just rendered
        $this->handleForm($form, $post, $request);

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * Submit a Post form
     * @param  FormInterface $form
     * @param  Post $post
     * @param  Request $request
     * @return RedirectResponse
     */
    protected function handleForm(FormInterface $form, Post $post, Request $request)
    {
        if ($request->isMethod($form->getConfig()->getMethod())) {
            // Process the Form if the User is submitting data
            $form->handleRequest($request);

            if ($form->isValid()) {
                // Save entity
                $this->getDoctrine()->getManager()->persist($post);
                $this->getDoctrine()->getManager()->flush();

                // Redirect to the show Post action
                return $this->redirectToRoute('blog_show', [ 'id' => $post->getId() ]);
            }
        }
    }
}