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
 * This file defines the setting form for the cquiz responses report.
 *
 * @package   cquiz_responses
 * @copyright 2008 Jean-Michel Vedrine
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/mod/cquiz/report/attemptsreport_form.php');


/**
 * Quiz responses report settings form.
 *
 * @copyright 2008 Jean-Michel Vedrine
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class cquiz_responses_settings_form extends mod_cquiz_attempts_report_form {

    protected function other_preference_fields(MoodleQuickForm $mform) {
        $mform->addGroup(array(
            $mform->createElement('advcheckbox', 'qtext', '',
                get_string('questiontext', 'cquiz_responses')),
            $mform->createElement('advcheckbox', 'resp', '',
                get_string('response', 'cquiz_responses')),
            $mform->createElement('advcheckbox', 'right', '',
                get_string('rightanswer', 'cquiz_responses')),
        ), 'coloptions', get_string('showthe', 'cquiz_responses'), array(' '), false);
        $mform->disabledIf('qtext', 'attempts', 'eq', cquiz_attempts_report::ENROLLED_WITHOUT);
        $mform->disabledIf('resp',  'attempts', 'eq', cquiz_attempts_report::ENROLLED_WITHOUT);
        $mform->disabledIf('right', 'attempts', 'eq', cquiz_attempts_report::ENROLLED_WITHOUT);
    }

    public function validation($data, $files) {
        $errors = parent::validation($data, $files);

        if ($data['attempts'] != cquiz_attempts_report::ENROLLED_WITHOUT && !(
                $data['qtext'] || $data['resp'] || $data['right'])) {
            $errors['coloptions'] = get_string('reportmustselectstate', 'cquiz');
        }

        return $errors;
    }
}
