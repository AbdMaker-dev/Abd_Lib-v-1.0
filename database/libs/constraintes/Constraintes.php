<?php

namespace libs\constraintes;

class Constraintes 
{
    
    // Ajout de l'auto_increment a un colonne du table
    public function increment()
    {
        $this->col = $this->col . " AUTO_INCREMENT ";
        return $this;
    }

    // Si la collonne est nullable true fals si nom
    public function cantNull($bool = false)
    {
        if (!$bool) {
            $this->col = $this->col . " NOT NULL ";
        }
        return $this;
    }

    // permet de definire le cle primaire
    public function primaryKey($attre)
    {

        $this->col = "PRIMARY KEY (`$attre`) ";
        return $this;
    }

    // permet de definir des cles etrangere
    public function foreignKey($attre, $ref, $attre_ref)
    {

        $this->col = "CONSTRAINT FOREIGN KEY (`$attre`) REFERENCES `$ref` (`$attre_ref`)";
        return $this;
    }

    public function cascade()
    {

        $this->col = $this->col . "  ON DELETE CASCADE ";
        return $this;
    }

    public function unique()
    {
        $this->col = $this->col . " UNIQUE ";
        return $this;
    }

    public function unsiGned()
    {
        $this->col = $this->col . " UNSIGNED ";
        return $this;
    }

}