<?php
namespace App\Trait;

/**
 * Trait Hierarchy
 * @package App\Trait\Hierarchy
 */
trait Hierarchy
{
    /**
     * build hierarchy by recursive
     * @param $arrayData
     * @param string $root
     * @param array $hierarchy
     * @return array
     */
    public function beautyHierarchyJson(&$arrayData, $root, $hierarchy = []){
        $subEmployees = $this->findEmployeesBySupervisor($arrayData, $root);
        if(count($subEmployees) > 0 ){
            foreach ($subEmployees as $sub ){
                $subEmployees = $this->beautyHierarchyJson($arrayData, $sub,  isset($hierarchy[$root]) ? $hierarchy[$root] : []);
                $hierarchy[$sub] = $subEmployees;
            }
        }
        return $hierarchy;
    }

    /**
     * get root of hierarchy
     * @param $arrayData
     * @return mixed|null
     */
    public function findRootHierarchy(&$arrayData){
        foreach($arrayData as $supervisor ){
            if(!isset($arrayData[$supervisor])){
                return $supervisor;
            }
        }
        return null;
    }

    /**
     * @param $arrayData
     * @param string $supervisor
     * @return array
     */
    public function findEmployeesBySupervisor(&$arrayData, $supervisor){
        $result = [];
        foreach($arrayData as $_employee => $_supervisor ){
            if($supervisor === $_supervisor){
                $result[] = $_employee;
            }
        }
        return $result;
    }

    /**
     * @param $fetchData
     * @return array
     */
    public function beautyHierarchyJsonFromFetchAssoc($fetchData){
        $hierarchy = [];
        foreach ($fetchData as $row){
            $hierarchy[] = [$row['employeeName'] => [$row['supervisorName'] => []]];
        }
        return count($hierarchy) == 1 ? $hierarchy[0] : $hierarchy;
    }
}