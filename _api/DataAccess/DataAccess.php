<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DataAccess;

use Controller\Controller;
use DataAccess\Create;
use DataAccess\Read;
use DataAccess\Update;
use DataAccess\Delete;

/**
 *
 * @author Witor
 */
abstract class DataAccess {

    private $dataObject;
    
    public function create() {
        return $this->dataObject = new Create();
    }
    
    public function read() {
        return $this->dataObject = new Read();
    }
    
    public function update() {
        return $this->dataObject = new Update();
    }
    
    public function delete() {
        return $this->dataObject = new Delete();
    }

}
