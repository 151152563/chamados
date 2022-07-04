<?php

namespace gremio\Model;

use \gremio\DB\Sql;
use \gremio\Model;
use \gremio\Mailer;

class User extends Model
{

    const SESSION = "User";
    const SECRET = "cavalinhopocoto";
    const SECRET_IV = "pedepano";
    const ERROR = "Error";
    const ERROR_REGISTER = "ErrorRegister";
    const SUCCESS = "Sucesss";


    public static function login($login, $password)
    {

        $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_user WHERE user_login ='$login'");

        if (count($results) === 0) {
            $tipo = "Erro";
            $sucesso = '0';
            $mensagem = "Login ou senha invalidos";
            header("location: /admin/message?tipo=$tipo&sucesso=$sucesso&mensagem=$mensagem");
            exit;
        }

        $data = $results[0];



        if (password_verify($password, $data["user_password"]) === true) {
            $user = new User();

            $user->setData($data);

            $_SESSION[User::SESSION] = $user->getValues();

            return $user;
        } else {
            $tipo = "Erro";
            $sucesso = '0';
            $mensagem = "Login ou senha invalidos";
            header("location: /admin/message?tipo=$tipo&sucesso=$sucesso&mensagem=$mensagem");
            exit;
        }
    }

    public function updateUserSession($id)
    {

        if ((int)$id == (int)$_SESSION[User::SESSION]["user_id"]) {
            $_SESSION[User::SESSION] = $this->getValues();
        }
    }

    public static function verifyLogin()
    {

        if (
            !isset($_SESSION[User::SESSION])
            ||
            !$_SESSION[User::SESSION]
            ||
            !(int)$_SESSION[User::SESSION]["user_id"] > 0
        ) {
            header("Location:/login");
            exit;
        } else {
            return 1;
        }

    }

    public static function logout()
    {

        $_SESSION[User::SESSION] = null;
    }

    public static function getUserIsAdmin()
    {
        return $_SESSION[User::SESSION]["user_isadmin"];
    }

