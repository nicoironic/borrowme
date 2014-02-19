<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_sales_order extends Migration
{
	/**
	 * The name of the database table
	 *
	 * @var String
	 */
	private $table_name = 'sales_order';

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
		'invoice_no' => array(
			'type' => 'VARCHAR',
			'constraint' => 255,
			'null' => FALSE,
		),
		'supplier' => array(
			'type' => 'VARCHAR',
			'constraint' => 255,
			'null' => FALSE,
		),
		'ris_no' => array(
			'type' => 'VARCHAR',
			'constraint' => 255,
			'null' => FALSE,
		),
		'po_no' => array(
			'type' => 'VARCHAR',
			'constraint' => 255,
			'null' => FALSE,
		),
		'jor_no' => array(
			'type' => 'VARCHAR',
			'constraint' => 255,
			'null' => FALSE,
		),
		'date_received' => array(
			'type' => 'DATE',
			'null' => FALSE,
			'default' => '0000-00-00',
		),
		'date_invoice' => array(
			'type' => 'DATE',
			'null' => FALSE,
			'default' => '0000-00-00',
		),
		'receiving_dept' => array(
			'type' => 'VARCHAR',
			'constraint' => 255,
			'null' => FALSE,
		),
		'received_by' => array(
			'type' => 'INT',
			'constraint' => 11,
			'null' => FALSE,
		),
		'noted_by' => array(
			'type' => 'INT',
			'constraint' => 11,
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