<?php

defined('MOODLE_INTERNAL') || die();

class block_phonehome extends block_base {

    public function init() {
        $this->title = get_string('pluginname', 'block_phonehome');
    }

    function applicable_formats() {
        return array('all' => true, 'mod' => false, 'tag' => false, 'my' => false);
    }

    public function get_content() {
        global $USER;
        global $CFG;
		
		// Check if user is logged in
		if (!isloggedin())
		{
            return $this->content;
		}

		// Check if the block is activated
		if (isset($CFG->phonehome))	$activate_block = $CFG->phonehome;
		else						$activate_block = false;

		if (!$activate_block)
		{
            return $this->content;
		}

		// If content is cached
        if ($this->content !== NULL) {
            return $this->content;
        }

        $course  = $this->page->course;
        $context = context_course::instance($course->id);

		// Create empty content
        $this->content = new stdClass();

        // Can edit settings?
        $can_edit = has_capability('moodle/course:update', $context);

		if (isset($CFG->phonehome_timer))	$timer = $CFG->phonehome_timer;
		else								$timer = 60;

		$this->content->text = "";
		
		// fixme - add jquery for temp testing
		//$this->content->text .= "<script src=\"http://athenademo.it-university.nl/theme/bootstrap/js/jquery.js\"></script>\n";

		
		$this->content->text .= "<form name=\"phonehome_form\" id=\"phonehome_form\" action=\"" . $CFG->wwwroot . "/blocks/phonehome/insert.php\" method=\"post\" style=\"display: none;\">\n";
		$this->content->text .= "<input type=\"text\" name=\"user_id\" value=\"" . $USER->id . "\" />\n";
		$this->content->text .= "<input type=\"text\" name=\"session_key\" value=\"" . $USER->sesskey . "\" />\n";
		$this->content->text .= "<input type=\"text\" name=\"course_id\" value=\"" . $course->id . "\" />\n";
		$this->content->text .= "</form>\n";
	
		$this->content->text .= "<script type=\"text/javascript\">\n";
		$this->content->text .= "var is_admin = " . ((is_siteadmin())?1:0) . ";\n";
		$this->content->text .= "var timer = " . $timer . ";\n";
		$this->content->text .= "</script>\n";

		// Add the javascript
		$this->content->text .= "<script src=\"" . $CFG->wwwroot . "/blocks/phonehome/phonehome.js\"></script>\n";
		
        return $this->content;
    }
}
