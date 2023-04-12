<?php

namespace App\Controller;

use App\Trait\Response;
use App\Trait\Hierarchy;
use App\Model\Employee;

class HierarchyController
{
    use Response;
    use Hierarchy;

    private $requestMethod;
    private $action;

    /**
     * @param $requestMethod
     * @param $action
     */
    public function __construct($requestMethod, $action = null)
    {
        $this->requestMethod = $requestMethod;
        $this->action = $action;
    }

    /**
     * @return void
     */
    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'GET':
                $this->seachInUmbrellaHierarchy($_GET);
                break;
            case 'POST':
                $this->beautyUmbrellaHierarchyJson($_POST);
                break;
            default:
                $this->responseMethodNotAllowed();
                break;
        }
    }

    /**
     * @param $json
     * @return false|string
     */
    public function beautyUmbrellaHierarchyJson($requestData)
    {
        if (!isset($requestData['json']) || empty($requestData['json'])) {
            $this->responseValidationError();
        }
        $arrayData = json_decode($requestData['json'], true);
        if (json_last_error() === JSON_ERROR_NONE) {
            $root = $this->findRootHierarchy($arrayData);
            if (is_null($root)) {
                $this->responseValidationError('Hierarchy is not validate');
            }
            $hierarchy = [$root => $this->beautyHierarchyJson($arrayData, $root)];
            $this->responseSuccess($hierarchy);
        } else {
            $this->responseValidationError();
        }
    }

    /**
     * search employee and his supervisor by name
     * @param $requestData
     * @return void
     */
    public function seachInUmbrellaHierarchy($requestData)
    {
        $name = isset($requestData['name']) ? $requestData['name'] : null;
        $employeeModel = new Employee();
        $this->responseSuccess($this->beautyHierarchyJsonFromFetchAssoc($employeeModel->findSupervisorOfEmployee($name)));
    }

}