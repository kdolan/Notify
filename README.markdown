Notify
=============

Notify consists of three parts. A server aplication written in python that gets
notifications that need to be sent from the webserver and then sends them. The 
second part of the aplication is the webserver which handles comunication
between the python server and the mySQL server. The webserver also handles
adding notifications to the database. Finally, APIs in various languages
comunicate with the webserver to add notifications to the database. 


Dependencies
------------
* MySQL - Backend datastore (database structure included)
* Python v 3.2

Planned Features and Fixes
------------
* Add web interface for users to update their preferences
* Include admin support on the webpage for adding new services