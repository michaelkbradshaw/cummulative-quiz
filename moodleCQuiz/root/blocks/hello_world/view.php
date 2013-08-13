<?php

require_once('../../config.php');
require_once('hello_world_form.php');

global $DB,$OUTPUT,$PAGE;

// Check for all required variables.
$courseid = required_param('courseid', PARAM_INT);

$blockid = required_param('blockid', PARAM_INT);

// Next look for optional variables.
$id = optional_param('id', 0, PARAM_INT);


if (!$course = $DB->get_record('course', array('id' => $courseid))) 
{
	print_error('invalidcourse', 'block_hello_world', $courseid);
}

require_login($course);

$PAGE->set_url('/blocks/hello_world/view.php', array('id' => $courseid));
$PAGE->set_pagelayout('standard');
$PAGE->set_heading(get_string('edithtml', 'block_hello_world'));

//settype($blockid,"int");
//setType($blockid,"int");

$hello_f = new hello_world_form();
$toform['blockid'] = $blockid;
$toform['courseid'] = $courseid;
$hello_f->set_data($toform);



if($hello_f->is_cancelled()) 
{
	// Cancelled forms redirect to the course main page.
	$courseurl = new moodle_url('/course/view.php', array('id' => $id));
	redirect($courseurl);
}
else if ($fromform = $hello_f->get_data()) 
{
	// We need to add code to appropriately act on and store the submitted data
	if (!$DB->insert_record('block_hello_world', $fromform)) {
		print_error('inserterror', 'block_hello_world');
	}
	//print_object($fromform);
	
	// We need to add code to appropriately act on and store the submitted data
	// but for now we will just redirect back to the course main page.
	$courseurl = new moodle_url('/course/view.php', array('id' => $courseid));
	redirect($courseurl);
}
else 
{
	// form didn't validate or this is the first display
	$site = get_site();

	echo $OUTPUT->header();
	//bread crumbs
	//TODO fix bread crumbs
	/*
	$settingsnode = $PAGE->settingsnav->add(get_string('helloworldsettings', 'block_hello_world'));
	$editurl = new moodle_url('/blocks/hello_world/view.php', array('id' => $id, 'courseid' => $courseid, 'blockid' => $blockid));
	$editnode = $settingsnode->add(get_string('editpage', 'block_hello_world'), $editurl);
	$editnode->make_active();
	*/
	$hello_f->display();
	echo $OUTPUT->footer();
}
