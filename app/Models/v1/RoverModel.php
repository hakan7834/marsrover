<?php
namespace App\Models\v1;
use App\Entities\Plateau;
use App\Entities\Rover;
use CodeIgniter\Model;
use Exception;
use Throwable;

class RoverModel extends Model
{
    protected $table = 'rover';

    protected $primaryKey = 'id';

    protected $allowedFields = ['plateau_id', 'name', 'x', 'y', 'heading'];


    private const HEADINGS = ['N', 'E', 'S', 'W'];

    private const HEADINGS_M = [
        'N' => ['variable' => 'y', 'direction' => 1],
        'E' => ['variable' => 'x', 'direction' => 1],
        'S' => ['variable' => 'y', 'direction' => -1],
        'W' => ['variable' => 'x', 'direction' => -1],
    ];

    private const HEAD_M_STEP = 1;


    /**
     * @param Rover $rover
     * @return Rover
     */
    private function commandL(Rover $rover): Rover
    {
        $countHeadings = count(self::HEADINGS);

        $currentIndex = array_search($rover->getHeading(), self::HEADINGS);

        $newKey = ($countHeadings + $currentIndex - 1) % $countHeadings;

        $rover->setHeading(self::HEADINGS[$newKey]);

        return $rover;

    }

    /**
     * @param Rover $rover
     * @return Rover
     */
    private function commandR(Rover $rover): Rover
    {
        $countHeadings = count(self::HEADINGS);

        $currentIndex = array_search($rover->getHeading(), self::HEADINGS);

        $newKey = ($currentIndex + 1) % $countHeadings;

        $rover->setHeading(self::HEADINGS[$newKey]);

        return $rover;

    }

    /**
     * @param Plateau $plateau
     * @param Rover $rover
     * @return Rover
     */
    private function commandM(Plateau $plateau, Rover $rover): Rover
    {
        $headingsM = self::HEADINGS_M[$rover->getHeading()];

        return ($headingsM['variable'] === 'x')  ?
            $this->commandMX($plateau, $rover, $headingsM['direction']) :
            $this->commandMY($plateau, $rover, $headingsM['direction']);
    }

    /**
     * @param Plateau $plateau
     * @param Rover $rover
     * @param int $direction
     * @return Rover
     */
    private function commandMX(Plateau $plateau, Rover $rover, int $direction): Rover
    {
        $newX = max(0, min($plateau->getX(), $rover->getX() + ($direction * self::HEAD_M_STEP)));

        return $rover->setX($newX);

    }

    /**
     * @param Plateau $plateau
     * @param Rover $rover
     * @param int $direction
     * @return Rover
     */
    private function commandMY(Plateau $plateau, Rover $rover, int $direction): Rover
    {
        $newY = max(0, min($plateau->getY(), $rover->getY() + ($direction * self::HEAD_M_STEP)));

        return $rover->setY($newY);

    }

    /**
     * @param Rover $rover
     * @return Rover|null
     */
    public function create(Rover $rover): ?Rover
    {
        try {

            $plateauModel = new PlateauModel();

            $plateau = $plateauModel->where('id', $rover->getPlateauId())->first();

            if (empty($plateau)) return null;

            $this->insert($rover->toArray());

            if (!$this->getInsertID()) return null;

            $rover->setId($this->getInsertID());

            return $rover;

        } catch (Exception $e) {

            return null;

        }

    }

    /**
     * @param Plateau $plateau
     * @param Rover $rover
     * @param array $commands
     * @return Rover|null
     */
    public function command(Plateau $plateau, Rover $rover, Array $commands): ?Rover
    {
        foreach ($commands as $command) {

            if ($command === 'L') $rover = $this->commandL($rover);

            elseif ($command === 'R')  $rover = $this->commandR($rover);

            elseif ($command === 'M') $rover = $this->commandM($plateau, $rover);

        }

        return $rover;

    }

    /**
     * @param Rover $rover
     * @return bool
     */
    public function updateRover(Rover $rover): Bool
    {
        try {

            $this->update($rover->getId(), $rover->toArray());

            return true;

        } catch (Throwable $e) {

            return false;

        }

    }
}