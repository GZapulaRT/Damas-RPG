### Damas RPG REST API
##Endpoints
#For the moment, There's 3 major endpoints for our aplícation
```
/api/user/[id] " for getting one user in Json
/api/user[?page='int'] " for getting a Json list of 100 users
/api/rank[?page='int'] " for getting a Json list of 50 users ranked
```
#One user give you the following informations:
```
id
name
image
description/status
email
country
their rank
their total score
```

#Multiple users give you the following informations:
```
id
name
image
description
country
```
it is given in alphabetic order 100 itens at a time. with want a new
page, call the endpoint with `?page=[*page_number*]`

#Multiple rank give you the following informations
```
current_score
user_name
user_id
user_image
country
rank
```
it is given the top50 ordered by their rank. to get a new page, call the 
endpoint with `?page=[*page_number*]`
