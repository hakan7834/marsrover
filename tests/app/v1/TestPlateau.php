<?php

namespace App;

use App\Entities\Plateau;
use App\Models\v1\PlateauModel;
use Config\Services;
use PHPUnit\Framework\TestCase;

class TestPlateau extends TestCase
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
     *
     */
    public function testPlateauCreate(): void
    {

        $migrate = Services::migrations();

        $migrate->latest();

        $plateau = $this->createPlateau();

        $plateauModel = new PlateauModel();

        $result = $plateauModel->create($plateau);

        $this->assertNotNull($result);

    }
}