<?php

namespace App\Controller\Api;

use App\Entity\Juguete;
use App\Form\JugueteType;
use App\Repository\JugueteRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Rest\Route("/juguete")
 */
class JugueteController extends \FOS\RestBundle\Controller\AbstractFOSRestController
{
    private $repo;

    public function __construct(JugueteRepository $jugueteRepository)
    {
        $this->repo = $jugueteRepository;
    }

    //ENDPOINTS
    //READ
    /**
     * @Rest\Get("/")
     * @Rest\View(serializerGroups={"get_juguete"}, serializerEnableMaxDepthChecks=true)
     * @return \App\Entity\Juguete[]
     */
    public function getJuguetes() {
        return $this->repo->findAll();
    }

    //READ ONE
    /**
     * @Rest\Get("/{id}")
     * @Rest\View(serializerGroups={"get_juguete"}, serializerEnableMaxDepthChecks=true)
     * @param Request $request
     * @return \App\Entity\Juguete|JsonResponse
     */
    public function getOneJuguete(Request $request) {
        //Obtener el ID
        $idJuguete = $request->get('id');

        //Buscar el ID y almacenar resultado
        $juguete = $this->repo->find($idJuguete);

        //Comprobar errores y devolver resultado
        if(!$juguete) {
            return new JsonResponse('juguete no encontrado', 400);
        }
        return $juguete;
    }

    //CREATE
    /**
     * @Rest\Post("/")
     * @Rest\View(serializerGroups={"juguete"}, serializerEnableMaxDepthChecks=true)
     * @param Request $request
     * @return mixed|JsonResponse
     */
    public function createJuguete(Request $request) {
        //Crear instancia de objeto
        $juguete = new Juguete();

        //Crear form a partir de EntType y la instancia anterior
        $form = $this->createForm(JugueteType::class, $juguete);

        //Manejar (handle) la peticion (request)
        $form->handleRequest($request);

        //Comprobar errores en el form - que está enviado (submitted) y es válido
        if(!$form->isSubmitted() || !$form->isValid()) {
            return new JsonResponse();
        }

        //Obtener los datos del form (meter en un try/catch)
        $juguete = $form->getData();

        //Repercutir en BD y devolver resultado
        $this->repo->add($juguete, true);
        return $juguete;
    }


}