# AIA Connector

## Installation
### Install the package
```bash
composer require globalmoderators/aia-connector
```
### Publish the configuration
```bash
php artisan vendor:publish --provider="GlobalModerators\AiaConnector\AiaConnectorServiceProvider" --tag="config"
```
### Set the key in your `.env` file
```dotenv
AIA_API_KEY=your-api-key
```

## Characters

### Create a character
```php
use App\Models\Characters;
use GlobalModerators\AiaConnector\AiaConnector;
use GlobalModerators\AiaConnector\Data\CreateCharacterOptions;

// Fetch required parameters
$characterName = Characters::findOrFail(1)->name;

// Set options
$options = CreateCharacterOptions::make()
    ->setName($characterName);

// Build and send a message
$character = AiaConnector::make()
    ->characters()
    ->create($options);
));
```

## Conversations

### Sending a message
You can send a message to a character in a conversation. 
```php
use App\Models\Characters;
use GlobalModerators\AiaConnector\AiaConnector;
use GlobalModerators\AiaConnector\Data\CreateMessageOptions;
// Find a character
$character = Character::find(1);

// Set options
$options = CreateMessageOptions::make()
    ->setSystemPrompt('You are a nice girl!')
    ->setTemperature(0.5);

// Build and send a message
$response = AiaConnector::make()
    ->conversations()
    ->messages()
    ->send('Hi there!', $character->ai_character_id, $character->user_id, $options);

// Return the JSON response
return $response->json();
```
