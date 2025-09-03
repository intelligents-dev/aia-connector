<?php

namespace IntelligentsDev\AiaConnector\Resources;

use IntelligentsDev\AiaConnector\Requests\Jobs\GetJobsRequest;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class JobResource extends BaseResource
{
    /**
     * Get jobs.
     *
     * @param array $queueableIds
     * @return Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function get(
        array $queueableIds = [],
    ): Response {
        return $this->connector->send(
            new GetJobsRequest($queueableIds),
        );
    }

    /**
     * Get estimation for jobs.
     *
     * @param array $jobModelGroups
     * @return Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function getEstimations(array $jobModelGroups = []): Response
    {
        return $this->connector->send(
            new GetJobsRequest($jobModelGroups),
        );
    }
}
