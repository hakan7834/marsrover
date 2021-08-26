<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Rover extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => TRUE,
				'auto_increment' => TRUE
			],
			'name'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
            'plateau_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'x' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'y' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'heading'      => [
                'type'           => 'ENUM',
                'constraint'     => ['E', 'W', 'N', 'S'],
                'default'        => 'N',
            ],
		]);

		$this->forge->addKey('id', TRUE);

        $this->forge->addForeignKey('plateau_id','plateau','id');

		$this->forge->createTable('rover');

		//
	}

	//--------------------------------------------------------------------

	public function down()
	{
        $this->forge->dropTable('rover');
	}
}
