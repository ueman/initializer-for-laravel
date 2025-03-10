<?php

namespace Domains\ProjectTemplate;

use Domains\Support\FileSystem\Path;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use League\Flysystem\Adapter\Local;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use PhpZip\ZipFile;

/**
 * Physical storage layer for the template on the local filesystem.
 */
class TemplateStorage
{
    const ARCHIVE_FILE_NAME = 'template.zip';
    const VERSION_FILE_NAME = 'version';
    const CURRENT_SYMLINK_NAME = 'current';

    /** @codeCoverageIgnore */
    public function __construct(private FilesystemAdapter $filesystem) { }

    public function exists(): bool
    {
        return $this->currentVersion() !== 'unknown';
    }

    public function currentArchive(): ZipFile
    {
        return (new ZipFile())->openFromStream(
            $this->filesystem->readStream(
                $this->current(self::ARCHIVE_FILE_NAME)
            )
        );
    }

    /** @codeCoverageIgnore */
    private function current(string $path = ''): string
    {
        if ($path === '') {
            return self::CURRENT_SYMLINK_NAME;
        }

        return Path::join(self::CURRENT_SYMLINK_NAME, $path);
    }

    public function currentVersion(): string
    {
        $currentVersion = false;

        try {
            $currentVersion = $this->filesystem->get(
                $this->current(self::VERSION_FILE_NAME)
            );
        } catch (FileNotFoundException) { }

        if (!is_string($currentVersion)) {
            return 'unknown';
        }

        return $currentVersion;
    }

    public function updateCurrentRelease(DownloadedLaravelRelease $release): void
    {
        $this->store($release);
        $this->setCurrentRelease($release);
    }

    /** @codeCoverageIgnore */
    private function setCurrentRelease(DownloadedLaravelRelease $release): void
    {
        $version = $release->package->version;
        $this->filesystem->delete($this->current());

        /** @var Local $local */
        $local = $this->filesystem->getDriver()->getAdapter();

        File::copyDirectory(
            $local->applyPathPrefix($version),
            $local->applyPathPrefix($this->current())
        );
        Log::info("Current template version was set to $version!");
    }

    /** @codeCoverageIgnore */
    private function store(DownloadedLaravelRelease $release): void {
        $version = $release->package->version;

        $this->filesystem->deleteDirectory($version);
        $this->filesystem->makeDirectory($version);

        $archivePath = Path::join($version, self::ARCHIVE_FILE_NAME);
        $versionPath = Path::join($version, self::VERSION_FILE_NAME);

        /** @var Local $local */
        $local = $this->filesystem->getDriver()->getAdapter();
        $release->archive->saveAsFile($local->applyPathPrefix($archivePath));

        $this->filesystem->put($versionPath, $version);
    }
}
