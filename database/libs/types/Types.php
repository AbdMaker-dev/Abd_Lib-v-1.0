<?php
namespace libs\types;

use libs\constraintes\Constraintes;

class Types extends Constraintes
{
    
        // Les types
        public function string($taille = 255)
        {
            $this->col = $this->col . " varchar($taille)";
            return $this;
        }
    
        public function integer($taille = 11)
        {
            $this->col = $this->col . " int($taille)";
            return $this;
        }
    
        public function float($taille = 11)
        {
            $this->col = $this->col . " FLOAT($taille)";
            return $this;
        }
    
        public function blob()
        {
            $this->col = $this->col . " LONGBLOB ";
            return $this;
        }
    
        public function text()
        {
            $this->col = $this->col . " LONGTEXT ";
            return $this;
        }
    
        public function date()
        {
            $this->col = $this->col . " DATE ";
            return $this;
        }
    
        public function enumeration(array $vals)
        {
            $enum = " ENUM( ";
            if ($vals != null) {
                for ($i = 0; $i < count($vals); $i++) {
                    $enum = $enum . "'".$vals[$i]."'";
                    if (isset($vals[$i + 1])) {
                        $enum = $enum . ",";
                    }
                }
            }
            $this->col = $this->col . $enum . ")";
            return $this;
        }
    
        public function bool()
        {
            $this->col = $this->col . " BOOLEAN ";
            return $this;
        }
}