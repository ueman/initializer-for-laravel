<?php

namespace Domains\Laravel\ComposerPackages\Packages;

use Domains\Laravel\ComposerPackages\FirstPartyPackage;
use Domains\Laravel\ComposerPackages\ProvidesInstallationInstructions;
use Domains\Laravel\StarterKit\JetstreamFrontend;
use Domains\ProjectTemplateCustomization\PostDownload\ClosurePostInstallTaskGroup;
use Domains\ProjectTemplateCustomization\PostDownload\PostDownloadTaskGroup;

class Jetstream extends FirstPartyPackage implements ProvidesInstallationInstructions
{
    public function __construct(
        private bool $usesTeams,
        private bool $usesPest,
        private JetstreamFrontend $frontend,
    ) { }

    const REPOSITORY_KEY = 'jetstream';

    function description(): string
    {
        return 'A polished and feature-rich implementation for your '
            . 'application\'s login, registration, email verification, '
            . 'two-factor authentication, session management, API, and '
            . 'optional team management features.';
    }

    public function href(): string
    {
        return 'https://jetstream.laravel.com';
    }

    public function installationInstructions(string $artisan): PostDownloadTaskGroup
    {
        return new ClosurePostInstallTaskGroup(
            "Install Laravel Jetstream",
            function () use ($artisan) {
                $command = "$artisan jetstream:install";

                if ($this->usesTeams) {
                    $command .= " --teams";
                }

                if ($this->usesPest) {
                    $command .= " --pest";
                }

                $command .= " $this->frontend";

                return [$command];
            }
        );
    }
}
