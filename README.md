# MyPlanner v2.0
Author: Marvin Odobashi

# Description
An updated version of a previous personal planner project. This version, includes slightly updates styling and rewritten JS.
However, it's most important change is that it no longer stores data based on web browser cookies. Instead, it now connects to
a database (if given the username, password, and database servername), and uses PHP scripts to communicate with the server. There
is no built in function to create accounts; however, given a properly formatted database, one would be able either to add in the 
user(s) manually, or just add a simple script to send over sign-up information to the database.
It is by no means a complete project, but it does do include the bare-bones necessities: a Calendar and a To-Do List. I intentionally
made the calendar boxes and the to-do list simple textareas, because I wanted to get a "physical" feel for this planner, having
no restrictions on what or how one can write into the boxes, similar to a physical calendar.
