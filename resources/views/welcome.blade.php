<x-frontend-layout>
    {{-- hero primary --}}
    <x-frontend.hero/>
    {{-- promote tail-100 --}}
    <x-frontend.promote/>
    {{-- About secondary --}}
    <x-frontend.about/>
    {{-- skills tail-100 --}}
    <x-frontend.skills :skills="$skills" />
    {{-- portfolio primary --}}
    <x-frontend.portfolio :skills="$skills" :projects="$projects"/>
    {{-- services secondary --}}
    <x-frontend.services/>
    {{-- contact primary  --}}
    <x-frontend.contact/>
</x-frontend-layout>
