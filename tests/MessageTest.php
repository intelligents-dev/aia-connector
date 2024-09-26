<?php

use GlobalModerators\AiaConnector\AiaConnector;
use GlobalModerators\AiaConnector\Data\CreateMessageOptions;
use GlobalModerators\AiaConnector\Requests\Messages\CreateMessageRequest;
use Orchestra\Testbench\TestCase;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

class MessageTest extends TestCase
{
    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function test_send_a_message_with_valid_data_gives_200_response(): void
    {
        $mockClient = new MockClient([
            CreateMessageRequest::class => MockResponse::make(body: '', status: 200),
        ]);

        $options = (new CreateMessageOptions())
            ->setTemperature(0.5);

        AiaConnector::make('https://service.aia.local/api', '1|JnrAJwRC8VFnSElNusd7xPJC3xUSHrTtRvOZFsiF99fae3f2')
            ->conversations()
            ->messages()
            ->send('Hello, world!', 1234, 123, $options);
    }
}
