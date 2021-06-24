<?php

/**
 * @package CRM
 * @copyright CiviCRM LLC https://civicrm.org/licensing
 *
 * Generated from uk.co.compucorp.civicrm.booking/xml/schema/CRM/Booking/AdhocChargesItem.xml
 * DO NOT EDIT.  Generated by CRM_Core_CodeGen
 * (GenCodeChecksum:57a5b2a1a6e91631cbf0e43e2a24e9dc)
 */
use CRM_Booking_ExtensionUtil as E;

/**
 * Database access object for the AdhocChargesItem entity.
 */
class CRM_Booking_DAO_AdhocChargesItem extends CRM_Core_DAO {
  const EXT = E::LONG_NAME;
  const TABLE_ADDED = '';

  /**
   * Static instance to hold the table name.
   *
   * @var string
   */
  public static $_tableName = 'civicrm_booking_adhoc_charges_item';

  /**
   * Should CiviCRM log any modifications to this table in the civicrm_log table.
   *
   * @var bool
   */
  public static $_log = TRUE;

  /**
   * @var int
   */
  public $id;

  /**
   * @var string
   */
  public $name;

  /**
   * @var string
   */
  public $label;

  /**
   * @var float
   */
  public $price;

  /**
   * @var int
   */
  public $weight;

  /**
   * @var bool
   */
  public $is_active;

  /**
   * @var bool
   */
  public $is_deleted;

  /**
   * Class constructor.
   */
  public function __construct() {
    $this->__table = 'civicrm_booking_adhoc_charges_item';
    parent::__construct();
  }

  /**
   * Returns localized title of this entity.
   *
   * @param bool $plural
   *   Whether to return the plural version of the title.
   */
  public static function getEntityTitle($plural = FALSE) {
    return $plural ? E::ts('Adhoc Charges Items') : E::ts('Adhoc Charges Item');
  }

  /**
   * Returns all the column names of this table
   *
   * @return array
   */
  public static function &fields() {
    if (!isset(Civi::$statics[__CLASS__]['fields'])) {
      Civi::$statics[__CLASS__]['fields'] = [
        'id' => [
          'name' => 'id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => E::ts('ID'),
          'required' => TRUE,
          'where' => 'civicrm_booking_adhoc_charges_item.id',
          'table_name' => 'civicrm_booking_adhoc_charges_item',
          'entity' => 'AdhocChargesItem',
          'bao' => 'CRM_Booking_DAO_AdhocChargesItem',
          'localizable' => 0,
          'readonly' => TRUE,
          'add' => NULL,
        ],
        'name' => [
          'name' => 'name',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => E::ts('Name'),
          'required' => TRUE,
          'maxlength' => 255,
          'size' => CRM_Utils_Type::HUGE,
          'where' => 'civicrm_booking_adhoc_charges_item.name',
          'table_name' => 'civicrm_booking_adhoc_charges_item',
          'entity' => 'AdhocChargesItem',
          'bao' => 'CRM_Booking_DAO_AdhocChargesItem',
          'localizable' => 0,
          'add' => NULL,
        ],
        'label' => [
          'name' => 'label',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => E::ts('Label'),
          'required' => TRUE,
          'maxlength' => 255,
          'size' => CRM_Utils_Type::HUGE,
          'where' => 'civicrm_booking_adhoc_charges_item.label',
          'table_name' => 'civicrm_booking_adhoc_charges_item',
          'entity' => 'AdhocChargesItem',
          'bao' => 'CRM_Booking_DAO_AdhocChargesItem',
          'localizable' => 0,
          'add' => NULL,
        ],
        'price' => [
          'name' => 'price',
          'type' => CRM_Utils_Type::T_MONEY,
          'title' => E::ts('Price'),
          'required' => TRUE,
          'precision' => [
            20,
            2,
          ],
          'where' => 'civicrm_booking_adhoc_charges_item.price',
          'table_name' => 'civicrm_booking_adhoc_charges_item',
          'entity' => 'AdhocChargesItem',
          'bao' => 'CRM_Booking_DAO_AdhocChargesItem',
          'localizable' => 0,
          'add' => NULL,
        ],
        'weight' => [
          'name' => 'weight',
          'type' => CRM_Utils_Type::T_INT,
          'title' => E::ts('Weight'),
          'required' => TRUE,
          'where' => 'civicrm_booking_adhoc_charges_item.weight',
          'table_name' => 'civicrm_booking_adhoc_charges_item',
          'entity' => 'AdhocChargesItem',
          'bao' => 'CRM_Booking_DAO_AdhocChargesItem',
          'localizable' => 0,
          'add' => NULL,
        ],
        'is_active' => [
          'name' => 'is_active',
          'type' => CRM_Utils_Type::T_BOOLEAN,
          'title' => E::ts('Slot is cancelled'),
          'import' => TRUE,
          'where' => 'civicrm_booking_adhoc_charges_item.is_active',
          'export' => TRUE,
          'default' => '1',
          'table_name' => 'civicrm_booking_adhoc_charges_item',
          'entity' => 'AdhocChargesItem',
          'bao' => 'CRM_Booking_DAO_AdhocChargesItem',
          'localizable' => 0,
          'add' => '4.4',
        ],
        'is_deleted' => [
          'name' => 'is_deleted',
          'type' => CRM_Utils_Type::T_BOOLEAN,
          'title' => E::ts('Slot is in the Trash'),
          'import' => TRUE,
          'where' => 'civicrm_booking_adhoc_charges_item.is_deleted',
          'export' => TRUE,
          'default' => '0',
          'table_name' => 'civicrm_booking_adhoc_charges_item',
          'entity' => 'AdhocChargesItem',
          'bao' => 'CRM_Booking_DAO_AdhocChargesItem',
          'localizable' => 0,
          'add' => '4.4',
        ],
      ];
      CRM_Core_DAO_AllCoreTables::invoke(__CLASS__, 'fields_callback', Civi::$statics[__CLASS__]['fields']);
    }
    return Civi::$statics[__CLASS__]['fields'];
  }

