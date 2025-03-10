#!/bin/sh
@php
    /** @var \Domains\ProjectTemplateCustomization\PostDownload\PostDownloadTaskGroup[] $groups */
    /** @var \Domains\ProjectTemplateCustomization\PostDownload\PostInitializationLink[] $links */
@endphp
set -e;

echo '';
<x-shell::banner title="Initializer for Laravel">
<x-shell::banner-line />
<x-shell::banner-line>This script will complete the rest of the setup needed to install the</x-shell::banner-line>
<x-shell::banner-line>chosen components into your fresh application. This might require</x-shell::banner-line>
<x-shell::banner-line>downloading Docker containers or requiring packages via composer</x-shell::banner-line>
<x-shell::banner-line>multiple times, so it can take a while to complete.</x-shell::banner-line>
<x-shell::banner-line/>
<x-shell::banner-line>\033[1mPlease make sure that Docker is running!\033[0m</x-shell::banner-line>
</x-shell::banner>
echo '';

read -n 1 -s -r -p "Press any key to continue";

echo '';

@foreach($groups as $group)
echo '';
<x-shell::banner :title="$group->title()" />
echo '';
@foreach($group->tasks() as $task)
echo {!! escapeshellcmd(is_string($task) ? $task : $task->shell()) !!}
{!! is_string($task) ? $task : $task->shell() !!};
@endforeach

@endforeach
echo "Finished setup, removing {{ $initializationScript }}!";
rm "./{{ $initializationScript }}";

echo '';
<x-shell::banner title="Done!">
<x-shell::banner-line />
<x-shell::banner-line>You can now have a look at README.md, for further instructions, guides</x-shell::banner-line>
<x-shell::banner-line>and links to the installed components.</x-shell::banner-line>
<x-shell::banner-line />
<x-shell::banner-line>Some helpful links:</x-shell::banner-line>
@foreach($links as $link)
<x-shell::banner-line>- \033[1m{{ $link->title }}\033[0m {{ $link->href }}</x-shell::banner-line>
@endforeach
</x-shell::banner>
echo '';