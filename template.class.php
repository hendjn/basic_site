<?php

class Template
{
    var $assignedValues = array();
    var $tmp;
    function __construct($path)
    {
        if (!empty($path)) {
            if (file_exists($path)) {
                $this->tmp = file_get_contents($path);
            } else {
                echo "<b>Template error:</b> File not exist";
            }
        }
    }

    function assign($key, $value)
    {
        $this->assignedValues[strtoupper($key)] = $value;
        // var_dump( $this-> assignedValues);
    }

    function show()
    {
        if (count($this->assignedValues) > 0) {
            foreach ($this->assignedValues as $key => $value) {
                $this->tmp = str_replace('{' . $key . '}', $value,  $this->tmp);
            }
        }
        echo $this->tmp;
    }
}
