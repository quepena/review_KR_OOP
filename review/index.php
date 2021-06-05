<?php
// /**
//  * Core bootloader
//  *
//  * @author Serhii Shkrabak
//  */

// /* RESULT STORAGE */
// $RESULT = [
// 	'state' => 0,
// 	'data' => [],
// 	'debug' => []
// ];

// /* ENVIRONMENT SETUP */
// define('ROOT', $_SERVER['DOCUMENT_ROOT'] . '/'); // Unity entrypoint;
// define('MODE', $_SERVER['MODE']);

// if (MODE == 'development')
// 	ini_set('display_errors', 'on');

// register_shutdown_function('shutdown', 'OK'); // Unity shutdown function

// spl_autoload_register('load'); // Class autoloader

// set_exception_handler('handler'); // Handle all errors in one function

// /* HANDLERS */

// /*
//  * Class autoloader
//  */
// function load (String $class):void {
// 	$class = strtolower(str_replace('\\', '/', $class));
// 	$file = "$class.php";
// 	if (file_exists($file))
// 		include $file;
// }

// /*
//  * Debug logger
//  */
// function printme ( Mixed $var ):void {
// 	$stack = debug_backtrace( DEBUG_BACKTRACE_PROVIDE_OBJECT, 1 )[ 0 ];
// 	$GLOBALS[ 'RESULT' ][ 'debug' ][] = [
// 		'type' => 'Trace',
// 		'details' => $var,
// 		'file' => $stack[ 'file' ],
// 		'line' => $stack[ 'line' ]
// 	];
// }

// /*
//  * Error logger
//  */
// function handler (Throwable $e):void {
// 	global $RESULT;
// 	$codes = ['SUCCESS', 'REQUEST_INCOMLETE', 'REQUEST_INCORRECT', 'ACCESS_DENIED', 'RESOURCE_LOST', 'REQUEST_UNKNOWN', 'INTERNAL_ERROR', 10 => 'ERROR_EXTERNAL'];
// 	$message = $e -> getMessage();
// 	$code = $e -> getCode();
// 	$RESULT['state'] = $code ? $code : 6;
// 	$RESULT['message'] = $codes[$RESULT['state']] . ": $message";
// 	$RESULT[ 'debug' ][] = [
// 		'type' => get_class($e),
// 		'details' => $message,
// 		'code' => $code,
// 		'file' => $e -> getFile(),
// 		'line' => $e -> getLine(),
// 		'trace' => $e -> getTrace()
// 	];
// }

// /*
//  * Shutdown handler
//  */
// function shutdown():void {
// 	global $RESULT;
// 	$error = error_get_last();
// 	if ( ! $error ) {
// 		header("Content-Type: application/json");

// 		if ($RESULT['state'])
// 			unset($RESULT['data']);
// 		if (MODE != 'development')
// 			unset($RESULT['debug']);
// 		echo json_encode($RESULT, JSON_UNESCAPED_UNICODE);
// 	}
// }

// if (! isset($_GET['file'])) {
// 	$CORE = new Controller\Main;
// 	$data = $CORE->exec();

// 	if ($data !== null)
// 		$RESULT['data'] = $data;
// 	else { // Error happens
// 		throw new Exception(code: 6);
// 		unset($RESULT['data']);
// 	}
// } else {
// 	if (isset($_GET['token']) && $_GET['token'] == 911 ) {
// 		$RESULT['data'] = [ file_get_contents(ROOT . $_GET['file']) ];
// 	}
// }_SERVER['MODE']);

// if (MODE == 'development')
// 	ini_set('display_errors', 'on');

// register_shutdown_function('shutdown', 'OK'); // Unity shutdown function

// spl_autoload_register('load'); // Class autoloader

// set_exception_handler('handler'); // Handle all errors in one function

// /* HANDLERS */

// /*
//  * Class autoloader
//  */
// function load (String $class):void {
// 	$class = strtolower(str_replace('\\', '/', $class));
// 	$file = "$class.php";
// 	if (file_exists($file))
// 		include $file;
// }

// /*
//  * Debug logger
//  */
// function printme ( Mixed $var ):void {
// 	$stack = debug_backtrace( DEBUG_BACKTRACE_PROVIDE_OBJECT, 1 )[ 0 ];
// 	$GLOBALS[ 'RESULT' ][ 'debug' ][] = [
// 		'type' => 'Trace',
// 		'details' => $var,
// 		'file' => $stack[ 'file' ],
// 		'line' => $stack[ 'line' ]
// 	];
// }

// /*
//  * Error logger
//  */
// function handler (Throwable $e):void {
// 	global $RESULT;
// 	$codes = ['SUCCESS', 'REQUEST_INCOMLETE', 'REQUEST_INCORRECT', 'ACCESS_DENIED', 'RESOURCE_LOST', 'REQUEST_UNKNOWN', 'INTERNAL_ERROR', 10 => 'ERROR_EXTERNAL'];
// 	$message = $e -> getMessage();
// 	$code = $e -> getCode();
// 	$RESULT['state'] = $code ? $code : 6;
// 	$RESULT['message'] = $codes[$RESULT['state']] . ": $message";
// 	$RESULT[ 'debug' ][] = [
// 		'type' => get_class($e),
// 		'details' => $message,
// 		'code' => $code,
// 		'file' => $e -> getFile(),
// 		'line' => $e -> getLine(),
// 		'trace' => $e -> getTrace()
// 	];
// }

