<?php
class CoderityAppModel extends AppModel {
    public $actsAs = array('Containable');

/**
* This function matches two fields - a useful extension for Cake Validation
*
* @param string|array $check Value to check
* @param string $compareField The field to compare
* @return boolean Success
*/
    public function matchFields($check = array(), $compareField = null) {
        $value = array_shift($check);

        if (!empty($value) && !empty($this->data[$this->name][$compareField])) {
            if ($value !== $this->data[$this->name][$compareField]) {
                return false;
            }
        }

        return true;
    }
}