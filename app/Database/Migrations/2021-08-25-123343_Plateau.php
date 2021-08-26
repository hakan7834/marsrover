<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Plateau extends Migration
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
            'x' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'y' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],

		]);
		$this->forge->addKey('id', TRUE);

		$this->forge->createTable('plateau');

		//
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('plateau');
	}
}
