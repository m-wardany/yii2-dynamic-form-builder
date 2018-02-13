<?php
namespace wardany\dform\models;

/**
 *
 * @author muhammad wardany {muhammad.wardany@gmail.com}
 */
interface IInput {
    /**
     * Set type in the constructor
     * @param array $config
     */
    public function __construct($config = array());

    /**
     * create new Instance from \wardany\dform\helpers\ValidationRuleHelper and send $this as parameter
     * use ValidationRuleHelper object to build validators like $obj->first_validator()->second_validator()->build();
     * @return array 
     */
    public function getValidatorsModels();
}
