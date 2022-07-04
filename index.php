<?php

use chamados\Model\Partner;
use chamados\Model\Address;
use chamados\Model\Dependent;
use chamados\Model\Logs;
use chamados\Model\Payment;
use chamados\Model\User;
use chamados\Page;
use chamados\PageAdmin;

session_start();
require_once("vendor/autoload.php");

use Slim\Slim;



$app = new Slim();


$app->config('debug', true);

require_once("functions.php");




// Get

$app->get('/', function () {

	

	$page = new PageAdmin();

	$page->setTpl("index", array(
		"administrador" => User::getUserIsAdmin(),
		"id" => $_SESSION[User::SESSION]["user_id"]
	));
});


$app->get('/login', function () {

	$page = new PageAdmin([
		"header" => false,
		"footer" => false
	]);

	$page->setTpl("login");
});

// TO FIX
$app->get('/admin', function () {

	$page = new PageAdmin();

	$user = new User;



	var_dump($user::listAll());

	$page->setTpl("index", array(
		"administrador" => "1",
		"id" => "1"
	));
});

$app->get('/logout', function () {

	

	User::logout();

	header("Location:/");
	exit;
});

$app->get('/forgot', function () {

	$page = new PageAdmin([
		"header" => false,
		"footer" => false
	]);

	$page->setTpl("forgot");
});

$app->get("/forgot/sent", function () {

	$page = new Page([
		"header" => false,
		"footer" => false
	]);

	$page->setTpl("forgot-sent");
	exit;
});

$app->get("/forgot/reset", function () {

	User::validForgotDecrypt($_GET["code"]);

	$page = new Page([
		"header" => false,
		"footer" => false
	]);

	$page->setTpl("forgot-reset", array(
		"code" => $_GET["code"]
	));
	exit;
});

$app->get("/admin/message", function () {


	$page = new PageAdmin([
		"header" => false,
		"footer" => false
	]);

	$tipo = $_GET['tipo'];
	$sucesso = $_GET['sucesso'];
	$mensagem = $_GET['mensagem'];


	$page->setTpl("message", array(
		"tipo" => $tipo,
		"resposta" => $mensagem,
		"sucesso" => $sucesso
	));
});


// Get all

$app->get('/admin/partners', function () {

	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
	$type = (isset($_GET['type'])) ? $_GET['type'] : "partner_fullname";
	$term = (isset($_GET['term'])) ? $_GET['term'] : "";

	$partner = new Partner();

	$pagination = $partner->listPertnersPageSearch($type, $term, $page);

	$pages = [];

	for ($i = 1; $i <= $pagination['pages']; $i++) {
		array_push($pages, [
			'link' => '/admin/partners?' . http_build_query([
				'page' => $i,
				'type' => $type,
				'term' => $term
			]),
			'text' => $i
		]);
	}

	$page = new PageAdmin();

	$page->setTpl("partners", array(
		"socios" => $pagination["partners"],
		"pages" => $pages,
		"tipo" => $type,
		"termo" => $term
	));
});

$app->get('/admin/users', function () {

	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
	$type = (isset($_GET['type'])) ? $_GET['type'] : "user_name";
	$term = (isset($_GET['term'])) ? $_GET['term'] : "";

	$user = new User();

	$pagination = $user->listUsersPageSearch($type, $term, $page);

	$pages = [];

	for ($i = 1; $i <= $pagination['pages']; $i++) {
		array_push($pages, [
			'link' => '/admin/users?' . http_build_query([
				'page' => $i,
				'type' => $type,
				'term' => $term
			]),
			'text' => $i
		]);
	}

	$page = new PageAdmin();

	if ((int)User::getUserIsAdmin() == 1) {
		$page->setTpl("users", array(
			"usuarios" => $pagination['users'],
			"administrador" => User::getUserIsAdmin(),
			"pages" => $pages,
			"tipo" => $type,
			"termo" => $term
		));
	} else {
		header("Location:/admin");
	}
});


