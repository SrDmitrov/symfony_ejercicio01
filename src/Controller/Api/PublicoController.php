<?php

namespace App\Controller\Api;

use App\Repository\PublicoRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Rest\Route("/publico")
 */
class PublicoController extends \FOS\RestBundle\Controller\AbstractFOSRestController
{
    private $repo;

    public function __construct(PublicoRepository $publicoRepository)
    {
        $this->repo = $publicoRepository;
    }

    //Endpoints

    //READ
    /**
     * @Rest\Get(path="/")
     * @Rest\View(serializerGroups={"get_publico"}, serializerEnableMaxDepthChecks=true)
     * @return \App\Entity\Publico[]
     */
    public function getPublico() {
        return $this->repo->findAll();
    }

    //READ one
    /**
     * @Rest\Get("/{id}")
     * @Rest\View(serializerGroups={"get_publico"}, serializerEnableMaxDepthChecks=true)
     * @param Request $request
     * @return \App\Entity\Publico|JsonResponse
     */
    public function getOnePublico(Request $request) {
        //Obtener el ID
        $idPublico = $request->get('id');

        //Buscar el ID y almacenarlo
        $publico = $this->repo->find($idPublico);

        //Comprobar errores y devolver resultado
        if(!$publico) {
            return new JsonResponse('Publico no encontrado', 400);
        }
        return $publico;
    }



}