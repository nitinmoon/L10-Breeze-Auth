<x-mail::message>
# Introduction

<x-mail::panel>
Hi {{ $userName }}
</x-mail::panel>

<x-mail::panel>
The body of your message. Testing Jobs!
</x-mail::panel>

 

<x-mail::button :url="route('dashboard')">
Testing Email For Job Queue
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>