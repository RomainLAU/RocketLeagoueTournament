
# RocketLeagueTournament

This is a tournament manager for the game Rocket League.




## Installation

Install my-project with git

```bash
  git clone git@github.com:RomainLAU/RocketLeagueTournament.git
  cd RocketLeagueTournament
```


## FAQ

#### How to set up the Database ?

On PhpMyAdmin, create a database called "tournoi" (yes, a bad name). Then go in the "import" section
and select the "tournoi.sql" file that is in the "public" folder.

#### How to briefly test the website ?

In the Database you just imported, we already created few users, with different roles.
So, to test all features and views here are the credentials for each account:
- admin account :
    - email : admin@mail.com
    - password : admin123
- host account :
    - email : freezy@gmail.com
    - password : lrmmms667
- user account :
    - email : theo2008@gmail.com
    - password : theo2008

## Features

- Register / Login
- Subscription of 1 month to access the Host role
- If you are an host, you can:
    - Create a tournament
    - Delete it
    - Add players
    - Create matches
    - Update matches
    - Select the winner
- If you are a simple user, you can:
    - Subscribe to be an host
    - Join a tournament
    - See all the tournaments
    - See the matches
- If you are an admin, you can:
    - Do everything + modify the winner of a tournament

