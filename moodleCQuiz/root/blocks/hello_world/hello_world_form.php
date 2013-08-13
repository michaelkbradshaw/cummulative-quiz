<?php
require_once("{$CFG->libdir}/formslib.php");
require_once($CFG->dirroot.'/blocks/hello_world/lib.php');

class hello_world_form extends moodleform 
{

	function definition() 
	{

		$mform =& $this->_form;
		$mform->addElement('header','displayinfo', get_string('textfields', 'block_hello_world'));
		
		
		// add page title element.
		$mform->addElement('text', 'pagetitle', get_string('pagetitle', 'block_hello_world'));
		$mform->addRule('pagetitle', null, 'required', null, 'client');
		$mform->setType('pagetitle', PARAM_TEXT);
		
		// add display text field
		$mform->addElement('htmleditor', 'displaytext', get_string('displayedhtml', 'block_hello_world'));
		$mform->setType('displaytexttext', PARAM_RAW);
		$mform->addRule('displaytext', null, 'required', null, 'client');
		// add filename selection.
		$mform->addElement('filepicker', 'filename', get_string('file'), null, array('accepted_types' => '*'));
		// add picture fields grouping
		$mform->addElement('header', 'picfield', get_string('picturefields', 'block_hello_world'), null, false);
		// add display picture yes / no option
		$mform->addElement('selectyesno', 'displaypicture', get_string('displaypicture', 'block_hello_world'));
		$mform->setDefault('displaypicture', 1);
		
		
		//radios
		$images = block_hello_world_images();
		$radioarray = array();
		for ($i = 0; $i < count($images); $i++) {
			$radioarray[] =& $mform->createElement('radio', 'picture', '', $images[$i], $i);
		}
		$mform->addGroup($radioarray, 'radioar', get_string('pictureselect', 'block_hello_world'), array(' '), FALSE);
		
		// add description field
		$attributes = array('size' => '50', 'maxlength' => '100');
		$mform->addElement('text', 'description', get_string('picturedesc', 'block_hello_world'), $attributes);
		$mform->setType('description', PARAM_TEXT);
		
		// add optional grouping
		$mform->addElement('header', 'optional', get_string('optional', 'form'), null, false);
		
		// add date_time selector in optional area
		$mform->addElement('date_time_selector', 'displaydate', get_string('displaydate', 'block_hello_world'), array('optional' => true));
		$mform->setAdvanced('optional');
		
		
		$this->add_action_buttons();
		
		// hidden elements
		$mform->addElement('hidden', 'blockid');
		$mform->setType("blockid",PARAM_INT);
		$mform->addElement('hidden', 'courseid');
		$mform->setType("courseid",PARAM_INT);
		
		
	}
	
	
	
}