  /**
   * Return a mapping from field-name to the corresponding key (as used in fields()).
   *
   * @return array
   *   Array(string $name => string $uniqueName).
   */
  public static function &fieldKeys() {
    if (!isset(Civi::$statics[__CLASS__]['fieldKeys'])) {
      Civi::$statics[__CLASS__]['fieldKeys'] = array_flip(CRM_Utils_Array::collect('name', self::fields()));
    }
    return Civi::$statics[__CLASS__]['fieldKeys'];
  }

  /**
   * Returns the names of this table
   *
   * @return string
   */
  public static function getTableName() {
    return self::$_tableName;
  }

  /**
   * Returns if this table needs to be logged
   *
   * @return bool
   */
  public function getLog() {
    return self::$_log;
  }

  /**
   * Returns the list of fields that can be imported
   *
   * @param bool $prefix
   *
   * @return array
   */
  public static function &import($prefix = FALSE) {
    $r = CRM_Core_DAO_AllCoreTables::getImports(__CLASS__, 'booking_adhoc_charges_item', $prefix, []);
    return $r;
  }

  /**
   * Returns the list of fields that can be exported
   *
   * @param bool $prefix
   *
   * @return array
   */
  public static function &export($prefix = FALSE) {
    $r = CRM_Core_DAO_AllCoreTables::getExports(__CLASS__, 'booking_adhoc_charges_item', $prefix, []);
    return $r;
  }

  /**
   * Returns the list of indices
   *
   * @param bool $localize
   *
   * @return array
   */
  public static function indices($localize = TRUE) {
    $indices = [
      'index_is_active' => [
        'name' => 'index_is_active',
        'field' => [
          0 => 'is_active',
        ],
        'localizable' => FALSE,
        'sig' => 'civicrm_booking_adhoc_charges_item::0::is_active',
      ],
      'index_is_deleted' => [
        'name' => 'index_is_deleted',
        'field' => [
          0 => 'is_deleted',
        ],
        'localizable' => FALSE,
        'sig' => 'civicrm_booking_adhoc_charges_item::0::is_deleted',
      ],
    ];
    return ($localize && !empty($indices)) ? CRM_Core_DAO_AllCoreTables::multilingualize(__CLASS__, $indices) : $indices;
  }

}
