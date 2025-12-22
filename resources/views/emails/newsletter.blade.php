<x-mail::message>
# {{ $newsletter->subject_en }}

{!! $newsletter->content_en !!}

---

<div dir="rtl" style="text-align: right;">

# {{ $newsletter->subject_ar }}

{!! $newsletter->content_ar !!}

</div>

<x-mail::button :url="config('app.url')">
Visit Gaza Roots
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
