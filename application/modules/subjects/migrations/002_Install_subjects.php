<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_subjects extends Migration
{
	/**
	 * The name of the database table
	 *
	 * @var String
	 */
	private $table_name = 'subjects';

	/**
	 * The table's fields
	 *
	 * @var Array
	 */
	private $fields = array(
		'id' => array(
			'type' => 'INT',
			'constraint' => 11,
			'auto_increment' => TRUE,
		),
		'name' => array(
			'type' => 'VARCHAR',
			'constraint' => 255,
			'null' => FALSE,
		),
		'description' => array(
			'type' => 'TEXT',
			'null' => FALSE,
		),
		'time_start' => array(
			'type' => 'TIMESTAMP',
			'null' => FALSE,
		),
		'time_end' => array(
			'type' => 'TIMESTAMP',
			'null' => FALSE,
		),
		'status' => array(
			'type' => 'ENUM',
			'constraint' => '\'Active\',\'Inactive\'',
			'null' => FALSE,
		),
		'created_on' => array(
			'type' => 'datetime',
			'default' => '0000-00-00 00:00:00',
		),
		'modified_on' => array(
			'type' => 'datetime',
			'default' => '0000-00-00 00:00:00',
		),
	);

	/**
	 * Install this migration
	 *
	 * @return void
	 */
	public function up()
	{
		$this->dbforge->add_field($this->fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table($this->table_name);
	}

	//--------------------------------------------------------------------

	/**
	 * Uninstall this migration
	 *
	 * @return void
	 */
	public function down()
	{
		$this->dbforge->drop_table($this->table_name);
	}

	//--------------------------------------------------------------------

}