    public function listUsersPageSearch($type="user_name",$term = "", $page = 1, $itemsPerPage = 10)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_user
			WHERE $type LIKE '%$term%'
            ORDER BY user_dtregister DESC
			LIMIT $start, $itemsPerPage;
		",);

		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return [
			'users'=>$results,
			'total'=>(int)$resultTotal[0]["nrtotal"],
			'pages'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];

	} 

    public static function listAll()
    {

        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_user");
    }

    public static function listAllUniqueTag()
    {

        $sql = new Sql();

        $result = $sql->select("SELECT user_uniquetag  FROM tb_user");

        return $result;
    }

    public function create()
    {
        $sql = new Sql();
        $uniqueTag = $this->getUniqueTag();
        if ($uniqueTag != null) {
            $sql->query(
                "INSERT INTO tb_user(
                user_uniquetag,
                user_isadmin,
                user_name,
                user_sector,
                user_office,
                user_email,
                user_phone,
                user_login,
                user_password,
                user_profilepicture
                ) VALUES(
                    '{$uniqueTag}',
                    '{$this->getuser_isadmin()}',
                    '{$this->getuser_name()}',
                    '{$this->getuser_sector()}',
                    '{$this->getuser_office()}',
                    '{$this->getuser_email()}',
                    '{$this->getuser_phone()}',
                    '{$this->getuser_login()}',
                    '{$this->getuser_password()}',
                    '{$this->getuser_profilepicture()}'
                    )",
            );
            $results2 = $sql->select("SELECT user_id FROM tb_user
            WHERE user_id = LAST_INSERT_ID()");
            return $results2[0];
        } else {
            return 0;
        }
    }

    public  function get($id)
    {
        $sql = new Sql();

        $result = $sql->select("SELECT * FROM tb_user WHERE user_id='$id'");


        return $this->setData($result[0]);
    }

    public function getByEmail($email)
    {

        $sql = new Sql();

        $results =  $sql->select("SELECT * FROM tb_user WHERE user_email=:email;", array(
            ":email" => $email
        ));

        return $results[0];
    }


    public function verifyFieldById($id, $field, $value)
    {

        $sql = new Sql();

        $result = $sql->select("SELECT '$field' FROM tb_user WHERE user_id='$id'");

        if ($result == $value) {
            return 0;
        } else {
            return 1;
        }
    }

    public function verifyField($field, $fieldName, $fieldLen, $value, $extra, $type ,$prev_value = "")
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
                $result = $sql->select("SELECT $field FROM tb_user WHERE $field = '$value'");
                if (count($result) > 0) {
                    $tipo = "Erro";
                    $sucesso = '0';
                    $mensagem = "$fieldName invalido";
                    header("location: /admin/message?tipo=$tipo&sucesso=$sucesso&mensagem=$mensagem");
                    exit;
                } else {
                    return true;
                }
            }else if($type === "U"){
                if($value === $prev_value){
                    return true;
                }else{
                    $sql = new Sql();
                    $result = $sql->select("SELECT $field FROM tb_user WHERE $field = '$value'");
                    if (count($result) > 0) {
                        $tipo = "Erro";
                        $sucesso = '0';
                        $mensagem = "$fieldName invalido";
                        header("location: /admin/message?tipo=$tipo&sucesso=$sucesso&mensagem=$mensagem");
                        exit;
                    } else{
                        return true;
                    }
                }
            }
        }
    }

    public function update($id)
    {
        $sql = new Sql();
        $sql->query("UPDATE tb_user SET 
        user_isadmin='{$this->getuser_isadmin()}',
        user_name='{$this->getuser_name()}',
        user_sector='{$this->getuser_sector()}',
        user_office='{$this->getuser_office()}',
        user_phone='{$this->getuser_phone()}',
        user_login='{$this->getuser_login()}',
        user_email='{$this->getuser_email()}',
        user_profilepicture='{$this->getuser_profilepicture()}'
        WHERE user_id= '{$id}'");
    }

    public function delete()
    {
        $sql = new Sql();

        $this->removePicture($this->getuser_profilepicture());

        $sql->query("DELETE FROM tb_user  WHERE user_id='{$this->getuser_id()}'");
    }

    public function removePicture($picture)
    {
        if ($picture == "/res/_assets/_defaultimg/user.jpg") {
            echo "IMAGEM PADRÃO";
        } else {
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . $picture)) {
                unlink($_SERVER['DOCUMENT_ROOT'] . $picture);
                echo "File Successfully Delete.";
            } else {
                echo "File does not exists or default picture";
            }
        }
    }

    public function verifyTag($tag)
    {
        $allTags = $this->listAllUniqueTag();

        for ($i = 0; $i < sizeof($allTags); $i++) {
            if ($tag === $allTags[$i]["user_uniquetag"]) {
                return false;
            }
        }
        return true;
    }

    public function getUniqueTag()
    {
        $prefix = "URU-";
        $ranNumber = rand(100, 999);
        $today = getdate()["year"] - 2000;
        $type = "US";
        $uniqueTag = $prefix . $today . $ranNumber . $type;
        if ($this->verifyTag($uniqueTag)) {
            return $uniqueTag;
        } else {
            $this->getUniqueTag();
        }
    }

    public function checkphoto()
    {
        if (file_exists(
            $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR .
                "res" . DIRECTORY_SEPARATOR .
                "_assets" . DIRECTORY_SEPARATOR .
                "_userimg" . DIRECTORY_SEPARATOR .
                $this->getuser_uniquetag() . ".jpg"
        )) {
            $url = "/res/_assets/_userimg/"  . $this->getuser_uniquetag() . ".jpg";
        } else {
            $url = "/res/_assets/_defaultimg/user.jpg";
        }
        return $this->setuser_profilepicture($url);
    }

    public function setPhoto($photo)
    {
        $extension = explode('.', $photo['name']);
        $extension = end($extension);

        switch ($extension) {
            case "jpg":
            case "jpeg":
                $image = imagecreatefromjpeg($photo["tmp_name"]);
                break;

            case "gif":
                $image = imagecreatefromgif($photo["tmp_name"]);
                break;

            case "png":
                $image = imagecreatefrompng($photo["tmp_name"]);
                break;
        }

        $dist =  $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR .
            "res" . DIRECTORY_SEPARATOR .
            "_assets" . DIRECTORY_SEPARATOR .
            "_userimg" . DIRECTORY_SEPARATOR .
            $this->getuser_uniquetag() .
            ".jpg";

        imagejpeg($image, $dist);

        imagedestroy($image);

        $this->checkphoto();
    }

    public static function getForgot($email)
    {
        $sql = new Sql();

        $results =  $sql->select("SELECT * FROM tb_user WHERE user_email=:email;", array(
            ":email" => $email
        ));

        if (count($results) === 0) {
            echo "Não foi possivel recuperar a senha";
        } else {
            $data = $results[0];

            $results2 = $sql->select("CALL sp_recovery_create(:recovery_email,:recovery_ip)", array(
                ":recovery_email" => $data["user_email"],
                ":recovery_ip" => $_SERVER["REMOTE_ADDR"]
            ));

            if (count($results2) === 0) {
                echo ("NAO VEIO NADA");
            } else {

                $dataRecovery = $results2[0];

                $code = openssl_encrypt($dataRecovery['recovery_id'], 'AES-128-CBC', pack("a16", User::SECRET), 0, pack("a16", User::SECRET_IV));

                $code = base64_encode($code);

                $link = "www.horseapp.com/forgot/reset?code=$code";

                $mailer = new Mailer($data['user_email'], $data['user_name'], "Redefinir senha do Horse APP", "forgot", array(
                    "name" => $data['user_name'],
                    "link" => $link
                ));


                $mailer->send();

                return $link;
            }
        }
    }

    public static function validForgotDecrypt($code)
    {

        $code = base64_decode($code);

        $idrecovery = openssl_decrypt($code, 'AES-128-CBC', pack("a16", User::SECRET), 0, pack("a16", User::SECRET_IV));

        $sql = new Sql();

        $results = $sql->select(" SELECT * FROM tb_recovery WHERE recovery_id = :recovery_id
				AND
				recovery_dtrecovery IS NULL
				AND
                recovery_valid_key = 1
                AND
				DATE_ADD(recovery_dtregister, INTERVAL 1 HOUR) >= NOW();
		", array(
            ":recovery_id" => $idrecovery
        ));

        if (count($results) === 0) {
            $tipo = "Erro";
            $sucesso = '0';
            $mensagem = "Falha ao trocar a senha ou codigo expirado";
            header("location: /admin/message?tipo=$tipo&sucesso=$sucesso&mensagem=$mensagem");
            exit;
        } else {

            return $results[0];
        }
    }

    public static function setFogotUsed($idrecovery)
    {

        $sql = new Sql();

        $sql->query("UPDATE tb_recovery SET recovery_dtrecovery = NOW(), recovery_valid_key = 0 WHERE recovery_id = :recovery_id", array(
            ":recovery_id" => $idrecovery
        ));
    }

    public function setPassword()
    {
        $sql = new Sql();
        $sql->query("UPDATE tb_user SET 
            user_password='{$this->getuser_password()}'
            WHERE user_id= '{$this->getuser_id()}'");
    }

    public function getCriptoPassword($password)
    {
        $cripto = password_hash($password, PASSWORD_DEFAULT, [
            "cost" => 12
        ]);

        return $cripto;
    }


}
