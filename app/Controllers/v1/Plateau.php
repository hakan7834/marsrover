<?php

namespace App\Controllers\v1;

use App\Models\v1\PlateauModel;
use Throwable;
use OpenApi\Annotations as OA;

class Plateau extends \App\Controllers\BaseController
{

    /**
     *  @OA\Get(
     *      path="/v1/plateau",
     *      summary="list of Plateaus",
     *      description="Returns list of Plateaus",
     *      tags={"Plateau"},
     *      @OA\Response(
     *          response=200,
     *          description="Success"
     *      )
     *  )
     *
     * @return array|mixed
     */
    public function index()
    {
        $model = new PlateauModel();

        $data = $model->orderBy('id', 'DESC')->findAll();

        return $this->responseSuccess($data);
    }


    /**
     *  @OA\Get(
     *      path="/v1/plateau/{plateauId}",
     *      summary="Get specific Plateau",
     *      description="Get Plateau by Id",
     *      tags={"Plateau"},
     *      @OA\Parameter(
     *          name="plateauId", required=true, in="path", @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success"
     *      ),
     *     @OA\Response(
     *          response=404,
     *          description="Not found Plateau"
     *      )
     *  )
     *
     * @param null $id
     * @return array|mixed
     */
    public function show($id = null)
    {
        $model = new PlateauModel();

        $data = $model->select('name,x,y')->find($id);

        return $data ? $this->responseSuccess($data) : $this->failNotFound('Plateau could not found');
    }


    /**
     *  @OA\Post(
     *      path="/v1/plateau/create",
     *      summary="create of Plateau",
     *      description="Create Plateau by <br/> <b>name</b> : name of Plateau <br/><b>x</b> : right corrdinate of Plateau <br/><b>y</b> : upper coordinate of Plateau",
     *      tags={"Plateau"},
     *      @OA\RequestBody(
     *          @OA\MediaType(mediaType="application/json",
     *              @OA\Schema(
     *                  @OA\Property(property="name", type="string"),
     *                  @OA\Property(property="x", type="integer"),
     *                  @OA\Property(property="y", type="integer"),
     *                  required={"name", "x", "y"}
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Success"
     *      ),
     *     @OA\Response(
     *          response=501,
     *          description="Validation Error"
     *      )
     *  )
     *
     * @return array|mixed
     */
    public function create()
    {
        $plateau = new \App\Entities\Plateau();

        $plateau->setName($this->request->getVar('name'));

        $plateau->setX($this->request->getVar('x'));

        $plateau->setY($this->request->getVar('y'));

        $model = new PlateauModel();

        try {

            $result = $model->create($plateau);

        } catch (Throwable $e) {

            $result = false;

        }

        return $result ?
            $this->responseSuccess($result->toRawArray(), 201) :
            $this->responseError( 'Plateau could not be created. Please try again');

    }
}
