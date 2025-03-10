<?php

namespace Domains\CreateProjectForm\Sections;

use Domains\CreateProjectForm\Sections\Metadata\PhpVersion;

class Metadata
{
    /**
     * @param string $vendorName
     * @param string $projectName
     * @param string $description
     * @param string $phpVersion
     * @psalm-param PhpVersion::* $phpVersion
     */
    public function __construct(
        public string $vendorName,
        public string $projectName,
        public string $description = '',
        public string $phpVersion = PhpVersion::v8_0,
    ) { }

    public function fullName(): string {
        return "$this->vendorName/$this->projectName";
    }
}
