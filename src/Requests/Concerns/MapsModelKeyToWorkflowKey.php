<?php

namespace IntelligentsDev\AiaConnector\Requests\Concerns;

trait MapsModelKeyToWorkflowKey
{
    protected function withWorkflowKeys(array $groups): array
    {
        return array_map(fn (array $group): array => $this->withWorkflowKey($group), $groups);
    }

    private function withWorkflowKey(array $group): array
    {
        if (array_key_exists('model_key', $group)) {
            $group['workflow_key'] ??= $group['model_key'];
            unset($group['model_key']);
        }

        return $group;
    }
}
