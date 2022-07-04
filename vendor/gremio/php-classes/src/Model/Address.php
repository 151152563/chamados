<?php

namespace gremio\Model;

use \gremio\DB\Sql;
use \gremio\Model;

class Address extends Model
{

    public static function listAll()
    {
        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_address");
    }


    public function listById($address_id)
    {
        $sql = new Sql();

        $result = $sql->select("SELECT * FROM tb_address WHERE address_id='{$address_id}'");

        return $this->setData($result[0]);
    }


    public static function listByPartnerId($partner_id)
    {
        $sql = new Sql();

        $result = $sql->select("SELECT * FROM tb_address WHERE partner_id='{$partner_id}'");

        if (sizeof($result) > 0) {
            return $result[0];
        } else {
            return false;
        }
    }

    public static function listAllUniqueTag()
    {

        $sql = new Sql();

        $result = $sql->select("SELECT address_uniquetag  FROM tb_address");

        return $result;
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
            return true;
        }
    }

    public function create($conductor_id)
    {
        $sql = new Sql();
        $uniqueTag = $this->getUniqueTag();
        if ($uniqueTag != null) {
            $results = $sql->query(
                "INSERT INTO tb_address(
                partner_id,
                address_uniquetag,
                address_road,
                address_number,
                address_complement,
                address_district,
                address_cep,
                address_city,
                address_state
                ) VALUES(
                    '{$conductor_id}',
                    '{$uniqueTag}',
                    '{$this->getaddress_road()}',
                    '{$this->getaddress_number()}',
                    '{$this->getaddress_complement()}',
                    '{$this->getaddress_district()}',
                    '{$this->getaddress_cep()}',
                    '{$this->getaddress_city()}',
                    '{$this->getaddress_state()}'
                    )",
            );
            $results2 = $sql->select("SELECT address_id FROM tb_address
        WHERE address_id = LAST_INSERT_ID()");
            return $results2[0];
        }else {
            return 0;
        }
    }

    public function update($id)
    {
        $sql = new Sql();
        $results = $sql->query("UPDATE tb_address SET 
        address_road='{$this->getaddress_road()}',
        address_number='{$this->getaddress_number()}',
        address_complement='{$this->getaddress_complement()}',
        address_district='{$this->getaddress_district()}',
        address_cep='{$this->getaddress_cep()}', 
        address_city='{$this->getaddress_city()}', 
        address_state='{$this->getaddress_state()}' 
        WHERE address_id='{$id}'");

        return $results;
    }

    public function delete()
    {
        $sql = new Sql();

        $sql->query("DELETE FROM tb_address  WHERE address_id='{$this->getaddress_id()}'");
    }

    public function verifyTag($tag)
    {
        $allTags = $this->listAllUniqueTag();

        for ($i = 0; $i < sizeof($allTags); $i++) {
            if ($tag === $allTags[$i]["address_uniquetag"]) {
                return false;
            }
        }
        return true;
    }

    public function getUniqueTag()
    {
        $prefix = "URU-";
        $ranNumber = rand(100, 99999);
        $today = getdate()["year"] - 2000;
        $type = "AD";
        $uniqueTag = $prefix . $today . $ranNumber . $type;
        if ($this->verifyTag($uniqueTag)) {
            return $uniqueTag;
        } else {
            $this->getUniqueTag();
        }
    }
}
