<?php
/*
 +--------------------------------------------------------------------+
 | CiviCRM version 4.4                                                |
 +--------------------------------------------------------------------+
 | Copyright CiviCRM LLC (c) 2004-2013                                |
 +--------------------------------------------------------------------+
 | This file is a part of CiviCRM.                                    |
 |                                                                    |
 | CiviCRM is free software; you can copy, modify, and distribute it  |
 | under the terms of the GNU Affero General Public License           |
 | Version 3, 19 November 2007 and the CiviCRM Licensing Exception.   |
 |                                                                    |
 | CiviCRM is distributed in the hope that it will be useful, but     |
 | WITHOUT ANY WARRANTY; without even the implied warranty of         |
 | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.               |
 | See the GNU Affero General Public License for more details.        |
 |                                                                    |
 | You should have received a copy of the GNU Affero General Public   |
 | License and the CiviCRM Licensing Exception along                  |
 | with this program; if not, contact CiviCRM LLC                     |
 | at info[AT]civicrm[DOT]org. If you have questions about the        |
 | GNU Affero General Public License or the licensing of CiviCRM,     |
 | see the CiviCRM license FAQ at http://civicrm.org/licensing        |
 +--------------------------------------------------------------------+
*/

/**
 *
 * @package CRM
 * @copyright CiviCRM LLC (c) 2004-2013
 *
 */

/**
 * This class generates form components for Resource
 *
 */
class CRM_Admin_Form_Resource extends CRM_Admin_Form {
  protected $_id = NULL;

  function preProcess() {
    parent::preProcess();
    CRM_Utils_System::setTitle(ts('Settings - Resource'));
    $this->_id = CRM_Utils_Request::retrieve('id', 'Positive',
      $this, FALSE, 0
    );
  }

  /**
   * Function to build the form
   *
   * @return None
   * @access public
   */
  public function buildQuickForm($check = FALSE) {
    parent::buildQuickForm();

    if ($this->_action & CRM_Core_Action::DELETE) {
      return;
    }


    $types =  CRM_Booking_BAO_Resource::buildOptions('type_id', 'create');
    $this->add('select', 'type_id', ts('Resource type'),
      array('' => ts('- select -')) + $types,
      TRUE,
      array()
    );

    $this->add('text', 'label', ts('Label'), array('size' => 50, 'maxlength' => 255), TRUE);
    $this->add('textarea', 'description', ts('Description'), CRM_Core_DAO::getAttribute('CRM_Booking_DAO_Resource', 'description'), FALSE);
    /*
    $this->addWysiwyg('description',
        ts('Description'),
        CRM_Core_DAO::getAttribute('CRM_Booking_DAO_Resource', 'description')
    );*/

    $this->add('text', 'weight', ts('Weight'), CRM_Core_DAO::getAttribute('CRM_Booking_DAO_Resource', 'weight'), TRUE);
    $statusCheckbox = $this->add('advcheckbox', 'is_active', ts('Enabled?'));
    $this->add('advcheckbox', 'is_unlimited', ts('Is Unlimited?'));

    /*
      Civibooking 2.0
    */
    $this->add('advcheckbox', 'is_public', ts('Public?'));
    $this->add('advcheckbox', 'is_approval_required', ts('Approval Required?'));

    // Timeslots
    $this->addDateTime('mon_start', ts('Monday'), FALSE, array('formatType' => 'activityDateTime'));
    $this->addDateTime('mon_end', ts(''), FALSE, array('formatType' => 'activityDateTime'));

    $this->addDateTime('tue_start', ts('Tuesday'), FALSE, array('formatType' => 'activityDateTime'));
    $this->addDateTime('tue_end', ts(''), FALSE, array('formatType' => 'activityDateTime'));

    $this->addDateTime('wed_start', ts('Wednesday'), FALSE, array('formatType' => 'activityDateTime'));
    $this->addDateTime('wed_end', ts(''), FALSE, array('formatType' => 'activityDateTime'));

    $this->addDateTime('thu_start', ts('Thursday'), FALSE, array('formatType' => 'activityDateTime'));
    $this->addDateTime('thu_end', ts(''), FALSE, array('formatType' => 'activityDateTime'));

    $this->addDateTime('fri_start', ts('Friday'), FALSE, array('formatType' => 'activityDateTime'));
    $this->addDateTime('fri_end', ts(''), FALSE, array('formatType' => 'activityDateTime'));

    $this->addDateTime('sat_start', ts('Saturday'), FALSE, array('formatType' => 'activityDateTime'));
    $this->addDateTime('sat_end', ts(''), FALSE, array('formatType' => 'activityDateTime'));

    $this->addDateTime('sun_start', ts('Sunday'), FALSE, array('formatType' => 'activityDateTime'));
    $this->addDateTime('sun_end', ts(''), FALSE, array('formatType' => 'activityDateTime'));

    $number = range(5,60,5);
    $this->add('select', 'time_unit', ts('Minimum Time Units'),
      array('' =>ts('- select -')) +$number,
      //True,
      array()
    );
    $this->add('text', 'min_fee', ts('Minimum Fee'));


    $configSets =  array('' => ts('- select -'));
    try{
      $activeSets = civicrm_api3('ResourceConfigSet', 'get', array('is_active' => 1, 'is_deleted' => 0));
      foreach ($activeSets['values'] as $key => $set) {
        $configSets[$key] = $set['title'];
      }

      $resource = civicrm_api3('Resource', 'getsingle', array(
        'sequential' => 1,
        'id' => $this->_id,
      ));
    }
    catch (CiviCRM_API3_Exception $e) {}

    //allow state changes only when there is enabled config set
    if(!in_array($resource['set_id'], array_keys($activeSets['values']))){
      $statusCheckbox->setAttribute('disabled', 'disabled');
    }

    // Uncomment True
  $this->add('select', 'set_id', ts('Resource configuration set'), $configSets /*TRUE*/);

    $locations =  CRM_Booking_BAO_Resource::buildOptions('location_id', 'create');
    $this->add('select', 'location_id', ts('Resource Location'),
      array('' => ts('- select -')) + $locations,
      FALSE,
      array()
    );

    $this->addFormRule(array('CRM_Admin_Form_Resource', 'formRule'), $this);
    $cancelURL = CRM_Utils_System::url('civicrm/admin/resource', "&reset=1");
    $cancelURL = str_replace('&amp;', '&', $cancelURL);
    $this->addButtons(
      array(
        array(
          'type' => 'next',
          'name' => ts('Save'),
          'isDefault' => TRUE,
        ),
        array(
          'type' => 'cancel',
          'name' => ts('Cancel'),
          'js' => array('onclick' => "location.href='{$cancelURL}'; return false;"),
        ),
      )
    );
  }

