<?php

namespace Domains\Laravel\RelatedPackages\Infrastructure;

use Domains\Composer\ComposerDependency;

class AwsSdk extends ComposerDependency
{
    function id(): string
    {
        return 'aws-sdk';
    }

    function packageId(): string
    {
        return 'aws/aws-sdk-php';
    }

    function name(): string
    {
        return 'Amazon Web Services PHP SDK';
    }

    function description(): string
    {
        return '';
    }

    public function href(): string
    {
        return 'https://aws.amazon.com/sdk-for-php';
    }

    public function needsToBeInstalledWithAllDependencies(): bool
    {
        return true;
    }
}
