<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
* Code Igniter AJAX Class
*
* This class enables you to check User Authentication with the help of Session.
*
* @package        CodeIgniter
* @subpackage    Libraries
* @category    Libraries
* @author        Aniesh
* @link        http://www.no-link-yet.com
*/


class authentication
{
    private $obj = null;

    function User_authentication()
    {
        $this->obj=&get_instance();
    }

    function user_validation()
    {

        // Not logged in, then redirect to the Home Page.
        if(!$this->obj->session->userdata('logged_in')||$this->obj->session->userdata('logged_in') )
            redirect('');
    }

}
?>