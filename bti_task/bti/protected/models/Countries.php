<?php
/**
 * Countries
 *
 * PUBLIC:                 PROTECTED                  PRIVATE
 * -----------             ------------------         ------------------
 * __construct             _customFields
 * 
 *
 * STATIC:
 * ---------------------------------------------------------------
 * model
 *
 */
class Countries extends CActiveRecord
{

    /** @var string */    
    protected $_table = 'countries';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Returns the static model of the specified AR class
     */
    public static function model()
    {
        return parent::model(__CLASS__);
    }
    
    
 
}

