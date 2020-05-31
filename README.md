# Cards game API
<p align="center">
  <a href="https://laravel.com/" alt="Built with: Laravel v7.11.0">
    <img src="https://badgen.net/badge/Built%20with/Laravel%20v7.11.0/FF2D20" />
  </a>
  <a href="https://www.php.net/downloads.php" alt="Powered by: PHP v7.4.4">
    <img src="https://badgen.net/badge/Powered%20by/PHP%20v7.4.4/8892BF" />
  </a>
  <a href="https://opensource.org/licenses/MIT" alt="License: MIT">
    <img src="https://img.shields.io/badge/License-MIT-yellow.svg" />
  </a>
</p>

## Introduction
- An Input field which allows users to enter their name **(required)**.
- An Input field which allows users to enter a hand of cards, each card should be
separated by a space. For example: 2 4 6 J K A (Valid cards include: 2, 3, 4, 5, 6, 7, 8, 9, 10, J, Q, K, A)
- When the "**player"** makes a **POST** request with the **user_name** and **hand_of_cards** (i.e. Request format defined in the **Endpoints** section) , a random "**hand of cards"** with the same  amount of cards that the user entered are generated.
- The **"player's"** hand of cards is then compared to the generated hand of cards.
- Each card in the **"player's"**hand is compared to the card in the same position in
the generated hand. Highest value card wins. For example:
**Player's hand: 5 7 A K
Generated Hand: 4 8 K Q**
A score is calculated for the **"player"** and **"generated"** hand, in this example it would
be:
**Player: 3
Generated: 2**
- The result of the game is then displayed back to the **"player"**, which includes **Player's name, Player's hand score, Generated hand's score and "the end result (Won, Lost or Tied)"**.
- **GET** request returns the leaderboard which includes **Player's name, total number of "games" and "hands" that all the players"8** have won.

## Installation and Requirements
1. Install [Composer](https://getcomposer.org/download/)
2. Install [Xampp](https://www.apachefriends.org/download.html)
3. Install [Postman](https://www.postman.com/downloads/)
4. Clone the repository.
5. Use [Composer](https://getcomposer.org/download/) to install the required dependencies by navigating to the root directory of the cloned repository and run the following command inside the Terminal:
```bash
composer install
``` 
6. Rename the **".env.example"** file in the root directory to **".env"**.

## Running the application
1. Navigate to the root directory and run the following command inside the Terminal:
```bash
php artisan serve
``` 
2. Open Xampp and verify PhpMyAdmin is running.
3. Make sure to create a new database with name ***"card_game"*** using PhpMyAdmin.
4. Create the database and add fake data by running the following commands inside the  Terminal:
```bash
php artisan migrate
php artisan db:seed 
```
6. Open the Postman and send a GET request to fetch the Leaderboard or a POST request to play the **"Cards game"**  according to the format provided in the next section.

## Endpoints
Import the **"Ecommerce API.postman_collection.json"** into Postman and a quick overview of some of the Ecommerce API structure is as follows:
| Description | Endpoints | Payload | HTTP Methods |
| ------------- | ------------- | ------------- | ------------- |
| Get the Leaderboard: | `http://localhost:8000/api/game` | | GET |
| Play the Game: | `http://localhost:8000/api/game` | Select **"raw"** data, with content-type: contentTypeJson, {"user_name" : "Random name", "hand_of_cards" : "9 10  J Q K 10  8"} | POST |

## LARAVEL Features used
**Migration and Seeding**
  - App\databases\factories\ResultFactory.php
  - App\databases\migrations\2020_05_23_022117_create_results_table.php
  - App\databases\seeds\DatabaseSeeder.php

**Sanitization and Validation (Using Requests and Rules)**
  - App\Http\Requests\ResultRequest.php
  - App\Http\Rules\ValidHand.php

**Controller, Service and Model**
  - App\Http\Controllers\ResultController.php
  - App\Services\GamePlayService.php
  - App\Http\Models\Result.php

**Exception Handling**
 - App\Http\Exceptions\Handler.php

**Resource (For Transformation)**
  -  App\Http\Resources\ResourceCollection.php
  -  App\Http\Resources\ResourceResource.php

## License
[MIT](https://choosealicense.com/licenses/mit/)