<?php
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
 * Add event handlers for the cquiz
 *
 * @package    mod_cquiz
 * @category   event
 * @copyright  2011 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();


$handlers = array(
    // Handle our own cquiz_attempt_submitted event, as a way to send confirmation
    // messages asynchronously.
    'cquiz_attempt_submitted' => array (
        'handlerfile'     => '/mod/cquiz/locallib.php',
        'handlerfunction' => 'cquiz_attempt_submitted_handler',
        'schedule'        => 'cron',
    ),

    // Handle our own cquiz_attempt_overdue event, to email the student to let them
    // know they forgot to submit, and that they have another chance.
    'cquiz_attempt_overdue' => array (
        'handlerfile'     => '/mod/cquiz/locallib.php',
        'handlerfunction' => 'cquiz_attempt_overdue_handler',
        'schedule'        => 'cron',
    ),

    // Handle group events, so that open cquiz attempts with group overrides get
    // updated check times.
    'groups_member_added' => array (
        'handlerfile'     => '/mod/cquiz/locallib.php',
        'handlerfunction' => 'cquiz_groups_member_added_handler',
        'schedule'        => 'instant',
    ),
    'groups_member_removed' => array (
        'handlerfile'     => '/mod/cquiz/locallib.php',
        'handlerfunction' => 'cquiz_groups_member_removed_handler',
        'schedule'        => 'instant',
    ),
    'groups_members_removed' => array (
        'handlerfile'     => '/mod/cquiz/locallib.php',
        'handlerfunction' => 'cquiz_groups_members_removed_handler',
        'schedule'        => 'instant',
    ),
    'groups_group_deleted' => array (
        'handlerfile'     => '/mod/cquiz/locallib.php',
        'handlerfunction' => 'cquiz_groups_group_deleted_handler',
        'schedule'        => 'instant',
    ),
);

/* List of events generated by the cquiz module, with the fields on the event object.

cquiz_attempt_started
    ->component   = 'mod_cquiz';
    ->attemptid   = // The id of the new cquiz attempt.
    ->timestart   = // The timestamp of when the attempt was started.
    ->timestamp   = // The timestamp of when the attempt was started.
    ->userid      = // The user id that the attempt belongs to.
    ->cquizid      = // The cquiz id of the cquiz the attempt belongs to.
    ->cmid        = // The course_module id of the cquiz the attempt belongs to.
    ->courseid    = // The course id of the course the cquiz belongs to.

cquiz_attempt_submitted
    ->component   = 'mod_cquiz';
    ->attemptid   = // The id of the cquiz attempt that was submitted.
    ->timefinish  = // The timestamp of when the attempt was submitted.
    ->timestamp   = // The timestamp of when the attempt was submitted.
    ->userid      = // The user id that the attempt belongs to.
    ->submitterid = // The user id of the user who sumitted the attempt.
    ->cquizid      = // The cquiz id of the cquiz the attempt belongs to.
    ->cmid        = // The course_module id of the cquiz the attempt belongs to.
    ->courseid    = // The course id of the course the cquiz belongs to.

cquiz_attempt_overdue
    ->component   = 'mod_cquiz';
    ->attemptid   = // The id of the cquiz attempt that has become overdue.
    ->timestamp   = // The timestamp of when the attempt become overdue.
    ->userid      = // The user id that the attempt belongs to.
    ->submitterid = // The user id of the user who triggered this transition (may be null, e.g. on cron.).
    ->cquizid      = // The cquiz id of the cquiz the attempt belongs to.
    ->cmid        = // The course_module id of the cquiz the attempt belongs to.
    ->courseid    = // The course id of the course the cquiz belongs to.

cquiz_attempt_abandoned
    ->component   = 'mod_cquiz';
    ->attemptid   = // The id of the cquiz attempt that was submitted.
    ->timestamp   = // The timestamp of when the attempt was submitted.
    ->userid      = // The user id that the attempt belongs to.
    ->submitterid = // The user id of the user who triggered this transition (may be null, e.g. on cron.).
    ->cquizid      = // The cquiz id of the cquiz the attempt belongs to.
    ->cmid        = // The course_module id of the cquiz the attempt belongs to.
    ->courseid    = // The course id of the course the cquiz belongs to.

*/
