<?php

use gremio\Model\Partner;
use gremio\Model\Address;
use gremio\Model\Dependent;
use gremio\Model\Logs;
use gremio\Model\Payment;
use gremio\Model\User;
use gremio\Page;
use gremio\PageAdmin;

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

$app->get('/admin/dependents', function () {

	$page = new PageAdmin();

	$page->setTpl("dependents");
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

$app->get('/admin/address/delete:id', function ($id) {

	$address = new Address();

	$address->listById($id);

	$conductor_id = $address->getconductor_id();

	$address->delete();

	header("location: /admin/conductor/profile$conductor_id");
	exit;
});

$app->get('/admin/dependent/delete:id', function ($id) {

	$dependent = new Dependent();

	$dependent->listById($id);

	$partner_id = $dependent->getpartner_id();

	$dependent->delete();

	header("location: /admin/partner/profile$partner_id");
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

$app->get('/admin/address/update:id', function ($id) {

	$page = new PageAdmin();

	$address = new Address();

	$address->listById($id);

	$page->setTpl("address-update", array(
		"endereco" => $address->getValues()
	));
});

$app->get('/admin/dependent/update:id', function ($id) {

	$page = new PageAdmin();

	$dependent = new Dependent();

	$dependent->listById($id);

	$familiarity = $dependent->getdependent_familiarity();

	$page->setTpl("dependent-update", array(
		"dependente" => $dependent->getValues(),
		"familiaridade" => $familiarity
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

$app->get('/admin/address/create:partner_id', function ($partner_id) {

	$page = new PageAdmin();

	$page->setTpl("address-create", array(
		"condutor" => $partner_id
	));
});

$app->get('/admin/dependent/create:partner_id', function ($partner_id) {

	$page = new PageAdmin();

	$page->setTpl("dependent-create");
});


// Get  create-end

// Get update

// Get update-end

// Get profiles

$app->get('/admin/partner/profile:id', function ($id) {

	$page = new PageAdmin();

	$partner = new Partner();

	$address = Address::listByPartnerId($id);

	$dependents = Dependent::listByPartnerId($id);

	$partner->get($id);


	$page->setTpl("partner-profile", array(
		"socio" => $partner->getValues(),
		"endereco" => $address,
		"dependentes" => $dependents
	));
});

// TO FIX
// TO FIX
// TO FIX
// TO FIX
// TO FIX
// TO FIX
// TO FIX
// TO FIX
// TO FIX
// TO FIX
// TO FIX
// TO FIX
// TO FIX
// TO FIX
// TO FIX

$app->get('/admin/dependent/profile:id', function ($id) {

	$page = new PageAdmin();

	$dependent = new Dependent();

	$dependent->listById($id);

	$partnerName = "GERVASIO";


	$page->setTpl("dependent-profile", array(
		"dependente" => $dependent->getValues(),
		"socio" => $partnerName
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

$app->get('/admin/payment/profile:id', function ($id) {

	$page = new PageAdmin();

	$payment = new Payment();

	$payment->get($id);

	$page->setTpl("payment-profile", array(
		"pagamento" => $payment->getValues()
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

$app->post('/admin/address/update:id', function ($id) {

	$address = new Address();

	$address->listById((int)$id);

	if ($address->verifyField("address_road", "Rua", 2, $_POST["address_road"], 2, "C"));
	if ($address->verifyField("address_number", "Numero", 1, $_POST["address_number"], 1, "C"));
	if ($address->verifyField("address_district", "Bairro", 3, $_POST["address_district"], 3, "C"));

	if (strlen($_POST["address_city"]) == 0) {
		$_POST["address_city"] = "Uruguaiana";
	}
	if (strlen($_POST["address_state"]) == 0) {
		$_POST["address_state"] = "RS";
	}
	if (strlen($_POST["address_complement"]) == 0) {
		$_POST["address_complement"] = "CASA";
	}
	if (strlen($_POST["address_cep"]) == 0) {
		$_POST["address_cep"] = "Nao informado";
	}

	$address->setData($_POST);

	$address->update($id);

	$partner_id = $address->getpartner_id();

	header("location: /admin/partner/profile$partner_id");
	exit;
});

$app->post('/admin/dependent/update:id', function ($id) {

	$dependent = new Dependent();

	$log = new Logs();

	$dependent->listById((int)$id);

	$prev_dependent = $dependent->getValues();

	if (isset($_POST["conj"])) {
		$_POST["dependent_familiarity"] = "cônjuge";
	}
	if (isset($_POST["chil"])) {
		$_POST["dependent_familiarity"] = "filho/filha";
	}
	if (isset($_POST["par"])) {
		$_POST["dependent_familiarity"] = "pai/mãe";
	}
	if (isset($_POST["other"])) {
		$_POST["dependent_familiarity"] = $_POST["others"];
	}

	if ($dependent->verifyField("dependent_name", "Nome", 3, $_POST["dependent_name"], 3, "U", $dependent->getdependent_name()));

	if (strlen($_POST["dependent_age"]) == 0) {
		$tipo = "Erro";
		$sucesso = '0';
		$mensagem = "Idade não informada";
		header("location: /admin/message?tipo=$tipo&sucesso=$sucesso&mensagem=$mensagem");
		exit;
	}

	if (strlen($_POST["dependent_familiarity"]) == 0) {
		$tipo = "Erro";
		$sucesso = '0';
		$mensagem = "Familiaridade não informada";
		header("location: /admin/message?tipo=$tipo&sucesso=$sucesso&mensagem=$mensagem");
		exit;
	}

	if (strlen($_POST["dependent_identity"]) == 0) {
		$_POST["dependent_identity"] = "Não informado";
	}
	if (strlen($_POST["dependent_cpf"]) == 0) {
		$_POST["dependent_cpf"] = "Não informado";
	}
	if (strlen($_POST["dependent_phone"]) == 0) {
		$_POST["dependent_phone"] = "Não informado";
	}
	if (strlen($_POST["dependent_note"]) == 0) {
		$_POST["dependent_note"] = "Não informado";
	}
	if (strlen($_POST["dependent_schooling"]) == 0) {
		$_POST["dependent_schooling"] = "Não informado";
	}

	$dependent->setData($_POST);

	$dependent->update($id);

	header("location: /admin/dependent/profile$id");
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

	// if ($partner->verifyField("partner_fullname", "Nome", 3, $_POST["partner_fullname"], 3, "C"));
	// if ($partner->verifyField("partner_cpf", "CPF", 14, $_POST["partner_cpf"], 11, "C"));
	// if ($partner->verifyField("partner_identity", "Identitade", 10, $_POST["partner_identity"], 10, "C"));
	// if ($partner->verifyField("partner_mobphone", "Telefone celular", 0, $_POST["partner_mobphone"], 0, "C"));
	// if ($partner->verifyField("partner_resphone", "Telefone residencial", 0, $_POST["partner_resphone"], 0, "C"));
	// if ($partner->verifyField("partner_age", "Idade", 1, $_POST["partner_age"], 1, "C"));

	$partner->setData($_POST);


	// var_dump($partner->getpartner_paymentday());


	// echo($partner->getDateForDatabase($partner->getpartner_paymentday()));
	
	// var_dump($partner);

	$result = $partner->create();


	header("location: /admin/partner/profile$result");
	
	exit;
});

// OKK
$app->post('/admin/address/create:partner_id', function ($partner_id) {

	$address = new Address();

	$address->setaddress_uniquetag($address->getUniqueTag());

	if ($address->verifyField("address_road", "Rua", 2, $_POST["address_road"], 2, "C"));
	if ($address->verifyField("address_number", "Numero", 1, $_POST["address_number"], 1, "C"));
	if ($address->verifyField("address_district", "Bairro", 3, $_POST["address_district"], 3, "C"));

	if (strlen($_POST["address_city"]) == 0) {
		$_POST["address_city"] = "Uruguaiana";
	}
	if (strlen($_POST["address_state"]) == 0) {
		$_POST["address_state"] = "RS";
	}
	if (strlen($_POST["address_complement"]) == 0) {
		$_POST["address_complement"] = "CASA";
	}
	if (strlen($_POST["address_cep"]) == 0) {
		$_POST["address_cep"] = "Nao informado";
	}

	$address->setData($_POST);



	$address->create($partner_id);

	header("location: /admin/partner/profile$partner_id");
	exit;
});

$app->post('/admin/dependent/create:partner_id', function ($conductor_id) {

	$dependent = new Dependent();

	$dependent->setdependent_uniquetag($dependent->getUniqueTag());

	$_POST["dependent_familiarity"] = "";


	if ($dependent->verifyField("dependent_fullname", "Nome", 3, $_POST["dependent_fullname"], 3, "C"));


	if (strlen($_POST["dependent_age"]) == 0) {
		$tipo = "Erro";
		$sucesso = '0';
		$mensagem = "Idade não informada";
		header("location: /admin/message?tipo=$tipo&sucesso=$sucesso&mensagem=$mensagem");
		exit;
	}

	

	// if (strlen($_POST["dependent_identity"]) == 0) {
	// 	$_POST["dependent_identity"] = "Não informado";
	// }
	// if (strlen($_POST["dependent_cpf"]) == 0) {
	// 	$_POST["dependent_cpf"] = "Não informado";
	// }
	// if (strlen($_POST["dependent_celphone"]) == 0) {
	// 	$_POST["dependent_phone"] = "Não informado";
	// }
	// if (strlen($_POST["dependent_mobphone"]) == 0) {
	// 	$_POST["dependent_phone"] = "Não informado";
	// }


	$dependent->setData($_POST);

	$result = $dependent->create($conductor_id)["dependent_id"];

	header("location: /admin/dependent/profile$result");
	exit;
});


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


