<?php

namespace gremio\Model;

use \gremio\DB\Sql;
use \gremio\Model;

class Dependent extends Model
{




    public static function listAll()
    {
        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_dependent");
    }

    public function listById($dependent_id)
    {
        $sql = new Sql();

        $result = $sql->select("SELECT * FROM tb_dependent WHERE dependent_id='{$dependent_id}'");

        if (sizeof($result) > 0) {
            return $this->setData($result[0]);
        } else {
            return false;
        }
    }

    public static function listByPartnerId($partner_id)
    {
        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_dependent WHERE partner_id='{$partner_id}'");
    }

    public static function listAllUniqueTag()
    {

        $sql = new Sql();

        $result = $sql->select("SELECT dependent_uniquetag  FROM tb_dependent");

        return $result;
    }

    public function create($partner_id)
    {
        $sql = new Sql();
        $uniqueTag = $this->getUniqueTag();
        if ($uniqueTag != null) {
            $result =  $sql->query("INSERT INTO tb_dependent (
            partner_id,
            dependent_uniquetag,
            dependent_fullname,
            dependent_dtnasc,
            dependent_age,
            dependent_cpf,
            dependent_identity,
            dependent_mobphone,
            dependent_resphone,
            dependent_email,
            dependent_familiarity
            ) VALUES(
                '{$partner_id}',
                '{$uniqueTag}',
                '{$this->getdependent_fullname()}',
                '{$this->getdependent_dtnasc()}',
                '{$this->getdependent_age()}',
                '{$this->getdependent_cpf()}',
                '{$this->getdependent_identity()}',
                '{$this->getdependent_mobphone()}',
                '{$this->getdependent_resphone()}',
                '{$this->getdependent_email()}',
                '{$this->getdependent_familiarity()}'
                )",);

            $results2 = $sql->select("SELECT dependent_id FROM tb_dependent
            WHERE dependent_id = LAST_INSERT_ID()");
            return $results2[0];
        } else {
            return 0;
        }
    }

    public function verifyField($field, $fieldName, $fieldLen, $value, $extra, $type, $prev_value = "")
    {
        if (strlen($value) < $fieldLen) {
            $tipo = "Erro";
            $sucesso = '0';
            $mensagem = "O Campo $fieldName devem ter pelo menos $extra caracteres";
            header("location: /admin/message?tipo=$tipo&sucesso=$sucesso&mensagem=$mensagem");
            exit;
        } else {
            if ($type === "C") {
                $sql = new Sql();
                $result = $sql->select("SELECT $field FROM tb_dependent WHERE $field = '$value'");
                if (count($result) > 0) {
                    $tipo = "Erro";
                    $sucesso = '0';
                    $mensagem = "$fieldName invalido";
                    header("location: /admin/message?tipo=$tipo&sucesso=$sucesso&mensagem=$mensagem");
                    exit;
                } else {
                    return true;
                }
            } else if ($type === "U") {
                if ($value === $prev_value) {
                    return true;
                } else {
                    $sql = new Sql();
                    $result = $sql->select("SELECT $field FROM tb_dependent WHERE $field = '$value'");
                    if (count($result) > 0) {
                        $tipo = "Erro";
                        $sucesso = '0';
                        $mensagem = "$fieldName invalido";
                        header("location: /admin/message?tipo=$tipo&sucesso=$sucesso&mensagem=$mensagem");
                        exit;
                    } else {
                        return true;
                    }
                }
            }
        }
    }

    public function update($id)
    {
        $sql = new Sql();

        $results = $sql->query("UPDATE tb_dependent SET 
            dependent_fullname='{$this->getdependent_name()}',
            dependent_dtnasc='{$this->getdependent_age()}',
            dependent_cpf='{$this->getdependent_cpf()}',
            dependent_identity='{$this->getdependent_identity()}',
            dependent_mobphone='{$this->getdependent_mobphone()}',
            dependent_resphone='{$this->getdependent_resphone()}',
            dependent_email='{$this->getdependent_email()}',
            dependent_familiarity='{$this->getdependent_familiarity()}'
            WHERE dependent_id='{$id}'");

        return $results;
    }

    public function delete()
    {
        $sql = new Sql();

        $sql->query("DELETE FROM tb_dependent  WHERE dependent_id='{$this->getdependent_id()}'");
    }


    public function verifyTag($tag)
    {
        $allTags = $this->listAllUniqueTag();

        for ($i = 0; $i < sizeof($allTags); $i++) {
            if ($tag === $allTags[$i]["dependent_uniquetag"]) {
                return false;
            }
        }
        return true;
    }

    public function getUniqueTag()
    {
        $prefix = "GRE-";
        $ranNumber = rand(100, 99999);
        $today = getdate()["year"] - 2000;
        $type = "DEP";
        $uniqueTag = $prefix . $today . $ranNumber . $type;
        if ($this->verifyTag($uniqueTag)) {
            return $uniqueTag;
        } else {
            $this->getUniqueTag();
        }
    }
}
