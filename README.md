# AIA Connector

## Installation

## Usage
### Conversations
```php
use GlobalModerators\AiaConnector\AiaConnector;
use GlobalModerators\AiaConnector\Data\CreateMessageOptions;

// Fetch required parameters
$characterId = Characters::findOrFail(1);
$userId = auth()->user()->id;

// Build and send a message
$message = (new AiaConnector())
        ->conversations()
        ->messages()
        ->send(
            message: 'Hi there!', 
            characterId: $characterId, 
            userId: $userId, 
            options: new CreateMessageOptions(
                systemPrompt: 'You are a nice girl!',
                temperature: 0.5,
            )
    ));
```
