<?php

namespace SportFunBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SportFunBundle\Entity\Suburb;
use SportFunBundle\Form\SuburbType;

/**
 * Suburb controller.
 *
 * @Route("/suburb")
 */
class SuburbController extends Controller
{

    /**
     * Lists all Suburb entities.
     *
     * @Route("/", name="suburb")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SportFunBundle:Suburb')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Suburb entity.
     *
     * @Route("/", name="suburb_create")
     * @Method("POST")
     * @Template("SportFunBundle:Suburb:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Suburb();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('suburb_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Suburb entity.
     *
     * @param Suburb $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Suburb $entity)
    {
        $form = $this->createForm(new SuburbType(), $entity, array(
            'action' => $this->generateUrl('suburb_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Suburb entity.
     *
     * @Route("/new", name="suburb_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Suburb();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Suburb entity.
     *
     * @Route("/{id}", name="suburb_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SportFunBundle:Suburb')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Suburb entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Finds and displays a Suburb entity by suburb name or postcode.
     *
     * @Route("/list/{postsub}", name="suburb_list")
     * @Method("GET")
     * @Template()
     */
    public function showSuburbAction($postsub)
    {
        $em = $this->getDoctrine()->getManager();
        
        $suburbs = $em->getRepository('SportFunBundle:Suburb')->findByNameOrPostCode($postsub);
        return [
            'suburbs' => $suburbs
        ];

    }

    /**
     * Displays a form to edit an existing Suburb entity.
     *
     * @Route("/{id}/edit", name="suburb_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SportFunBundle:Suburb')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Suburb entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Suburb entity.
    *
    * @param Suburb $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Suburb $entity)
    {
        $form = $this->createForm(new SuburbType(), $entity, array(
            'action' => $this->generateUrl('suburb_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Suburb entity.
     *
     * @Route("/{id}", name="suburb_update")
     * @Method("PUT")
     * @Template("SportFunBundle:Suburb:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SportFunBundle:Suburb')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Suburb entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('suburb_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Suburb entity.
     *
     * @Route("/{id}", name="suburb_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SportFunBundle:Suburb')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Suburb entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('suburb'));
    }

    /**
     * Creates a form to delete a Suburb entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('suburb_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
