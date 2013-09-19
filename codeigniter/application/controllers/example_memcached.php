<?php
class Example_memcached extends CI_Controller
{   
    
    public function __construct()
    {
        parent::__construct();
        // Load library
        $this->load->helper(array('url', 'date', 'form'));
        $this->load->library('memcached_library');
        $this->load->database();
        $this->load->model('muser');
        $this->load->model('mcomment');
    }

    public function test()
    {
        // Lets try to get the key
        $results = $this->memcached_library->get('dvl');
        // If the key does not exist it could mean the key was never set or expired
        if (! $results) {
            // Modify this Query to your liking!
            //$query = $this->mcomment->getalldata(0,10);
            $query = $this->mcomment->getalldata(1, 0, 10);
           // echo "comment_id".$query['comment_id'];
            //$query = "hello world";

            // Lets store the results
            if (! $this->memcached_library->set('dvl', $query, null)) {
                echo "Set data not successful<br/>";
            } else {
                echo "Set data successful<br/>";
            }
            // Output a basic msg
            echo "Alright! Stored some results from the Query... Refresh Your Browser";
        } else {
            // Output
            echo "chay lan 2";
            // Now let us delete the key for demonstration sake!
            $data = $this->memcached_library->get('dvl');
            //$new_data[0]=$data[1];
            //$new_data[1]=$data[2];
            print_r($data);
        }

    }

    public function stats()
    {
        $this->load->library('memcached_library');
        echo $this->memcached_library->getversion();
        echo "<br/>";
        // We can use any of the following "reset, malloc, maps, cachedump, slabs, items, sizes"
        $p = $this->memcached_library->getstats("items");
        var_dump($p);
    }
}