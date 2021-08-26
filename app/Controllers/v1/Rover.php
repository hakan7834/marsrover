<?php

namespace App\Controllers\v1;

use App\Models\v1\PlateauModel;
use App\Models\v1\RoverModel;
use OpenApi\Annotations as OA;


class Rover extends \App\Controllers\BaseController
{

    /**
     *  @OA\Get(
     *      path="/v1/plateau/{plateauId}/rover",
     *      summary="list rovers of Plateau",
     *      description="Returns list rovers of Plateaus",
     *      tags={"Rover"},
     *      @OA\Parameter(
     *          name="plateauId", required=true, in="path", @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found Plateau"
     *      )
     *  )
     *
     * @return array|mixed
     */
    public function index()
    {
        $model = new RoverModel();

        $data = $model->findAll();

        return $this->responseSuccess($data);
    }

    /**
     *  @OA\Get(
     *      path="/v1/plateau/{plateauId}/rover/{roverId}",
     *      summary="get specific rover of Plateau",
     *      description="Returns get specific rover of Plateau by Id",
     *      tags={"Rover"},
     *      @OA\Parameter(
     *          name="plateauId", required=true, in="path", @OA\Schema(type="integer")
     *      ),
     *      @OA\Parameter(
     *          name="roverId", required=true, in="path", @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found Plateau"
     *      )
     *  )
     *
     *
     * @param null $id
     * @return array|mixed
     */
    public function show($id = null)
    {
        $model = new RoverModel();

        $data = $model->select('plateau_id, name, x, y, heading')->find($id);

        return $data ? $this->responseSuccess($data) :  $this->failNotFound('Rover could not found');;
    }

    /**
    /**
     *  @OA\Post(
     *      path="/v1/plateau/{plateauId}/rover/create",
     *      summary="create Rover of Plateau",
     *      description="Create Rover of Plateau by <br/> <b>plateauId</b> : ID of Plateau <br/> <b>name</b> : name of Rover <br/><b>x</b> : right corrdinate of Rover <br/><b>y</b> : upper coordinate of Rover <br/><b>heading</b> : initial heading direction posible values : <b>N :</b> North, <b>E :</b> East, <b>S :</b> South, <b>W :</b> West",
     *      tags={"Rover"},
     *      @OA\Parameter(
     *          name="plateauId", required=true, in="path", @OA\Schema(type="integer")
     *      ),
     *      @OA\RequestBody(
     *          @OA\MediaType(mediaType="application/json",
     *              @OA\Schema(
     *                  @OA\Property(property="name", type="string"),
     *                  @OA\Property(property="x", type="integer"),
     *                  @OA\Property(property="y", type="integer"),
     *                  @OA\Property(property="heading", type="string", description="Posible variables: <br> <b>N :</b> North <br><b>E :</b> East <br><b>S :</b> South <br><b>W :</b> West"),
     *                  required={"plateauId","name", "x", "y", "heading"}
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
     * @param $plateauId
     * @return mixed
     */
    public function createRover($plateauId)
    {

        $rover = new \App\Entities\Rover();

        $rover->setName($this->request->getVar('name'));

        $rover->setPlateauId($plateauId);

        $rover->setX($this->request->getVar('x'));

        $rover->setY($this->request->getVar('y'));

        $rover->setHeading($this->request->getVar('heading'));

        $model = new RoverModel();

        try {

            $result = $model->create($rover);

        } catch (\Throwable $e) {

            $result = false;

        }

        return $result ?
            $this->responseSuccess($result->toRawArray(), 201) :
            $this->responseError( 'Rover could not be created. Please try again');

    }

    /**
     *  @OA\Post(
     *      path="/v1/plateau/{plateauId}/rover/{roverId}/command",
     *      summary="send commands to Rover",
     *      description="send commands to Rover",
     *      tags={"Rover"},
     *      @OA\Parameter(
     *          name="plateauId", required=true, in="path", @OA\Schema(type="integer")
     *      ),
     *      @OA\Parameter(
     *          name="roverId", required=true, in="path", @OA\Schema(type="integer")
     *      ),
     *      @OA\RequestBody(
     *          @OA\MediaType(mediaType="application/json",
     *              @OA\Schema(
     *                  @OA\Property(property="commands", type="string"),
     *                  required={"commands"}
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Success"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found Plateau"
     *      ),
     *      @OA\Response(
     *          response=501,
     *          description="Validation Error"
     *      )
     *  )
     *
     * @param $plateauId
     * @param $roverId
     * @return mixed
     */
    public function command($plateauId, $roverId) {

        $plateauModel = new PlateauModel();

        $plateau = $plateauModel->find($plateauId);

        if (!$plateau)
            return $this->failNotFound('Plateau could not found');

        $plateau = new \App\Entities\Plateau($plateau);

        $roverModel = new RoverModel();

        $rover = $roverModel->find($roverId);

        if (!$rover)
            return $this->failNotFound('Rover could not found');

        $rover = new \App\Entities\Rover($rover);

        if ($rover->getPlateauId() !== $plateau->getId()) return $this->failNotFound('Rover could not found in plateau');

        $commands = $this->request->getVar('commands');

        if (empty($commands)) return $this->responseError('Please enter commands');

        $commands = str_split( $commands);

        $newRover = $roverModel->command($plateau, $rover, $commands);

        $result =  $newRover ? $roverModel->updateRover($rover) : null;

        if ($result) {

            $data = [
                'x' => $newRover->getX(),
                'y' => $newRover->getY(),
                'heading' => $newRover->getHeading(),
            ];

            return $this->responseSuccess($data, 202);

        }

        return $this->responseError( 'Command could not be applied. Please try again');

    }

}