$app->get('/admin/logs', function () {

	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
	$type = (isset($_GET['type'])) ? $_GET['type'] : "log_id";
	$term = (isset($_GET['term'])) ? $_GET['term'] : "";

	$log = new Logs();


	if ($type == "EX") {
		$type = "log_operation";
		$term = "EX";
	} elseif ($type == "AT") {
		$type = "log_operation";
		$term = "AT";
	} elseif ($type == "RG") {
		$type = "log_operation";
		$term = "RG";
	}

	if ($type == "user" || $term == "Usuarios") {
		$type = "log_targetobject";
		$term = "user";
	} elseif ($type == "partner" || $term == "Socios") {
		$type = "log_targetobject";
		$term = "partner";
	} elseif ($type == "dependent" || $term == "Dependentes") {
		$type = "log_targetobject";
		$term = "dependent";
	}


	$pagination = $log->listLogsPageSearch($type, $term, $page);

	$pages = [];

	for ($i = 1; $i <= $pagination['pages']; $i++) {
		array_push($pages, [
			'link' => '/admin/logs?' . http_build_query([
				'page' => $i,
				'type' => $type,
				'term' => $term
			]),
			'text' => $i
		]);
	}

	$page = new PageAdmin();

	$page->setTpl("logs", array(
		"logs" => $pagination["logs"],
		"pages" => $pages,
		"tipo" => $type,
		"termo" => $term
	));
});
// Get all-end              

// Get delete

$app->get('/admin/partner/delete:id', function ($id) {

	$partner = new Partner();

	$partner->get($id);

	$partner->delete();

	header("location: /admin/partners");
	exit;
});

$app->get('/admin/user/delete:id', function ($id) {

	$user = new User();

	$user->get($id);

	$user->delete();

	header("location: /admin/users");
	exit;
});


// Get delete-end

// Get update

$app->get('/admin/partner/update:id', function ($id) {

	$page = new PageAdmin();

	$partner = new Partner();

	$partner->get($id);

	$page->setTpl("partner-update", array(
		"socio" => $partner->getValues()
	));
});

$app->get('/admin/user/update:id', function ($id) {

	$page = new PageAdmin();

	$user = new User();

	$user->get($id);

	$page->setTpl("user-update", array(
		"usuario" => $user->getValues(),
		"administrador" => User::getUserIsAdmin()
	));
});

// Get update-end

// Get create

$app->get('/admin/partner/create', function () {

	$page = new PageAdmin();

	$page->setTpl("partner-create");
});

$app->get('/admin/user/create', function () {

	$page = new PageAdmin();

	$page->setTpl("user-create");
});


// Get  create-end

// Get update

// Get update-end

// Get profiles

$app->get('/admin/partner/profile:id', function ($id) {

	$page = new PageAdmin();

	$partner = new Partner();

	// $address = Address::listByPartnerId($id);

	// $dependents = Dependent::listByPartnerId($id);

	$partner->get($id);


	$page->setTpl("partner-profile", array(
		"socio" => $partner->getValues()
		// "endereco" => $address
		// "dependentes" => $dependents
	));
});


$app->get('/admin/user/profile:id', function ($id) {

	$page = new PageAdmin();

	$user = new User();

	$user->get($id);

	$page->setTpl("user-profile", array(
		"usuario" => $user->getValues(),
		"administrador" => User::getUserIsAdmin()
	));
});

$app->get('/admin/log/profile:id', function ($id) {

	$page = new PageAdmin();

	$log = new Logs();

	$log->get($id);

	$page->setTpl("log-profile", array(
		"registro" => $log->getValues()
	));
});

// Get profiles-end

// Get - end

// Post update
$app->post('/admin/user/update:id', function ($id) {

	$user = new User();

	$user->get((int)$id);

	if (isset($_POST["yes"])) {
		$_POST["user_isadmin"] = "1";
	} else	if (isset($_POST["no"])) {
		$_POST["user_isadmin"] = "0";
	} else {
		$_POST["user_isadmin"] = "0";
	}

	if ($user->verifyField("user_name", "Nome", 3, $_POST["user_name"], 3, "U", $user->getuser_name()));
	if ($user->verifyField("user_phone", "Telefone", 15, $_POST["user_phone"], 11, "U", $user->getuser_phone()));
	if ($user->verifyField("user_login", "Login", 6, $_POST["user_login"], 6, "U", $user->getuser_login()));
	if ($user->verifyField("user_email", "Email", 1, $_POST["user_email"], 1, "U", $user->getuser_email()));


	$user->setData($_POST);

	$user->update($id);

	$user->updateUserSession($id);

	header("location: /admin/user/profile$id");
	exit;
});


