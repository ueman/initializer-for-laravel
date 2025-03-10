<?php

namespace Domains\Laravel\RelatedPackages\Infrastructure\Flysystem;

use Domains\Composer\ComposerDependency;

class SftpDriver extends ComposerDependency
{
    function id(): string
    {
        return 'flysystem-sftp';
    }

    function packageId(): string
    {
        return 'league/flysystem-sftp';
    }

    function name(): string
    {
        return "SFTP";
    }

    function description(): string
    {
        return "While FTP is supported out of the box, you need to check this "
            . "option to be able to use SFTP storage.";
    }

    public function href(): ?string
    {
        return "https://laravel.com/docs/filesystem#sftp-driver-configuration";
    }

    public function versionConstraint(): ?string
    {
        return "~1.0";
    }
}
