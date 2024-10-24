<?php

namespace IntelligentsDev\AiaConnector\Enums;

enum ConversationMessageType: string
{
    case TEXT = 'text';

    case IMAGE_URL = 'image-url';
}
