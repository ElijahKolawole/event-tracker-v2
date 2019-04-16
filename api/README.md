# How to use this API

### To run you will need...
* [Download WAMP](http://www.wampserver.com/en/)
* Put all API files into a new folder in the WWW directory
* Create local mysql database
  * Preferably by importing the test database.sql provided (name the database 'eventtracker')

### Description
The API will return all information in JSON format. You access the information you want via directory then by a respective PHP page. 

Example 1:
Obtain information about slot with id 2
```
localhost/api/slots/read.php?id=2

OUTPUT:
{"id":"2","event_id":"1","event_title":"Fake Event","title":"Job 2","description":"Hand out drinks","date":"2018-09-10","starttime":"09:00:00","endtime":"17:00:00"}
```
Example 2:
Obtain information about all slots related to GGC
```
localhost/api/slots/search.php?s=ggc

OUTPUT:
{"records":[{"id":"3","title":"Greeter","description":"You'll be greeting people!","date":"2018-09-22","starttime":"10:00:00","endtime":"14:00:00","event_id":"2","event_title":"GGC Event","organization_name":"Georgia Gwinnett College"}]}
```

### Slots
* Read	 - Read.php
  * To see a single slot add '?id=#' to the end. 
* Create - Create.php
  * Post to this page with the following variables: event_id, title, description, date, starttime, endtime, created(use current time)
* Update - Update.php
  * Post to this page with the following variables: id,title, description, date, starttime, endtime
* Delete - Delete.php
  * Post to this page with the 'id' of the slot you wish to delete
* Search - Search.php
  * Add 's=KEYWORD' to search for a keyword. Keyword search is applied to slot title, slot description, and event description.

