<?php

namespace IntelligentsDev\AiaConnector\Enums;

enum Pipeline: string
{
    case TEXT_TO_IMAGE = 'text-to-image';
    case TEXT_TO_IMAGE_WITH_FACE_SWAP = 'text-to-image-with-face-swap';
}
