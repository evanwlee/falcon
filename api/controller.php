<?php

interface Controller
{

    /**
     * * @param array $input The request parameters/data 
     * * @return mixed The (userialized) return data
     */
    public function execute($input, &$result);
}

class controllerFactory
{

    public static function getInstance($serviceName, &$result)
    {
        $result["message"]["checkpoints"][] = "Controller Factory: Started";
        if ($serviceName != '') {
            $className = $serviceName . 'Controller';
            if (class_exists($className)) {
                $result["message"]["checkpoints"][] = "Controller Factory: Getting controller " . $className;
                return new $className();
            } else {
                $result["message"]["error"][] = "A matching service cannot be found so this is not a valid service request.";
            }
        } else {
            $result["message"]["error"][] = "A service (op) must be specified for this to be a valid service request.";
        }
        return new errorHandlerController();
    }
}

class errorHandlerController implements Controller
{
//     protected $message;
//     function __construct($msg) {
//         $this->message = $msg;
//     }
    public function execute($input, &$result)
    {
        $result["isError"] = true;
    }
}

class LightToggleController implements Controller
{

    public function execute($input, &$result)
    {
        $state = strtolower($input['action']);
        $id = $input['id'];
        
        $script = $state . $id . '.py';
        
        $pythonCommand = escapeshellcmd("sudo /usr/bin/python /code/falconLightLib/".$script);
        $output = shell_exec($pythonCommand);
        $result["message"]["checkpoints"][] = "Toggle ".$input['id']." to " .$input['action']. " Invoked : result=" . $output;
        $result["message"]["checkpoints"][] = "Shell command is: ".$pythonCommand;
        
        $result["output"] = $output;
    }
}

class LightStateController implements Controller
{
    
    public function execute($input, &$result)
    {
               
        $result["message"]["checkpoints"][] = "Get Stored States (may be bad if PI reset)";
        $result["output"] = $data;
    }
}

class VoiceStateController implements Controller
{
    
    public function execute($input, &$result)
    {
        
        $command = escapeshellcmd("sudo /bin/bash /code/falconLightLib/restart.sh");
        $output = shell_exec($command);
        $result["message"]["checkpoints"][] = "Restart Voice Controller";
        
        $result["output"] = $output;
        $result["message"]["checkpoints"][] = "Toggle ".$input['id']." to " .$input['action']. " Invoked : result=".$output;
        $result["message"]["checkpoints"][] = "Shell command is: ".$pythonCommand;
        
        $output = shell_exec("/usr/bin/python /code/falconLightLib/hello.ph");
        $result["message"]["checkpoints"][] = "Toggle ".$input['id']." to " .$input['action']. " Invoked : result=".$output;
        $result["message"]["checkpoints"][] = "Shell command is: ".$pythonCommand;
        
        $result["output"] = $output;

    }
}

/**
 * BELOW is main entry for the Controller Code *
 */
$result = array(
    "isError" => false,
    "message" => array(
        "error" => array(),
        "status" => array(),
        "checkpoints" => array()
    ),
    "post" => $_POST,
    "get" => $_GET,
    "output" => array(),
    "errorFieldNames" => array()
);

$serviceArgs = null;
if (isset($_POST['op']) && $_POST['op'] != '') {
    $serviceArgs = $_POST;
} else if (isset($_GET['op']) && $_GET['op'] != '') {
    $serviceArgs = $_GET;
}

if ($serviceArgs != null) {
    $controller = controllerFactory::getInstance($serviceArgs['op'], $result);
    $controller->execute($serviceArgs, $result);
} else {
    $result["isError"] = true;
    $result["message"]["error"][] = "A service (op) must be specified for this to be a valid service request.";
}

if ($result["isError"]) {
    http_response_code(400);
}
header('Content-Type: application/json');
echo json_encode($result);
?>


