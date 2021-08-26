<?php
namespace App\Models\v1;
use App\Entities\Plateau;
use CodeIgniter\Model;

class PlateauModel extends Model
{
    protected $table = 'plateau';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'x', 'y'];

    /**
     * @param Plateau $plateau
     * @return Plateau|null
     */
    public function create(Plateau $plateau): ?Plateau
    {
        try {

            $this->insert($plateau->toArray());

            if (!$this->getInsertID()) return null;

            $plateau->setId($this->getInsertID());

            return $plateau;

        } catch (\Exception $e) {

            return null;

        }

    }

}