<?php

namespace Domains\CreateProjectForm\Http\Request\CreateProjectRequest;

use Domains\CreateProjectForm\Sections\Authentication;
use Domains\CreateProjectForm\Sections\Cache;
use Domains\CreateProjectForm\Sections\Storage;
use Domains\CreateProjectForm\Sections\Database;
use Domains\CreateProjectForm\Sections\DevelopmentTools;
use Domains\CreateProjectForm\Sections\Metadata;
use Domains\CreateProjectForm\Sections\Payment;
use Domains\CreateProjectForm\Sections\Queue;
use Domains\CreateProjectForm\Sections\Search;
use Domains\CreateProjectForm\Sections\Testing;
use Domains\Support\Enum\EmulatesEnum;

/** {@link CreateProjectRequest} */
class CreateProjectRequestParameter
{
    use EmulatesEnum;

    const USES_PREFIX = 'uses-';

    /** @see Metadata */
    const VENDOR = 'vendor';
    const PROJECT = 'project';
    const PHP = 'php';
    const DESCRIPTION = 'description';

    /** @see Authentication */
    const STARTER = 'starter';
    const USES_JETSTREAM_TEAMS = self::USES_PREFIX . 'jetstream-teams';
    const JETSTREAM_FRONTEND = 'jetstream-frontend';
    const BREEZE_FRONTEND = 'breeze-frontend';
    const USES_FORTIFY = self::USES_PREFIX . 'fortify';
    const USES_PASSPORT = self::USES_PREFIX . 'passport';
    const USES_SOCIALITE = self::USES_PREFIX . 'socialite';

    /** @see Database */
    const DATABASE = 'database';

    /** @see Cache */
    const CACHE_DRIVER = 'cache-driver';

    /** @see Search */
    const SCOUT_DRIVER = 'scout-driver';

    /** @see Queue */
    const QUEUE_DRIVER = 'queue-driver';
    const USES_HORIZON = self::USES_PREFIX . 'horizon';

    /** @see DevelopmentTools */
    const USES_TELESCOPE = self::USES_PREFIX . 'telescope';
    const USES_MAILHOG = self::USES_PREFIX . 'mailhog';
    const USES_ENVOY = self::USES_PREFIX . 'envoy';

    /** @see Testing */
    const USES_DUSK = self::USES_PREFIX . 'dusk';
    const USES_PEST = self::USES_PREFIX . 'pest';

    /** @see Payment */
    const CASHIER_DRIVER = 'cashier-driver';

    /** @see Storage */
    const USES_MINIO = self::USES_PREFIX . 'minio';
    const USES_FLYSYSTEM_S3_DRIVER = self::USES_PREFIX . 'flysystem-s3-driver';
    const USES_FLYSYSTEM_SFTP_DRIVER = self::USES_PREFIX . 'flysystem-sftp-driver';
    const USES_FLYSYSTEM_CACHED_ADAPTER = self::USES_PREFIX . 'flysystem-cached-adapter';
}
