<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Gallery\Gallery;

/**
 * Galleries controller
 *
 * @Route("/galleries")
 */
class GalleryController extends Controller
{
    /**
     * Lists all Gallery entities.
     * @param \AppBundle\Entity\Gallery\Gallery $gallery
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/{id}", name="galleries", defaults={"id" = null})
     * @Method("GET")
     */
    public function indexAction(Gallery $gallery = null)
    {
        $galleries = $this->getDoctrine()->getManager()->getRepository('AppBundle:Gallery\Gallery')->findAll();

        if (empty($gallery) && !empty($galleries)) {
            // Take the first gallery of the list as default
            $gallery = $galleries[0];
        }

        return $this->render('::Gallery/index.html.twig', [
            'galleries' => $galleries,
            'current'   => $gallery,
        ]);
    }

    /**
     * Finds and displays a Gallery entity.
     * @param \AppBundle\Entity\Gallery\Gallery
     * @return array
     *
     * @Route("/{id}", name="gallery_show")
     * @Method("GET")
     */
    public function showAction(Gallery $gallery)
    {
        return $this->render('::Gallery/show.html.twig', [
            'gallery' => $gallery,
        ]);
    }

    /**
     * Creates a new Gallery entity
     * @param Request $request
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/new", name="gallery_new")
     * @Method({"Get", "POST"})
     */
    public function newAction(Request $request)
    {
        $entity = new Gallery();

        $form = $this->createForm(new GalleryType(), $entity, array(
            'action' => $this->generateUrl('song_create'),
            'method' => 'POST',
        ));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('gallery_show', array('id' => $entity->getId())));
        }

        return array(
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Song entity.
     *
     * @Route("/{id}/edit", name="gallery_edit")
     * @Method("GET")
     */
    public function editAction(Gallery $gallery)
    {

        $form = $this->createForm(new SongType(), $gallery, array(
            'action' => $this->generateUrl('song_update', array('id' => $gallery->getId())),
            'method' => 'PUT',
        ));

        return array(
            'form'   => $form->createView(),
        );
    }
}