$app->post('/admin/partner/update:id', function ($id) {

	$partner = new Partner();

	$partner->get((int)$id);

	if (strlen($_POST["partner_identity"]) == 0) {
		$_POST["partner_identity"] = "Não informado";
	}
	if (strlen($_POST["partner_cpf"]) == 0) {
		$_POST["partner_cpf"] = "Não informado";
	}
	if (strlen($_POST["partner_schooling"]) == 0) {
		$_POST["partner_schooling"] = "Não informado";
	}

	if ($partner->verifyField("partner_name", "Nome", 3, $_POST["partner_name"], 3, "U", $partner->getpartner_name()));
	if ($partner->verifyField("partner_age", "Idade", 1, $_POST["partner_age"], 1, "U", $partner->getpartner_age()));

	$partner->setData($_POST);

	$partner->update($id);

	header("location: /admin/partner/profile$id");
	exit;
});

// Post update-end

// Post create

$app->post('/admin/user/create', function () {

	$user = new User();

	$user->setuser_uniquetag($user->getUniqueTag());

	if (isset($_POST["yes"])) {
		$_POST["user_isadmin"] = "1";
	} else	if (isset($_POST["no"])) {
		$_POST["user_isadmin"] = "0";
	} else {
		$_POST["user_isadmin"] = "0";
	}

	if ($user->verifyField("user_name", "Nome", 3, $_POST["user_name"], 3, "C"));
	if ($user->verifyField("user_phone", "Telefone", 15, $_POST["user_phone"], 11, "C"));
	if ($user->verifyField("user_login", "Login", 6, $_POST["user_login"], 6, "C"));
	if ($user->verifyField("user_email", "Email", 1, $_POST["user_email"], 1, "C"));

	if (strlen($_POST['user_password']) < 6) {
		$tipo = "Erro";
		$sucesso = '0';
		$mensagem = "A senhas devem ter pelo menos 6 caracteres";
		header("location: /admin/message?tipo=$tipo&sucesso=$sucesso&mensagem=$mensagem");
		exit;
	} else {
		if ($_POST['user_password'] === $_POST['verify_user_password']) {
			$_POST['user_password'] = $user->getCriptoPassword($_POST['user_password']);
		} else {
			$tipo = "Erro";
			$sucesso = '0';
			$mensagem = "A senhas devem ser iguais";
			header("location: /admin/message?tipo=$tipo&sucesso=$sucesso&mensagem=$mensagem");
			exit;
		}
	}

	$user->setData($_POST);

	$result = $user->create()["user_id"];

	$log = new Logs();

	header("location: /admin/user/profile$result");
	exit;
});

// To finish
$app->post('/admin/partner/create', function () {

	$partner = new Partner();

	$partner->setpartner_uniquetag($partner->getUniqueTag());

	if (strlen($_POST["partner_mobphone"]) == 0) {
		$_POST["partner_phone"] = "Não informado";
	}
	if (strlen($_POST["partner_resphone"]) == 0) {
		$_POST["partner_phone"] = "Não informado";
	}


	$partner->setData($_POST);

	$result = $partner->create();


	header("location: /admin/partner/profile$result");
	
	exit;
});

// OKK


// Post create-end


// Post app

$app->post('/admin/login', function () {

	User::login($_POST["user_login"], $_POST["user_password"]);

	header("Location:/admin");
	exit;
});


$app->post("/forgot", function () {

	User::getForgot($_POST["user_email"]);

	header("Location: /forgot/sent");
	exit;
});

$app->post("/forgot/reset", function () {

	$page = new PageAdmin([
		"header" => false,
		"footer" => false
	]);


	if ($_POST['user_password'] === $_POST["user_verify_password"]) {

		$forgot = User::validForgotDecrypt($_POST["verify_code"]);
		$user = new User();
		$user->setData($user->getByEmail($forgot["recovery_email"]));
		$user->setuser_password($_POST['user_password'] = $user->getCriptoPassword($_POST['user_password']));
		$user->setPassword();
		$user->setFogotUsed($forgot["recovery_id"]);
		$tipo = "Sucesso";
		$sucesso = '1';
		$mensagem = "Senha alterada com sucesso";
		header("location: /admin/message?tipo=$tipo&sucesso=$sucesso&mensagem=$mensagem");
		exit;
	} else {
		$tipo = "Erro";
		$sucesso = '0';
		$mensagem = "Falha ao trocar a senha";
		header("location: /admin/message?tipo=$tipo&sucesso=$sucesso&mensagem=$mensagem");
		exit;
	}

});


$app->run();


