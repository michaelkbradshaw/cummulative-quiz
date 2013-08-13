<?php
class block_hello_world extends block_list 
{
	public function init() 
	{
		$this->title = get_string('hello_world', 'block_hello_world');
	}
	
	
	//called right after config has been filled out
	public function specialization() 
	{
		if (!empty($this->config->title)) 
		{
			$this->title = $this->config->title;
		}
	
		/*if (empty($this->config->text)) 
		{
			$this->config->text =  get_string('default_text', 'block_hello_world');
		}*/
	}
	
	public function get_content() {
		if ($this->content !== null) {
			return $this->content;
		}
	
		$this->content         = new stdClass;
		$this->content->items  = array();
		$this->content->icons  = array();
		$this->content->footer = 'Footer here...';
	
		/*$this->content->items[] = html_writer::tag('a', 'Menu Option 1', array('href' => 'http://www.google.com'));
		$this->content->icons[] = html_writer::empty_tag('img', array('src' => 'images/icons/1.gif', 'class' => 'icon'));
	*/
		// Add more list items here
	
		global $COURSE, $DB,$USER,$CFG;
		include_once($CFG->dirroot.'/mod/cquiz/locallib.php');
		//FIXME cquiz should be part of private data...
		
		
		$scores = cquiz_get_cummulative_scores(1,$USER->id);
		
		// Iterate over the instances
		foreach ($scores as $score) 
		{
			//print_object($question);
//			$this->content->items[] = "$question[1] has $question[2] with answer $question[3]";
			if($score->name !== "EASTER_EGG")
			{
			$text = <<<TEXT
			<h4>$score->name</h4>
			<progress value='$score->last_score' max='$score->max_score' > current $score->last_score ,max $score->max_score"</progress>"
			current $score->last_score /max $score->max_score";
TEXT;
			
			
			$this->content->items[] = $text; 
			$this->content->icons[] = html_writer::empty_tag('img', array('src' => 'images/icons/1.gif', 'class' => 'icon'));
			}			
		}
		
/*			// Recreate block object
			$block = block_instance('simplehtml', $instance);
		
			// $block is now the equivalent of $this in 'normal' block
			// usage, e.g.
			$someconfigitem = $block->config->item2;
		
			
			
		}*/
		
		
		
		
		
		
		
		
		
		
		
		/*
		
		// The other code.
		
		$url = new moodle_url('/blocks/hello_world/view.php', array('blockid' => $this->instance->id, 'courseid' => $COURSE->id));
		$this->content->footer = html_writer::link($url, get_string('addPage', 'block_hello_world'));
		*/
		
		
		
		return $this->content;
	}
	/*
	//fills out the content in the block
	public function get_content() {
		if ($this->content !== null) {
			return $this->content;
		}
	
		$this->content         =  new stdClass;
		
		if (! empty($this->config->text))
		{
			$this->content->text = $this->config->text;
		}
		else
		{
			$this->content->text   =  "Should never get here";
		}
			
		global $COURSE;
		
		// The other code.
		
		$url = new moodle_url('/blocks/hello_world/view.php', array('blockid' => $this->instance->id, 'courseid' => $COURSE->id));
		$this->content->footer = html_writer::link($url, get_string('addPage', 'block_hello_world'));
		
		
		//$this->content->footer = 'Footer here...';
	
		return $this->content;
	}
	*/
	public function instance_allow_multiple() 
	{
		return false;
	}
	
	
}

