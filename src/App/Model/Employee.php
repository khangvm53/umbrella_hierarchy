<?php
namespace App\Model;
use App\Model\BaseModel;

class Employee extends BaseModel {
    protected $table = 'employees';

    /**
     * find employee by name and his supervisor
     * @param $name
     * @return mixed|array
     */
    public function findSupervisorOfEmployee($name = null) {
        $sql = 'select'
            . ' supervisor.name as supervisorName,'
            . ' employee.name as employeeName'
            . ' from ' . $this->table . ' as employee'
            . ' inner join ' . $this->table . ' as supervisor'
            . ' on `supervisor`.`supervisor_id`=`employee`.`id`';
        if(!empty($name)){
            $sql .= ' where supervisor.name like ' . $this->escape("%$name%");
        }
        $sql .= ';';
        return $this->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
    }
}
