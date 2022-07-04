<?php

namespace gremio\Model;

use \gremio\DB\Sql;
use \gremio\Model;

class Payment extends Model
{

    public static function listAll()
    {

        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_log");
    }

    public function listLogsPageSearch($type="log_id",$term = "", $page = 1, $itemsPerPage = 3)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_log
			WHERE $type LIKE '%$term%'
            ORDER BY log_dtregister DESC
			LIMIT $start, $itemsPerPage;
		",);

		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return [
			'logs'=>$results,
			'total'=>(int)$resultTotal[0]["nrtotal"],
			'pages'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];

	} 

    public static function listAllUniqueTag()
    {

        $sql = new Sql();

        $result = $sql->select("SELECT log_uniquetag  FROM tb_log");

        return $result;
    }

    public function save($user_id, $user_name,$log_target,$log_targetid,$log_targetobject, $log_operation, $log_beforedescription,$log_afterdescription)
    {
        $sql = new Sql();
        $uniqueTag = $this->getUniqueTag();
        if ($uniqueTag != null) {
            $sql->query(
                "INSERT INTO tb_log(
                    log_uniquetag,
                    user_id,
                    user_name,
                    log_target,
                    log_targetid,
                    log_targetobject,
                    log_operation,
                    log_beforedescription,
                    log_afterdescription
                ) VALUES(
                    '{$uniqueTag}',
                    '{$user_id}',
                    '{$user_name}',
                    '{$log_target}',
                    '{$log_targetid}',
                    '{$log_targetobject}',
                    '{$log_operation}',
                    '{$log_beforedescription}',
                    '{$log_afterdescription}'
                    )",
            );
            return "Registro adicionado com sucesso";
        } else {
            return "Falaha ao adicionar Conflito de TAG";
        }
    }

    public  function get($id)
    {
        $sql = new Sql();

        $result = $sql->select("SELECT * FROM tb_log WHERE log_id='$id'");


        return $this->setData($result[0]);
    }

    public function verifyTag($tag)
    {
        $allTags = $this->listAllUniqueTag();
        
            for ($i = 0; $i < sizeof($allTags); $i++) {
                if ($tag === $allTags[$i]["log_uniquetag"]) {
                    return false;
                }
            }
        return true;
    }

    public function getUniqueTag()
    {
        $prefix = "URU-";
        $ranNumber = rand(100, 99999999);
        $today = getdate()["year"] - 2000;
        $type = "TG";
        $uniqueTag = $prefix . $today . $ranNumber . $type;
        if ($this->verifyTag($uniqueTag)) {
            return $uniqueTag;
        } else {
            $this->getUniqueTag();
        }
    }
}
