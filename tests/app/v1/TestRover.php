<?php

namespace App;

use App\Entities\Plateau;
use App\Entities\Rover;
use App\Models\v1\RoverModel;
use Config\Services;
use PHPUnit\Framework\TestCase;

class TestRover extends TestCase
{

    /**
     *
     */
    protected function setUp(): void
    {
        parent::setUp();

    }

    /**
     *
     */
    protected function tearDown(): void
    {
        parent::tearDown();

    }

    /**
     * @return Plateau
     */
    private function createPlateau(): Plateau
    {
        $plateau = new Plateau();

        return $plateau->setId(1)
            ->setName('plateau_1')
            ->setX(10)
            ->setY(10);

    }

    /**
     * @return Rover
     */
    private function createRover(): Rover
    {
        $rover = new Rover();

        return $rover->setPlateauId(1)
            ->setName('rover_1')
            ->setX(3)
            ->setY(3)
            ->setHeading('N');

    }

    /**
     *
     */
    public function testRoverCommand(): void
    {
        $plateau = $this->createPlateau();

        $rover = $this->createRover();

        $roverModel = new RoverModel();

        $result = $roverModel->command($plateau, $rover, str_split('MMLMRMLMRMM'));

        $this->assertSame(1, $result->getX());

        $this->assertSame(8, $result->getY());

        $this->assertSame("N", $result->getHeading());

    }

    /**
     *
     */
    public function testRoverCreate(): void
    {
        $migrate = Services::migrations();

        $migrate->latest();

        $rover = $this->createRover();

        $model = new RoverModel();

        $result = $model->create($rover);

        $this->assertNotNull($result);

    }




}