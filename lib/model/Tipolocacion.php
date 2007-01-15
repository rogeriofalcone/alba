<?php

require_once 'model/om/BaseTipolocacion.php';


/**
 * Skeleton subclass for representing a row from the 'tipolocacion' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class Tipolocacion extends BaseTipolocacion {
    public function __toString() {
        return $this->getNombre();
    }
                
} // Tipolocacion