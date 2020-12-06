<?php
namespace creatclass;

class CreatEntity
{


    // creation de class et attributes 
    protected function creat_class($className)
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

    protected function creta_class_dao($className)
    {
        try {
            $file_name = "../models/dao/" . \strval(ucfirst($className))."Dao.php";
            $file = fopen($file_name, "w+");
            $contenu = "<?php\n\n" .
                "class " . \strval(ucfirst($className))."Dao extends DaoManager\n" .
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

    protected function add_atte($attr): string
    {
        return "\tprivate $" . $attr . ";\n";
    }

    protected function add_getter($attre)
    {
        return "\n\tpublic function get" . ucfirst($attre) . "()\n"
            . "\t{\n" .
            "\t\treturn $" . "this->" . $attre . ";\n"
            . "\t}\n";
    }

    protected function add_setter($attre)
    {
        return "\n\tpublic function set" . ucfirst($attre) . "($" . $attre . ")\n"
            . "\t{\n" .
            "\t\t$" . "this->" . $attre . " = $" . "$attre;\n"
            . "\t\treturn $" . "this;\n"
            . "\t}\n";
    }

    protected function add_getter_setter($attre)
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

    protected function add_hydrate_function()
    {
        return "\n\tpublic function hydrate($" . "data)\n\t{\n\t\tforeach ($" . "data as $" . "key => $" . "value)\n\t\t{\n\t\t\t$" . "this->$" . "key = $" . "value;\n\t\t}\n\t}\n";
    }

    protected function add_commentaire_methodes_dao($clas_name)
    {
        return "\n\t/**\n\t* add(array data) permet d'ajouter une nouvelle enregistrement dans la base\n\t*/\n\n" .
            "\n\t/**\n\t* findAll() return un tableau vide ou un tableau d'objets " . $clas_name . "\n\t*/\n\n" .
            "\n\t/**\n\t* findById(id) return null ou un objet " . $clas_name . "\n\t*/\n\n" .
            "\n\t/**\n\t* findBy(array data) return un tableau vide ou un tableau d'objets " . $clas_name . "\n\t*/\n\n" .
            "\n\t/**\n\t* updateupdate(array data) Modifie les infos de l'objet " . $clas_name . " grace a l'ID\n\t*/\n\n".
            "\n\n\n\t/**\n\t* Vous pouvez cree ici vos propre fonctions pour interoger la base de donnees en utilisant $"."this->pdo pour excute les requets\n\t*/\n\n";
    }
}