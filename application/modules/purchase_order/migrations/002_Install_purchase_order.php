<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_purchase_order extends Migration
{
	/**
	 * The name of the database table
	 *
	 * @var String
	 */
	private $table_name = 'purchase_order';

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
		'purchase_order_no' => array(
			'type' => 'VARCHAR',
			'constraint' => 255,
			'null' => FALSE,
		),
		'sales_order_id' => array(
			'type' => 'INT',
			'constraint' => 11,
			'null' => FALSE,
		),
		'supplier' => array(
			'type' => 'VARCHAR',
			'constraint' => 255,
			'null' => FALSE,
		),
		'address' => array(
			'type' => 'TEXT',
			'null' => FALSE,
		),
		'terms' => array(
			'type' => 'ENUM',
			'constraint' => '\'15days\',\'30days\'',
			'null' => FALSE,
		),
		'contact_person' => array(
			'type' => 'VARCHAR',
			'constraint' => 255,
			'null' => FALSE,
		),
		'ordered_by' => array(
			'type' => 'VARCHAR',
			'constraint' => 255,
			'null' => FALSE,
		),
		'requested_by' => array(
			'type' => 'VARCHAR',
			'constraint' => 255,
			'null' => FALSE,
		),
		'received_by' => array(
			'type' => 'VARCHAR',
			'constraint' => 255,
			'null' => FALSE,
		),
		'status' => array(
			'type' => 'ENUM',
			'constraint' => '\'pending\',\'approved\'',
			'null' => FALSE,
		),
			'deleted' => array(
				'type' => 'TINYINT',
				'constraint' => 1,
				'default' => '0',
			),
		'created_on' => array(
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