<?php
/**
 * Created by PhpStorm.
 * User: edo
 * Date: 2/14/2017
 * Time: 11:32 AM
 */

class CI_Mongo extends Mongo
{
    var $dbm;

    function CI_Mongo()
    {
        // Fetch CodeIgniter instance
        $ci = get_instance();
        // Load Mongo configuration file
        $ci->load->config('mongo');

        // Fetch Mongo server and database configuration
        $server = $ci->config->item('mongo_server');
        $dbname = $ci->config->item('mongo_dbname');

        // Initialise Mongo
        if ($server)
        {
            parent::__construct($server);
        }
        else
        {
            parent::__construct();
        }
        $this->dbm = $this->$dbname;
    }
}