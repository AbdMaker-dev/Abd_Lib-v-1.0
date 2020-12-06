<?php

// namespace databse\libs;
require path . 'database/libs/connexion.php';

abstract class DaoManager implements Idao
{
    protected $pdo;

    protected $className;

    protected $tabName;


    /**
     * add permet d'ajouter une nouvelle enregistrement dans la base
     */
    public function add($data)
    {
        $req = "INSERT INTO " . $this->tabName . " VALUES (null, " . $this->createRequeteAdd($data) . ")";
        return $this->excuteUpdate($req, $data);
    }

    /**
     * findAll return un tableau vide ou un tableau d'objets user
     */
    public function findAll()
    {

        $req = "SELECT * FROM " . $this->tabName;
        return $this->executeSlecte($req);
    }

    /**
     * findById return null ou un objet user
     */
    public function findById($id)
    {
        $req = "SELECT * FROM " . $this->tabName . " WHERE id = :id";

        return $this->executeSlecteById($req, $id);
    }

    /**
     * findBy return un tableau vide ou un tableau d'objets user
     */
    public function findBy($data)
    {
        $req = "SELECT * FROM " . $this->tabName . " WHERE ";
        $req = $this->createRequete($req, $data);
        // var_dump($req);
        return $this->executeSlecte($req, $data);
    }

    public function login($login, $password)
    {
        $req = "SELECT * FROM " . $this->tabName . " WHERE ";
        $req = $this->createRequete($req, ["login" => $login]);
        // var_dump($req);
        $user = $this->executeSlecte($req, ["login" => $login]);

        if ($user == null) {
            return false;
        }

        $user = $user[0];

        if (password_verify($password, $user->getPassword())) {
            $_SESSION['user'] = $user->setPassword(null);
            return true;
        }
    }

    /**
     * update Modifie les infos d'un user grace a l'ID
     */
    public function update($data)
    {
        $req = "UPDATE " . $this->tabName . " SET ";
        $req = $this->createRequeteUdate($req, $data);
        return $this->excuteUpdate($req, $data);
    }

    /**
     * Fonction qui permet d'ouvrir la connection
     */
    protected function getConnection()
    {
        if ($this->pdo == null) {
            
            $this->pdo = getConect();
        }
    }

    private function excuteUpdate($req, $data)
    {
        // $this->getConnection();

        $req =  $this->pdo->prepare($req);

        if (isset($data["password"])) {
            $data["password"] = password_hash($data["password"], PASSWORD_DEFAULT);
        }

        if ($req->execute($data)) {
            return true;
        }
        return false;
    }

    private function executeSlecte($req, $data = null)
    {
        // $this->getConnection();
        $req =  $this->pdo->prepare($req);

        if ($data != null) {
            $req->execute($data);
        } else {

            $req->execute();
        }
        // PDO::FETCH_ASSOC
        $res = $req->fetchAll(PDO::FETCH_ASSOC);
        if ($res == null) {
            return [];
        }
        $tabObject = [];
        foreach ($res as  $value) {
            $tabObject[] = new $this->className($value);
        }
        return $tabObject;
    }

    private function executeSlecteById($req, $id)
    {
        // $this->getConnection();

        $req =  $this->pdo->prepare($req);

        $req->execute(array("id" => $id));
        // PDO::FETCH_ASSOC
        $res = $req->fetch();

        if ($res == null) {
            return null;
        }

        $res = new $this->className($res);

        return $res;
    }

    private function createRequete($req, $data)
    {
        $keys = array_keys($data);

        for ($i = 0; $i < count($keys); $i++) {
            $req = $req . $keys[$i] . " = :" . $keys[$i];

            if (isset($keys[$i + 1])) {
                $req = $req . " AND ";
            }
        }

        return $req;
    }

    private function createRequeteAdd($data)
    {
        $req = '';
        $keys = array_keys($data);

        for ($i = 0; $i < count($keys); $i++) {
            $req = $req . " :" . $keys[$i];
            if (isset($keys[$i + 1])) {
                $req = $req . ", ";
            }
        }
        return $req;
    }

    private function createRequeteUdate($req, $data)
    {
        $keys = array_keys($data);

        for ($i = 0; $i < count($keys); $i++) {
            if ($keys[$i] != "id") {
                $req = $req . $keys[$i] . " = :" . $keys[$i];
                if (isset($keys[$i + 1]) && $keys[$i] != "id") {
                    $req = $req . " , ";
                }
            }
        }
        $req = $req . " WHERE id = :id";
        return $req;
    }

    // protected function loadClass()
    // {
    //     try {
    //         //Chargement des classes
    //         spl_autoload_register(function ($class) {
    //             $patchLibs = "/database/libs" . $class . ".php";
    //             $patchModels = "./models/" . $class . ".php";
    //             $patchDao = "models/dao/" . $class . ".php";

    //             if (file_exists($patchModels)) {
    //                 require_once($patchModels);
    //             } elseif (file_exists($patchLibs)) {
    //                 require_once($patchLibs);
    //             } elseif (file_exists($patchDao)) {
    //                 require_once($patchDao);
    //             }
    //         });
    //     } catch (\Throwable $th) {
    //         print_r($th);
    //     }
    // }
}
