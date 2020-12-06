<?php

namespace cols;

class Colonne
{
    private $col;
    private $attres;
    private $clas_name;
    private $closed;



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
                $enum = $enum . $vals[$i];
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

        $this->col = "CONSTRAINT `" . $attre . "_" . $ref . "_" . $attre_ref . "` FOREIGN KEY (`$attre`) REFERENCES `$ref` (`$attre_ref`) ";
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

    // fonction pour prendre en charge les modification
    public function addCol($col_name)
    {
        $this->col = $col_name;
        $this->attres[] = $col_name;
        $this->closed = 0;
        return $this;
    }

    public function save($className = null)
    {
        if ($className != null) {
            $this->clas_name = $className;
            $this->creat_class($className);
        } else {
            $this->attres = [];
        }
        return $this->col;
    }

  
    // creation de class et attributes 
    private function creat_class($className)
    {
        try {
            $file_name = "../models/" . ucfirst($className) . ".php";
            $file = fopen($file_name, "w+");

            $attributes = '';
            $getter_and_setter = '';
            foreach ($this->attres as $attr) {
                $attributes = $attributes . $this->add_atte($attr);
                $getter_and_setter = $getter_and_setter . $this->add_getter_setter($attr);
            }
            $contenu = "<?php\n\n" .
                "class " . ucfirst($className) . " extends Model\n" .
                "{\n" .
                $attributes .
                "\n" . $this->add_contruct() .
                "\n" . $this->add_hydrate_function() .
                "\n" . $getter_and_setter
                . "}";
            file_put_contents($file_name, $contenu);

            // creation du dao de le clases
            $this->creta_class_dao($className);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    private function creta_class_dao($className)
    {
        try {
            $file_name = "../models/dao/" . ucfirst($className) . "Dao.php";
            $file = fopen($file_name, "w+");
            $contenu = "<?php\n\n" .
                "class " . ucfirst($className) . "Dao extends DaoManager\n" .
                "{\n" .
                // $attributes.
                "\n" . $this->add_contruct_dao($className) .
                $this->add_commentaire_methodes_dao($className)
                . "}";
            file_put_contents($file_name, $contenu);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    private function add_atte($attr): string
    {
        return "\tprivate $" . $attr . ";\n";
    }

    private function add_getter($attre)
    {
        return "\n\tpublic function get" . ucfirst($attre) . "()\n"
            . "\t{\n" .
            "\t\treturn $" . "this->" . $attre . ";\n"
            . "\t}\n";
    }

    private function add_setter($attre)
    {
        return "\n\tpublic function set" . ucfirst($attre) . "($" . $attre . ")\n"
            . "\t{\n" .
            "\t\t$" . "this->" . $attre . " = $" . "$attre;\n"
            . "\t\treturn $" . "this;\n"
            . "\t}\n";
    }

    private function add_getter_setter($attre)
    {
        return $this->add_getter($attre) . $this->add_setter($attre);
    }

    public function add_contruct()
    {
        return "\n\tpublic function __construct($" . "data=null)\n\t{\n\t\tif($" . "data!=null)\n\t\t{\n\t\t\t$" . "this->hydrate($" . "data);\n\t\t}\n\t}\n";
    }

    public function add_contruct_dao($clas_name)
    {
        return "\n\tpublic function __construct()\n\t{\n\t\t$" . "this->className='" . ucfirst($clas_name) . "';\n\t\t$" . "this->tabName='" . $clas_name . "';\n\t\t$" . "this->getConnection();\n\t}\n";
    }

    private function add_hydrate_function()
    {
        return "\n\tpublic function hydrate($" . "data)\n\t{\n\t\tforeach ($" . "data as $" . "key => $" . "value)\n\t\t{\n\t\t\t$" . "this->$" . "key = $" . "value;\n\t\t}\n\t}\n";
    }

    private function add_commentaire_methodes_dao($clas_name)
    {
        return "\n\t/**\n\t* add(array data) permet d'ajouter une nouvelle enregistrement dans la base\n\t*/\n\n" .
            "\n\t/**\n\t* findAll() return un tableau vide ou un tableau d'objets " . $clas_name . "\n\t*/\n\n" .
            "\n\t/**\n\t* findById(id) return null ou un objet " . $clas_name . "\n\t*/\n\n" .
            "\n\t/**\n\t* findBy(array data) return un tableau vide ou un tableau d'objets " . $clas_name . "\n\t*/\n\n" .
            "\n\t/**\n\t* update(array data) Modifie les infos de l'objet " . $clas_name . " grace a l'ID\n\t*/\n\n".
            "\n\n\n\t/**\n\t* Vous pouvez cree ici vos propre fonctions pour interoger la base de donnees en utilisant $"."this->pdo pour excute les requets\n\t*/\n\n";
    }

}