<?php

function block_hello_world_images() {
	return array(html_writer::tag('img', '', array('alt' => get_string('red', 'block_hello_world'), 'src' => "pix/red.png")),
			html_writer::tag('img', '', array('alt' => get_string('blue', 'block_hello_world'), 'src' => "pix/blue.png")),
			html_writer::tag('img', '', array('alt' => get_string('green', 'block_hello_world'), 'src' => "pix/green.png")));
}