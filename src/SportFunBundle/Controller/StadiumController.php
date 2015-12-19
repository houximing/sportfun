<?php

namespace SportFunBundle\Controller;

use SportFunBundle\Entity\StadiumTennis;
use SportFunBundle\Form\StadiumTennisType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SportFunBundle\Entity\Stadium;
use SportFunBundle\Form\StadiumType;

/**
 * Stadium controller.
 *
 * @Route("/stadium")
 */
class StadiumController extends Controller
{

    /**
     * Lists all Stadium entities.
     *
     * @Route("/", name="stadium")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SportFunBundle:Stadium')->findAll();
        return array(
            'entities' => $entities,
        );
    }

    /**
     * Lists all Stadium entities.
     *
     * @Route("/list", name="stadium_list")
     * @Method("POST")
     * @Template()
     */
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $suburb = $request->get('suburb');
        $suburb = $em->find('SportFunBundle:Suburb',$suburb);
        $entities = $em->getRepository('SportFunBundle:Stadium')->findAllAroundSuburb($suburb);

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Stadium detail.
     *
     * @Route("/details/{id}", name="stadium_details")
     * @Method("GET")
     * @Template()
     */
    public function detailAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $stadium = $em->find('SportFunBundle:Stadium',$id);
        $stadiumTennisForm = $this->createForm(new StadiumTennisType(), $stadium, array(
            'action' => $this->generateUrl('stadium_create'),
            'method' => 'POST',
            'data' => [
                'stadium' => $stadium
            ]
        ));
        return array(
            'entity' => $stadium,
            'staForm' => $stadiumTennisForm->createView()
        );
    }

    /**
     * Creates a new Stadium entity.
     *
     * @Route("/", name="stadium_create")
     * @Method("POST")
     * @Template("SportFunBundle:Stadium:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Stadium();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $this->uploadLogo($entity);
            $em->persist($entity);
            $em->flush();
            $this->updateStadiumType($request, $entity->getId());

            return $this->redirect($this->generateUrl('stadium_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Stadium entity.
     *
     * @param Stadium $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Stadium $entity)
    {
        $form = $this->createForm(new StadiumType(), $entity, array(
            'action' => $this->generateUrl('stadium_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create','attr'=>[
            'class' => 'btn btn-success'
        ]));

        return $form;
    }

    /**
     * Displays a form to create a new Stadium entity.
     *
     * @Route("/new", name="stadium_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Stadium();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Stadium entity.
     *
     * @Route("/{id}", name="stadium_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SportFunBundle:Stadium')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Stadium entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Stadium entity.
     *
     * @Route("/{id}/edit", name="stadium_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SportFunBundle:Stadium')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Stadium entity.');
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
    * Creates a form to edit a Stadium entity.
    *
    * @param Stadium $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Stadium $entity)
    {
        $form = $this->createForm(new StadiumType(), $entity, array(
            'action' => $this->generateUrl('stadium_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update','attr'=>[
            "class" => "btn btn-success"
        ]));

        return $form;
    }
    /**
     * Edits an existing Stadium entity.
     *
     * @Route("/{id}", name="stadium_update")
     * @Method("PUT")
     * @Template("SportFunBundle:Stadium:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SportFunBundle:Stadium')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Stadium entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
        if ($editForm->isValid()) {
            $this->uploadLogo($entity);
            $em->flush();
            $this->updateStadiumType($request, $entity->getId());

            return $this->redirect($this->generateUrl('stadium_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Stadium entity.
     *
     * @Route("/{id}", name="stadium_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SportFunBundle:Stadium')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Stadium entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('stadium'));
    }

    /**
     * Creates a form to delete a Stadium entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('stadium_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete', 'attr'=> ['class' => 'btn btn-danger']))
            ->getForm()
        ;
    }

    private function uploadLogo($entity){
        /** @var UploadedFile $logoFile */
        $logoFile = $entity->getLogo();
        $fileName = md5(uniqid()).'.'.$logoFile->guessExtension();
        $logoDir = $this->container->getParameter('kernel.root_dir') . '/../web/uploads/logos';

        $logoFile->move($logoDir,$fileName);
        $entity->setLogo($fileName);
    }

    private function updateStadiumType($request, $id)
    {
        $data = $request->get('sportfunbundle_stadium');
        $this->getDoctrine()->getManager()->getRepository('SportFunBundle:Stadium')->updateMapType($id, $data['type']);
    }
}
