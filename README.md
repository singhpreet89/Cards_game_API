# Cards_game_API
An API based on a Cards game built using Laravel.

## Features Used
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

**Transformers (Using Resources)**
  -  App\Http\Resources\ResourceCollection.php
  -  App\Http\Resources\ResourceResource.php