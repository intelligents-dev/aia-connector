# AIA Connector

## Installation

### Install the package

```bash
composer require globalmoderators/aia-connector
```

### Publish the configuration

Add the following to your `config/services.php` file and set the .env values accordingly.

```php
 'aia' => [
    'base_url' => env('AIA_URL'),
    'token' => env('AIA_TOKEN'),
    'image_callback_url' => env('AIA_IMAGE_CALLBACK_URL'),
    'ignore_ssl' => env('AIA_IGNORE_SSL', false),
],
```
```dotenv
AIA_URL=<the url of the AIA-service API>
AIA_TOKEN=<the token to authenticate with the AIA-service API>
AIA_IMAGE_CALLBACK_URL=<the url to the callback endpoint for image generation>
```

## Conversations

### Create a character

You can create a character in the AIA platform. This is necessary to send messages to the character.

```php
use GlobalModerators\AiaConnector\AiaConnector;
use GlobalModerators\AiaConnector\Requests\Conversations\Data\CreateCharacterOptions;

// Set options
$options = CreateCharacterOptions::make()
    ->setSystemPrompt('You are a beautiful woman with blonde hair.');

// Build and send request
$character = AiaConnector::make()
    ->characters()
    ->create($options);
));

// Return the JSON response
return $response->json();
```

### Sending a message

You can send a message to a character in a conversation.

```php
use App\Models\Characters;
use GlobalModerators\AiaConnector\AiaConnector;
use GlobalModerators\AiaConnector\Requests\Conversations\Data\CreateMessageOptions;

// Find a character
$character = Character::find(1);

// Set options
$options = CreateMessageOptions::make()
    ->setSystemPrompt('You are a nice girl!')
    ->setTemperature(0.5)
    ->setMaxTokens(100)
    ->setTopP(0.5)
    ->setTopK(50);

// Build and send request
$response = AiaConnector::make()
    ->conversations()
    ->messages()
    ->send('Hi there!', $character->ai_character_id, $character->user_id, $options);

// Return the JSON response
return $response->json();
```

## Images

## Create text to image

```php
use GlobalModerators\AiaConnector\AiaConnector;
use GlobalModerators\AiaConnector\Requests\Images\Data\CreateTextToImageOptions;

// Set options
$options = CreateTextToImageOptions::make()
    ->setModelName('model')
    ->setPrompt('This is a test')
    ->setNegativePrompt('This is a negative test')
    ->setHeight(500)
    ->setWidth(500)
    ->setNumInferenceSteps(10)
    ->setSchedulerName('scheduler')
    ->setLoraScale(0.5)
    ->setLoraWeightName('name');

// Build and send request
$response = AiaConnector::make()
    ->images()
    ->textToImage()
    ->create($options);

// Return the JSON response
return $response->json();
```

## Create text to image with face swap

```php
use GlobalModerators\AiaConnector\AiaConnector;
use GlobalModerators\AiaConnector\Requests\Images\Data\CreateTextToImageWithFaceSwapOptions;

// Set options
$options = CreateTextToImageWithFaceSwapOptions::make()
    ->setModelName('model')
    ->setPrompt('This is a test')
    ->setNegativePrompt('This is a negative test')
    ->setHeight(500)
    ->setWidth(500)
    ->setNumInferenceSteps(10)
    ->setSchedulerName('scheduler')
    ->setSourceUrl('https://source.com/image.jpg')
    ->setStartMergeStep(5);

// Build and send request
$response = AiaConnector::make()
    ->images()
    ->textToImageWithFaceSwap()
    ->create($options);

// Return the JSON response
return $response->json();
```
