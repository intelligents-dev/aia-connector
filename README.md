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

// Fetch required parameters
$characterId = Characters::findOrFail(1)->aia_character_id;
$userId = auth()->user()->id;

// Set options
$options = CreateMessageOptions::make()
    ->setSystemPrompt('You are a nice girl!')
    ->setTemperature(0.5);
    
// Build and send a message
$message = AiaConnector::make()
    ->conversations()
    ->messages()
    ->send('Hi there!', $characterId, $userId, $options);
));
```