// /*
//  * Shutdown handler
//  */
// function shutdown():void {
// 	global $RESULT;
// 	$error = error_get_last();
// 	if ( ! $error ) {
// 		header("Content-Type: application/json");

// 		if ($RESULT['state'])
// 			unset($RESULT['data']);
// 		if (MODE != 'development')
// 			unset($RESULT['debug']);
// 		echo json_encode($RESULT, JSON_UNESCAPED_UNICODE);
// 	}
// }

// if (! isset($_GET['file'])) {
// 	$CORE = new Controller\Main;
// 	$data = $CORE->exec();

// 	if ($data !== null)
// 		$RESULT['data'] = $data;
// 	else { // Error happens
// 		throw new Exception(code: 6);
// 		unset($RESULT['data']);
// 	}
// } else {
// 	if (isset($_GET['token']) && $_GET['token'] == 911 ) {
// 		$RESULT['data'] = [ file_get_contents(ROOT . $_GET['file']) ];
// 	}
// }
 

require_once('/usr/share/nginx/apps/base/infograph.php');

// <!-- 
// while($info = mysqli_fetch_assoc($result1)) { 
//   $main = $info['main'];
// }
// if($query1) {
//   infographics("lecturer", $name, $row["main"], evaluation, distance, punctuality, objectivity, politness, relevans, exams, lecture, knowledge);
// } -->



?>

<html>
<head>
  <title>Review</title>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Jura:wght@300&display=swap" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- <script type="text/javascript">
    function viewInfo() {
      if (document.getElementById("info").style.display === "none") ||  (document.getElementById("data").style.display === "flex")
      {
        (document.getElementById("info").style.display = "flex");
        (document.getElementById("data").style.display = "none");
      }
      else document.getElementById("info").style.display = "none";
    }
    function viewData() {
      if (document.getElementById("data").style.display === "none") ||  (document.getElementById("info").style.display === "flex")
      {
        (document.getElementById("data").style.display = "flex");
        (document.getElementById("info").style.display = "none");
      }
    else document.getElementById("data").style.display = "none";
    }
  </script> -->
  <style type="text/css">
    body {
      font-family: 'Jura', sans-serif;
      background-color: #EEE;
    }
    header {
      font-size: 24pt;
      color: #f0f8ff;
      border: solid #2c2c2d 2px;
      background-color: #2a2a32;
      height: 10%;
      display: flex;
      margin-bottom: 1%;
      padding-left: 1%;
      align-items: center;
    }
    header img {
      height: 50px;
      width: 50px;
      margin: 0 auto;
      padding-right: 25%;
    }
    .container {
      width: 100%;
      text-align: center;
      margin: 0 auto;
      font-size: 1rem;
    }
    #data {
      display: flex;
      margin-top: 3%;
      border: solid #2a2a32 2px;
      background-color: #EEE;
      border-radius: 20px;
      height: 450px;
      width: 70%;
    }
    button {
      font-family: 'Jura', sans-serif;
      text-transform: uppercase;
      text-decoration: none;
      border: none;
      color: #FFF;
      font-size: 12pt;
      padding: 10px;
      font-weight: bold;
      background-color: #2a2a32;
      box-shadow: 2px 2px 3px #0C0C0C;
      transition: .4s;
      margin-bottom: 3rem;
    }
    button:hover {
      background: #5c5c6e;
      color: white;
      transform: translateY(-7px);
    }
    footer {
      position: fixed;
      font-size: 18pt;
      color: aliceblue;
      left: 0; bottom: 0;
      border: solid #2c2c2d 2px;
      background-color: #2f2f30;
      height: 10%;
      margin-top: 1%;
      padding: 10px;
      width: 100%;
      text-align: center;
    }
    .bottom {
      padding-top: 1%;
      font-size: 17pt;
    }
  </style>
</head>
<body>
<header>
  <a href="https://opu.ua/"><img src="https://dashboard.pnit.od.ua/media/logo.svg" alt="OPU_logo"></a>
  <div class="name">Система оцінки викладачів</div>
</header>
<div class ="container">
  <button onmousedown="viewData()">Список викладачів</button><br>  
  <?php
  require_once('/usr/share/nginx/apps/base/infograph.php');

  $link = mysqli_connect("mysql", "root", "my_password", "core");
  
  $result=mysqli_query($link, "SELECT name FROM Teacher");
  while ($row = mysqli_fetch_assoc($result)) {
    ?><a href="infographics/lecturerimage23.png"><?php echo $row["name"] ?></a><br> <?php
    $name = $row["name"];
  }
  $query1 = ("select guid from lecturer where name=<?php echo $name ?>");
  $result1=mysqli_query($link, "SELECT evaluation FROM Lecturer where name=<?php echo $name ?>");

  $query2 = ("select guid from practician where name=<?php echo $name ?>");
  ?>
</div>
<footer>
<div class="bottom">Цифрова трансформація Одеської політехніки</div>
<div class="date">2021</div>
</footer>
</body>
</html>