  static function formRule($fields) {
   $errors = array();
   $setId =  CRM_Utils_Array::value('set_id', $fields);
   if($setId){
     try{
        $options = civicrm_api3('ResourceConfigOption', 'get', array('set_id' => $setId));
        $count = CRM_Utils_Array::value('count', $options);
        if($count == 0){
          $errors['set_id'] = ts('The selected set does not contain any options, please select another');
        }
      }
      catch (CiviCRM_API3_Exception $e) {}
   }
    return empty($errors) ? TRUE : $errors;
  }



  function setDefaultValues() {
    $defaults = parent::setDefaultValues();
    if (!CRM_Utils_Array::value('weight', $defaults)) {
      $query = "SELECT max( `weight` ) as weight FROM `civicrm_booking_resource`";;
      $dao = new CRM_Core_DAO();
      $dao->query($query);
      $dao->fetch();
      $defaults['weight'] = ($dao->weight + 1);
    }
    return $defaults;
  }


  /**
   * Function to process the form
   *
   * @access public
   *
   * @return None
   */
  public function postProcess() {
    CRM_Utils_System::flushCache();

    $params = $this->exportValues();

    // Filter out timeslots and put them in a single array
    $times = array();
    foreach($params as $x => $x_value) {
        if ($x == "mon_start_time" or
            $x == "mon_end_time" or
            $x == "tue_start_time" or
            $x == "tue_end_time" or
            $x == "wed_start_time" or
            $x == "wed_end_time" or
            $x == "thu_start_time" or
            $x == "thu_end_time" or
            $x == "fri_start_time" or
            $x == "fri_end_time" or
            $x == "sat_start_time" or
            $x == "sat_end_time" or
            $x == "sun_start_time" or
            $x == "sun_end_time"
            ){
              // echo "Key=" . $x . ", Value=" . $x_value;
              // echo "<br>";
              array_push($times, $x, $x_value);
            }
    }

    // Serialize the array
    $times_seralized = serialize($times);
    $params['times_seralized']=$times_seralized;

    // var_dump($params);
    // die();

    if ($this->_action & CRM_Core_Action::DELETE) {

      CRM_Booking_BAO_Slot::delByResource($this->_id);

      CRM_Booking_BAO_Resource::del($this->_id);
      CRM_Core_Session::setStatus(ts('Selected resource has been deleted.'), ts('Record Deleted'), 'success');

    }
    else {
      if($this->_id){
        $params['id'] = $this->_id;
      }


      $resource = CRM_Booking_BAO_Resource::create($params);
      CRM_Core_Session::setStatus(ts('The Record \'%1\' has been saved.', array(1 => $resource->label)), ts('Saved'), 'success');
    }
  }



}
