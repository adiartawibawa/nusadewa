<div class="flex-1 relative h-[400px] md:h-[500px] w-full overflow-hidden">
    @if (count($innovations) <= 3)
        <x-accordion :items="$innovations" linkPrefix="innovations"
            labelLearnMore="{{ __('component.innovations.read_more') }}" />
    @else
        <x-carousel :items="$innovations" linkPrefix="innovations"
            labelLearnMore="{{ __('component.innovations.read_more') }}" :interval="5000" />
    @endif
</div>
