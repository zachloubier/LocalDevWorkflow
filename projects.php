<?php

class Project {

    protected $_master_file     = 'projects.json';
    protected $_data            = array();
    protected $_defaults        = array(
        'project_id'        => '',
        'project_name'      => '',
        'project_url'       => '',
        'project_type'      => '',
        'framework'         => '',
        'version'           => '1.0.0'
    );

    public function __construct($data = array()) {
        if (empty($data)) {
            return false;
        }

        $this->_setData($data);
        return $this;
    }

    protected function _setData($data) {
        $i = 0;
        foreach ($this->_defaults as $key => $default) {
            $this->_data[$key] = empty($data[$i])? $default : $data[$i];
            $i++;
        }
    }

    protected function _addToMasterFile() {
        if (!empty($this->_data)) {
            $file = fopen($this->_master_file, 'a');
            fwrite($file, json_encode($this->_data) . ",\n");
            fclose($file);
            return true;
        }
        return false;
    }

    public function getData() {
        return $this->_data;
    }


    public function save() {
        $this->_addToMasterFile();
//        var_dump($this->getData());
    }
}

$project = new Project(array_slice($argv, 1));

if ($project) {
    $project->save();
}

