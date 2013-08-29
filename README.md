cummulative-quiz
================

A set of Moodle Module to create a cummulative quiz activity


Cummulative Report
------------------

This has no effect when outide of a course page.



Storing grades for your cummulative quiz on a quiz by quiz basis
----------------------------------------------------------------

When the cummulative quiz determines that a user has recieved grade G on 
questions from quiz Q, it will search for assignments and update them based on their name.  There are two cases.


Cummulative Q     == records all scores
Complete G For Q  == only record grade G and nothing else


Storing by group
~~~~~~~~~~~~~~~~

If you are working with groups, you can add the group name to the assignments to only save for that group.  For instance, if Groups A and B exist

Cummulative Q A    == records all scores for group A
Complete G For Q  B == only record grade G and for group B and nothing else


