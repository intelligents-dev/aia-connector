<?php

namespace IntelligentsDev\AiaConnector\Enums;

enum Pipeline: string
{
    case TEXT_TO_IMAGE = 'text-to-image';
    case TEXT_TO_IMAGE_WITH_FACE_SWAP = 'text-to-image-with-face-swap';
    case TEXT_TO_VIDEO_FRAMES = 'text-to-video-frames';
    case PUSSY_SWAP = 'pussy-swap';
    
}
