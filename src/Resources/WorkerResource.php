<?php

namespace IntelligentsDev\AiaConnector\Resources;

use IntelligentsDev\AiaConnector\Requests\Worker\ModelWorkerStatsRequest;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class WorkerResource extends BaseResource
{
    /**
     * Gets worker stats for the specified model-worker groups
     *
     * @param array $modelWorkerGroups
     * @return Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function modelWorkerStats(array $modelWorkerGroups): Response
    {
        return $this->connector->send(new ModelWorkerStatsRequest($modelWorkerGroups));
    }
}
