<?php /** @noinspection ALL */
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 *
 * @package    block_add
 * @copyright  Mohammad Ahmad
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_add extends block_base {

    function init() {
        $this->title = get_string('pluginname', 'block_add');

    }

    function applicable_formats() {
        return array('all' => true, 'tag' => false);
    }

    function specialization() {
		global $USER;
        $this->title = isset($this->config->title) ? $this->config->title : $USER->email;

    }

    function instance_allow_multiple() {
        return true;
    }

    function get_content()
    {

        global $USER, $DB;

        if ($this->content !== NULL) {
            return $this->content;
        }
        $this->content = new stdClass();
        $a=$DB->get_records('role_assignments');
        $b=$DB->get_records('role');
        foreach($a as $data){
            $roles = $DB->get_records('role_capabilities',['roleid'=>$data->roleid]);
            foreach ($roles as $role) {
//              $this->content->text .= 'role = '.$USER->shortname;
                $this->content->footer .= "Permission  = ".$role->capability."</br>" ;
            }
        }foreach($b as $c){
            $a= $DB->get_records('role',['shortname'=>$c->shortname]);
            foreach($a as $e){
                $this->content->text = 'role = '.$e->shortname;
            }


    }

    }



	
	function has_config() {return true;}
}

