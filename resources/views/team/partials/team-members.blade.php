<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Team members') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            These are the members of your team
        </p>
    </header>

    <div class="mt-6">
        <ul class="divide-y divide-gray-100">
            @foreach($team->members as $member)
                <x-team-member-item :member="$member" />
            @endforeach
        </ul>
    </div>
</section>
